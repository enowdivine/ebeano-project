<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Product;
use App\ProductStock;
use DB;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use CoreComponentRepository;
use Intervention\Image\Exception\NotReadableException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.products.index');
    }

    public function seller_product(){

        return view('seller.product.index');
    }
    
    public function product_review(){
        return back()->with(['error'=>'No review yet']);
        //return view('seller.product.index');
    }

    public function seller_product_add($step){
        if($step ==='choose-category') {
            return view('seller.product.steps.choose-category');
        }
        abort(404);
    }
    
    public function seller_product_action(Request $request, $step, $action){
        if($step ==='choose-category') {
            if($action) {
                $category = Category::where('slug', $action)->first();
                if($category) {
                    $data['category'] = $category;
                    $data['subcategories'] = SubCategory::where('category_id', $category->id)->get();
                    return view('seller.product.steps.general', $data);
                }
                abort(404);
            }
            abort(404);
            
        }else if($step ==='set-price') {
            if($action) {
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    $data['product'] = $product;
                    return view('seller.product.steps.set-price', $data);
                }
                abort(404);
            }
            abort(404);
            
        }else if($step ==='set-attributes') {
            if($action) {
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    $data['product'] = $product;
                    return view('seller.product.steps.set-attributes', $data);
                }
                abort(404);
            }
            abort(404);
            
        }else if($step ==='set-others') {
            if($action) {
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    $data['product'] = $product;
                    return view('seller.product.steps.set-others', $data);
                }
                abort(404);
            }
            abort(404);
            
        }else if($step ==='general') {
            if($action) {
                
                // save
                $data = $request->all();
                if($request->type == 'wholesale'){
                    request()->validate([
                        'name' => 'required',
                        'category' => 'required',
                    ]);
                }else{
                    request()->validate([
                        'name' => 'required',
                        'category' => 'required',
                    ]);
                }
        
                $product = new Product;
                $product->name = $request->name;
                $product->added_by = 'admin';
                if(Auth::user()->user_type == 'seller'){
                    $product->user_id = Auth::user()->id;
                    $product->added_by = 'seller';
                }
                else{
                    $product->user_id = \App\User::where('user_type', 'admin')->first()->id;
                }
                
                // set category
                $product->category_id = $request->category;
                
                // set sub category
                if($request->sub_category) {
                    $product->subcategory_id = $request->sub_category;
                }
                // set sub sub category
                if($request->sub_subcategory) {
                    $product->subsubcategory_id = $request->sub_subcategory;
                }
                $product->brand_id = $request->brand;
                $product->tags = json_encode($request->tags);
                $product->type = $request->type;
                $product->description = $request->full_description;
                $product->slug = Str::of($request->name)->slug('-');
        
                $no_of_slugs = Product::where('slug',$product->slug)->count();
                if($no_of_slugs > 0 ){
                    $product->slug = $product->slug.'-'.mt_rand(10000000,99999999);
                }
                
                
                $product->published = 0;

                
                // save
                if($product->save()){
                    // proceed to next step
                    return redirect()->route('seller.product_action',['step'=>'set-price', 'action' => $product->slug])->withSuccess('Product Information added successfully');
                }else{
                    return back()->with(['error'=>'Something went wrong','data'=>$data]);
                }
                
                
            }
            abort(404);
            
        }else if($step ==='save-price') {
            if($action) {
                request()->validate([
                        'unit_price' => 'required|numeric',
                        'bulk_price' => 'numeric',
                        'items_per_bulk_price' => 'numeric',
                        'discount' => 'numeric',
                        'current_stock' => 'numeric'
                    ]);
                // save
                $data = $request->all();
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    $product->specification = $request->specifications;
                    $product->unit_price = $request->unit_price;
                    $product->bulk_price = $request->bulk_price;
                    $product->items_per_bulk_price = $request->items_per_bulk_price;
                    $product->discount = $request->discount;
                    $product->current_stock = $request->quantity;
                    $product->discount_type = $request->discount_type;
                
                    // save
                    if($product->save()){
                        // proceed to next step
                        return redirect()->route('seller.product_action',['step'=>'set-attributes', 'action' => $product->slug])->withSuccess('Price added successfully');
                    }else{
                        return back()->with(['error'=>'Something went wrong','data'=>$data]);
                    }
                }
                abort(404);
                
            }
            abort(404);
            
        }else if($step ==='save-attributes') {
            if($action) {
                
                // save
                $data = $request->all();
                request()->validate([
                    'featured_img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
                ]);
                
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    
                    $photos = array();

                    if($request->hasFile('photos')){
                        
                        foreach ($request->file('photos') as $photo) {
                            $image = $photo;
                        $input['imagename'] = time().'.'.$image->extension();
                 
                        $destinationPath = public_path('/storage/uploads/products/photos');
                        $img = Image::make($image->path());
                        $img->resize(680, 850, function ($constraint) {
                        $constraint->aspectRatio();
                            
                        })->save($destinationPath.'/'.$input['imagename']);
                            $path = 'uploads/products/photos/'.$input['imagename'];
                            array_push($photos, $path);
                            
                        }
                        $product->photos = json_encode($photos);
                    }
            
                    if($request->hasFile('featured_img')){
                        $image = $request->file('featured_img');
                        $input['imagename'] = time().'.'.$image->extension();
                 
                        $destinationPath = public_path('/storage/uploads/products/featured');
                        $img = Image::make($image->path());
                        $img->resize(290, 300, function ($constraint) {
                        $constraint->aspectRatio();
                            
                        })->save($destinationPath.'/'.$input['imagename']);
                        $product->featured_img = 'uploads/products/featured/'.$input['imagename'];
                    }
                    
                    // set colors
                    if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                        $product->colors = json_encode($request->colors);
                    }
                    else {
                        $colors = array();
                        $product->colors = json_encode($colors);
                    }
            
                    $choice_options = array();
            
                    if($request->has('choice_no')){
                        foreach ($request->choice_no as $key => $no) {
                            $str = 'choice_options_'.$no;
            
                            $item['attribute_id'] = $no;
                            $item['values'] = explode(',', implode('|', $request[$str]));
            
                            array_push($choice_options, $item);
                        }
                    }
            
                    if (!empty($request->choice_no)) {
                        $product->attributes = json_encode($request->choice_no);
                    }
                    else {
                        $product->attributes = json_encode(array());
                    }
            
                    $product->choice_options = json_encode($choice_options);
                    
                    //combinations start
                    $options = array();
                    if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                        $colors_active = 1;
                        array_push($options, $request->colors);
                    }
            
                    if($request->has('choice_no')){
                        foreach ($request->choice_no as $key => $no) {
                            $name = 'choice_options_'.$no;
                            $my_str = implode('|',$request[$name]);
                            array_push($options, explode(',', $my_str));
                        }
                    }
            
                    //Generates the combinations of customer choice options
                    $combinations = combinations($options);
                    if(count($combinations[0]) > 0 && $my_str != null){
                        $product->variant_product = 1;
                        foreach ($combinations as $key => $combination){
                            $str = '';
                            foreach ($combination as $key => $item){
                                if($key > 0 ){
                                    $str .= '-'.str_replace(' ', '', $item);
                                }
                                else{
                                    if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                                        $color_name = \App\Color::where('code', $item)->first()->name;
                                        $str .= $color_name;
                                    }
                                    else{
                                        $str .= str_replace(' ', '', $item);
                                    }
                                }
                            }
                            
                            $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                            if($product_stock == null){
                                $product_stock = new ProductStock;
                                $product_stock->product_id = $product->id;
                            }
            
                            $product_stock->variant = $str;
                            $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                            $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                            $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                            $product_stock->save();
                        }
                    }
                
                    // save
                    if($product->save()){
                        // proceed to next step
                        return redirect()->route('seller.product_action',['step'=>'set-others', 'action' => $product->slug])->withSuccess('Attributes added successfully');
                    }else{
                        return back()->with(['error'=>'Something went wrong','data'=>$data]);
                    }
                }
                abort(404);
                
            }
            abort(404);
            
        }else if($step ==='save-others') {
            if($action) {
                
                // save
                $data = $request->all();
                $product = Product::where('slug', $action)->where('user_id', Auth::user()->id)->first();
                if($product) {
                    
                    $product->weight = $request->weight;
                    
                    if($request->free_shipping == 1){
                        $product->shipping_cost = 0;
                        $product->shipping_type = 'free';
                    }
                    else{
                        $product->shipping_cost = $request->shipping_cost;
                        $product->shipping_type = 'flat_rate';
                    }
                    $product->meta_title = $request->meta_title;
                    $product->meta_description = $request->meta_description;
                    $product->meta_keywords = $request->meta_keywords;
                
                    // save
                    if($product->save()){
                        // proceed to next step
                        return redirect()->route('seller.product')->withSuccess('Product added successfully');
                    }else{
                        return back()->with(['error'=>'Something went wrong','data'=>$data]);
                    }
                }
                abort(404);
                
            }
            abort(404);
            
        }else{
            return view('seller.product.form');
        }
    }
    
    public function seller_product_edit($id){
        $edit = Product::findOrFail(decrypt($id));
        return view('seller.product.form',compact('edit'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        if($request->type == 'wholesale'){
            request()->validate([

            'name' => 'required',
            'category' => 'required',
            'items_per_bulk_price' => 'required',
            'bulk_price' =>'required',
            'unit_price' =>'required',
            //'featured_img' => 'required|image|mimes:png,jpg,jpeg|max:2048'

            ]);
        }else{
            request()->validate([
    
                'name' => 'required',
                'category' => 'required',
                'unit_price' =>'required',
                //'featured_img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    
            ]);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->added_by = 'admin';
        if(Auth::user()->user_type == 'seller'){
            $product->user_id = Auth::user()->id;
            $product->added_by = 'seller';
        }
        else{
            $product->user_id = \App\User::where('user_type', 'admin')->first()->id;
        }
        $product->category_id = $request->category;
        $product->subcategory_id = $request->sub_category;
        $product->subsubcategory_id = $request->sub_subcategory;
        $product->brand_id = $request->brand;
        $product->current_stock = $request->quantity;
        $product->barcode = $request->barcode;
        $product->type = $request->type;

            if ($request->refundable != null) {
                $product->refundable = 1;
            }
            else {
                $product->refundable = 0;
            }

        $photos = array();

        if($request->hasFile('photos')){
            
            //request()->validate(['photos' => 'image|mimes:png,jpg,jpeg|max:2048']);
            
            foreach ($request->file('photos') as $photo) {
                $image = $photo;
            $input['imagename'] = time().'.'.$image->extension();
     
            $destinationPath = public_path('/storage/uploads/products/photos');
            $img = Image::make($image->path());
            $img->resize(680, 850, function ($constraint) {
            $constraint->aspectRatio();
                
            })->save($destinationPath.'/'.$input['imagename']);
                $path = 'uploads/products/photos/'.$input['imagename'];
                array_push($photos, $path);
                
            }
            $product->photos = json_encode($photos);
        }

        if($request->hasFile('featured_img')){
            $image = $request->file('featured_img');
            $input['imagename'] = time().'.'.$image->extension();
     
            $destinationPath = public_path('/storage/uploads/products/featured');
            $img = Image::make($image->path());
            $img->resize(290, 300, function ($constraint) {
            $constraint->aspectRatio();
                
            })->save($destinationPath.'/'.$input['imagename']);
            $product->featured_img = 'uploads/products/featured/'.$input['imagename'];
            // $product->featured_img = $request->file('featured_img')->store('uploads/products/featured');
            //ImageOptimizer::optimize(base_path('public/').$product->featured_img);
        }

        $product->unit = $request->unit;
        $product->tags = json_encode($request->tags);
        $product->type = $request->type;
        $product->description = $request->full_description;
        $product->specification = $request->specifications;
        $product->unit_price = $request->unit_price;
        $product->bulk_price = $request->bulk_price;
        $product->items_per_bulk_price = $request->items_per_bulk_price;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->weight = $request->weight;

        if ($request->publish == 1){
            $product->published = 1;
        }
        
        if($request->free_shipping == 1){
            $product->shipping_cost = 0;
            $product->shipping_type = 'free';
        }
        else{
            $product->shipping_cost = $request->shipping_cost;
            $product->shipping_type = 'flat_rate';
        }
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;

 

        $product->slug = Str::of($request->name)->slug('-');
        
        $no_of_slugs = Product::where('slug',$product->slug)->count();
        if($no_of_slugs > 0 ){
            $product->slug = $product->slug.'-'.mt_rand(10000000,99999999);
        }

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options);

        //$variations = array();

        $product->save();

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        //Generates the combinations of customer choice options
        $combinations = combinations($options);
        if(count($combinations[0]) > 0 && $my_str != null){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                // $item = array();
                // $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                // $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                // $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                // $variations[$str] = $item;

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }
        //combinations end

        //$product->variations = json_encode($variations);

        // foreach (Language::all() as $key => $language) {
        //     $data = openJSONFile($language->code);
        //     $data[$product->name] = $product->name;
        //     saveJSONFile($language->code, $data);
        // }

	    if($product->save()){

            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('product.create')->withSuccess('Product added successfully');
            }
            else{
                return redirect()->route('seller.product')->withSuccess('Product added successfully');
            }
        }else{
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('product.create')->withError('Something went wrong');
            }
            else{
                return back()->with(['error'=>'Something went wrong','data'=>$data]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.products.form');
    }
    public function admin_product_edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        //dd(json_decode($product->price_variations)->choices_0_S_price);
        $tags = json_decode($product->tags);
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories', 'tags'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
            $data = $request->all();

            if($request->type == 'wholesale'){
            request()->validate([

            'name' => 'required',
            'category' => 'required',
            'items_per_bulk_price' => 'required',
            'bulk_price' =>'required',
            'unit_price' =>'required',
            'featured_img' => 'image|mimes:png,jpg,jpeg|max:2048'

            ]);
        }else{
            request()->validate([
    
                'name' => 'required',
                'category' => 'required',
                'unit_price' =>'required',
                'featured_img' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);
        }
        
        $product =Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->added_by = 'admin';
        if(Auth::user()->user_type == 'seller'){
            $product->user_id = Auth::user()->id;
            $product->added_by = 'seller';
        }
        else{
            $product->user_id = \App\User::where('user_type', 'admin')->first()->id;
        }
        $product->category_id = $request->category;
        $product->subcategory_id = $request->sub_category;
        $product->subsubcategory_id = $request->sub_subcategory;
        $product->brand_id = $request->brand;
        $product->current_stock = $request->quantity;
        $product->barcode = $request->barcode;
        $product->type = $request->type;

            if ($request->refundable != null) {
                $product->refundable = 1;
            }
            else {
                $product->refundable = 0;
            }

        if($request->has('previous_photos')){
            $photos = $request->previous_photos;
        }
        else{
            $photos = array();
        }

        if($request->hasFile('photos')){
            request()->validate(['photos' => 'image|mimes:png,jpg,jpeg|max:2048',]);
            foreach ($request->file('photos') as $photo) {
                $image = $photo;
                $input['imagename'] = time().'.'.$image->extension();
         
                $destinationPath = public_path('/storage/uploads/products/photos');
                $img = Image::make($image->path());
                $img->resize(680, 850, function ($constraint) {
                $constraint->aspectRatio();
                    
                })->save($destinationPath.'/'.$input['imagename']);
                $path = 'uploads/products/photos/'.$input['imagename'];
                array_push($photos, $path);
                //ImageOptimizer::optimize(base_path('public/').$path);
            }
            $product->photos = json_encode($photos);
        }
        
        $product->featured_img = $request->previous_featured_img;
        if($request->hasFile('featured_img')){
            $image = $request->file('featured_img');
            $input['imagename'] = time().'.'.$image->extension();
     
            $destinationPath = public_path('/storage/uploads/products/featured');
            $img = Image::make($image->path());
            $img->resize(290, 300, function ($constraint) {
            $constraint->aspectRatio();
                
            })->save($destinationPath.'/'.$input['imagename']);
            $product->featured_img = 'uploads/products/featured/'.$input['imagename'];
            // $product->featured_img = $request->file('featured_img')->store('uploads/products/featured');
            //ImageOptimizer::optimize(base_path('public/').$product->featured_img);
        }

        $product->unit = $request->unit;
        $product->tags = json_encode($request->tags);
        $product->type = $request->type;
        $product->description = $request->full_description;
        $product->specification = $request->specifications;
        $product->unit_price = $request->unit_price;
        $product->bulk_price = $request->bulk_price;
        $product->items_per_bulk_price = $request->items_per_bulk_price;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->weight = $request->weight;

        if ($request->publish == 1){
            $product->published = 1;
        }
        
        if($request->free_shipping == 1){
            $product->shipping_cost = 0;
            $product->shipping_type = 'free';
        }
        else{
            $product->shipping_cost = $request->shipping_cost;
            $product->shipping_type = 'flat_rate';
        }
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;

        if($request->hasFile('meta_img')){
            $product->meta_img = $product->featured_img;
            //ImageOptimizer::optimize(base_path('public/').$product->meta_img);
        }

        if($request->hasFile('pdf')){
            $product->pdf = $request->pdf->store('uploads/products/pdf');
        }

        // $slug = Str::of($request->name)->slug('-');
        
        // if($slug != $product->slug){
        //     $no_of_slugs = Product::where('slug',$slug)->count();
        //     if($no_of_slugs > 0 ){
        //         $product->slug = $slug.'-'.mt_rand(10000000,99999999);
        //     }
        // }else{
        //     $product->slug = $slug;
        // }

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options);

        //$variations = array();

        $product->save();

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        //Generates the combinations of customer choice options
        $combinations = combinations($options);
        if(count($combinations[0]) > 0 && $my_str != ''){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                // $item = array();
                // $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                // $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                // $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                // $variations[$str] = $item;

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }
        //combinations end

        //$product->variations = json_encode($variations);

        // foreach (Language::all() as $key => $language) {
        //     $data = openJSONFile($language->code);
        //     $data[$product->name] = $product->name;
        //     saveJSONFile($language->code, $data);
        // }

	    if($product->save()){

            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('product.create')->withSuccess('Product updated successfully');
            }
            else{
                return back()->with(['success'=>'Product updated successfully']);
            }
        }else{
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
                return redirect()->route('product.create')->withError('Something went wrong');
            }
            else{
                return back()->with(['error'=>'Something went wrong','data'=>$data]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail(decrypt($id));
        if(Product::destroy(decrypt($id))){

            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('product.create')->withSuccess('Product has been deleted successfully');
            }
            else{
                return back()->withSuccess('Product has been deleted successfully');
            }
        }
        else{
            return back()->withError('Something went wrong');
        }
    }


    public function sku_combination(Request $request)
    {
        $options = array();
        if(isset($request->colors) && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }else{
            $colors_active = 0;
        }
        

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //     $collection = collect($options);
        //  $combinations = $collection;

        $combinations = $this->combinations($options);
        
       return view('ajax.sku_combinations',['combinations'=>$combinations,'colors_active'=>$colors_active,'unit_price'=>$unit_price,'product_name'=>$product_name]);
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if($request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        
        if ($my_str != '' || $colors_active){

        $combinations = $this->combinations($options);
        return view('ajax.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
        }
    }

    public function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
    
      public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }
}
