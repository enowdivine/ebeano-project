<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\SubCategory;
use App\SubSubCategory;
use App\Brand;
use App\Market;
use App\Seller;
use App\Store;
use App\User;
use App\FlashDeal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class PagesController extends Controller
{
    //index controller
    public function index(){
        return view('pages.index');
    }

    public function dashboard(){
        
        return view('users.index');
    }   
    
    public function about_us(){
        
        return view('pages.about');
    }
    
    public function contact(){
        
        return view('pages.contact');
    }
    
    public function sendContactMail(Request $request){
        
         request()->validate([
            'email' => 'email|required',
            'message' => 'required'
        ]);
            $to ='contact@ebeanomarket.com';
            $from = $request->email;
            $name = $request->name;
            $subject = $request->subject;
            $message = $request->message;
            
            if(receive_email($to, $from,  $name, $subject,$message)){
                return back()->withSuccess('Your message was sent successfully, A Customer Care Rep will reply you As soon as possible');
            }else{
                return back()->withError('Error Sending message; if error persists, you can call us now');
            }
        
    }
    
    public function privacy_policy(){
        
        return view('pages.privacy_policy');
    }
    
     public function terms(){
        
        return view('pages.terms');
    }
    
     public function faq(){
        
        return view('pages.faq');
    }
    
     public function help(){
        
        return view('pages.help');
    }
    
     public function policy(){
        
        return view('pages.policy');
    }
    
    public function generateRefCode(){
        return view('pages.generate_ref_code');
    }
    
    public function generateSuccess(){
        $ref_code = session()->get('refCode');
        session()->forget('refCode');
        if (empty($ref_code)){
            return back();
        }
        return view('pages.generate_success',compact('ref_code'));
    }
    
    public function refStatistics(Request $request){
        $ref_code = $request->ref_code;
        return view('pages.view_reg_stat',['ref_code'=>$ref_code]);
    }
    
    public function storeRefCode(Request $request){
        $error = $success = '';
        request()->validate([

            'name' => 'required',
            'email' => 'email|required',

        ]);
        
        $data = $request->all();
        $refCode = 'EBN'.mt_rand(1001,9999);
        $user_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'ref_code' => $refCode
        );
        
        $user = User::where('email',$data['email'])->first();
        if ($user != null){
            if($user['ref_code'] != '0'){
                $error = 'This email address: <strong>'.$data['email'].'</strong> is already registered by <strong>'.$user['name'].'</strong> Code: <strong>'.$user['ref_code'].'</strong>';
                return back()->with(['data' => $data, 'error' => $error]);
            }
            $user->ref_code = $refCode;
            if ($user->save()){
                session()->put('refCode', $refCode);
                return redirect()->route('generate.success')->withSuccess('Generated Successfully');
            }else{
                $error = 'Error generating ref code';
            }
        }else{

            $user = \App\Marketer::where('email',$data['email'])->first();
            if($user != null){
                $error = 'This email address: <strong>'.$data['email'].'</strong> is already registered by <strong>'.$user['name'].'</strong> Code: <strong>'.$user['ref_code'].'</strong>';
                return back()->with(['data' => $data, 'error' => $error]);
            }
                
            if (\App\Marketer::create($user_data)){
                session()->put('refCode', $refCode);
                return redirect()->route('generate.success')->withSuccess('Generated Successfully');
            }else{
                $error = 'Error generating ref code';
            }
        }
        return back()->with(['data' => $data, 'error' => $error]);
    }
    
    public function wishlist(){
        $wishlists = \App\Wishlist::where('user_id', Auth::user()->id)->paginate(9);
        return view('pages.view_wishlist', compact('wishlists'));
    }
    
    
    //about controller
    public function login($type='default'){
        if (Auth::check()){
            
          return  redirect('dashboard');
        }
        $data['type'] = $type;
        if($type !=='default'){
            if($type=='artisan'){
                return view('pages.login', $data);
            }
            if($type=='booking'){
                return view('pages.login', $data);
            }
            if($type=='eforms'){
                return view('pages.login', $data);
            }
            if($type=='estate'){
                return view('pages.login', $data);
            }
            return redirect()->intended('login');
        }
        return view('pages.login', $data);
    }

    public function register($type='default'){
        if (Auth::check()){

          return  redirect('dashboard');
        }
        $data['type'] = $type;
        if($type !=='default'){
            if($type=='artisan'){
                return view('pages.signup', $data);
            }
            return redirect()->intended('register');
        }
        return view('pages.signup', $data);
    }

    public function cart_login(Request $request)
    {
        // Cart content update by discount setup


        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
        if($user != null){
            updateCartSetup();
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->user($user, true);
                }
                else{
                    auth()->user($user, false);
                }
            }
        }
        return back();
    }
    
    public function shop($slug,Request $request)
    {
        $shop  = Store::where('slug', $slug)->first();
        if($shop!=null){
            $seller = Seller::where('id', $shop->seller_id)->first();
            // if ($seller->verification_status != 0){
            //     return view('frontend.seller_shop', compact('shop'));
            // }
            // else{
                // return view('pages.product_listing', compact('shop', 'seller'));
            // }
            $request->seller_id = $seller->id;
            return $this->product_search($request);
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Store::where('slug', $slug)->first();
        if($shop!=null && $type != null){
            return view('pages.product_listing', compact('shop', 'type'));
        }
        abort(404);
    }
    
    public function product_listing(Request $request)
    {
        return $this->product_search($request);
    }

    public function product_listing_category(Request $request, $slug)
    {
        $request->category = $slug;
        return $this->product_search($request);
    }

    public function product_search(Request $request){

		// $key = $request->input('keyword');

		// $search_result = \App\Product::where('published',1)
		// 		->where('name','like','%'.$key.'%')
		// 		->orWhere('tag','like','%'.$key.'%')->get();

		// if (count($search_result) < 1){

		// 	$search_result = DB::table('products')
		// 		->leftJoin('categories', 'product.category_id', '=', 'categories.id')
		// 		->leftJoin('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
		// 		->leftJoin('subsubcategories', 'product.subsubcategory_id', '=', 'subsubcategories.id')
		// 		->where('published',1)
		// 		->where('categories.name', 'like', '%'.$key.'%')
		// 		->orWhere('subcategories.name', 'like', '%'.$key.'%')
		// 		->orWhere('subsubcategories.name', 'like', '%'.$key.'%')->get();
		// }

        // return view('pages.product_listing',['search_results'=>$search_result]);
        
        $query = $request->q;
        $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
        $sort_by = $request->sort_by;
        if ($sort_by == null) {
            $sort_by = 1;
        }
        
        $category_id = (Category::where('slug', $request->category)->first() != null) ? Category::where('slug', $request->category)->first()->id : null;
        $subcategory_id = (SubCategory::where('slug', $request->subcategory)->first() != null) ? SubCategory::where('slug', $request->subcategory)->first()->id : null;
        $subsubcategory_id = (SubSubCategory::where('slug', $request->subsubcategory)->first() != null) ? SubSubCategory::where('slug', $request->subsubcategory)->first()->id : null;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $featured = $request->featured;

        

        $conditions = ['published' => 1];

        if ($featured){
            $conditions = array_merge($conditions, ['featured' => $featured]);
        }

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }
        if($category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $category_id]);
        }
        if($subcategory_id != null){
            $conditions = array_merge($conditions, ['subcategory_id' => $subcategory_id]);
        }
        if($subsubcategory_id != null){
            $conditions = array_merge($conditions, ['subsubcategory_id' => $subsubcategory_id]);
        }
        if($seller_id != null){
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = Product::where($conditions)->where('unit_price','<>',0)->where('featured_img','<>',null);

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price)->where($conditions)->where('unit_price','<>',0)->where('featured_img','<>',null);
        }

        if($query != null){
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where($conditions)->where('unit_price','<>',0)->where('featured_img','<>',null)->where('name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%');
        }

        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case '4':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }


        $non_paginate_products = $products->get();

        //Attribute Filter

        $attributes = array();
        foreach ($non_paginate_products as $key => $product) {
            if($product->attributes != null && is_array(json_decode($product->attributes))){
                foreach (json_decode($product->attributes) as $key => $value) {
                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if($attribute['id'] == $value){
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if(!$flag){
                        $item['id'] = $value;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    }
                    else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                foreach ($choice_option->values as $key => $value) {
                                    if(!in_array($value, $attributes[$pos]['values'])){
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $selected_attributes = array();

        foreach ($attributes as $key => $attribute) {
            if($request->has('attribute_'.$attribute['id'])){
                foreach ($request['attribute_'.$attribute['id']] as $key => $value) {
                    $str = '"'.$value.'"';
                    $products = $products->where('choice_options', 'like', '%'.$str.'%');
                }

                $item['id'] = $attribute['id'];
                $item['values'] = $request['attribute_'.$attribute['id']];
                array_push($selected_attributes, $item);
            }
        }


        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {
            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if(!in_array($color, $all_colors)){
                        array_push($all_colors, $color);
                    }
                }
            }
        }

        $selected_color = null;

        if($request->has('color')){
            $str = '"'.$request->color.'"';
            $products = $products->where('colors', 'like', '%'.$str.'%');
            $selected_color = $request->color;
        }


        $products = $products->paginate(12)->appends(request()->query());

        return view('pages.product_listing', compact('products', 'query','featured','category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price', 'attributes', 'selected_attributes', 'all_colors', 'selected_color'));
    
    }

    //ajax search
    public function ajax_search(Request $request)
    {
        function verified_sellers_id() {
            return Seller::where('verification_status', 1)->get()->pluck('seller_id')->toArray();
        }

        $keywords = array();
        $products = Product::where('published', 1)->where('tags', 'like', '%'.$request->search.'%')->orWhere('name', 'like', '%'.$request->search.'%')->get();
        foreach ($products as $key => $product) {
            foreach (explode(',',$product->tags) as $key => $tag) {
                if(stripos($tag, $request->search) !== false){
                    if(sizeof($keywords) > 5){
                        break;
                    }
                    else{
                        if(!in_array(strtolower($tag), $keywords)){
                            array_push($keywords, strtolower($tag));
                        }
                    }
                }
            }
        }

        $products = Product::where('published', 1)->where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        $subsubcategories = SubSubCategory::where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        $shops = Store::whereIn('seller_id', verified_sellers_id())->where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        if(sizeof($keywords)>0 || sizeof($subsubcategories)>0 || sizeof($products)>0 || sizeof($shops) >0){
            return view('ajax.search_content', compact('products', 'subsubcategories', 'keywords', 'shops'));
        }
        return '0';
    }

    public function single_product(Request $request, $slug)
    {
        
            function single_price($price)
            {
                return number_format($price,2);
            }


        $detailedProduct  = Product::where('slug', $slug)->first();
        $preview = 0;
        
        if (isset($request->preview)){
            $preview = 1;
        }
        
        if($detailedProduct!=null && ($detailedProduct->published || $preview == 1)){

            $category_id = (Category::where('slug', $request->category)->first() != null) ? Category::where('slug', $request->category)->first()->id : null;
            $subcategory_id = (SubCategory::where('slug', $request->subcategory)->first() != null) ? SubCategory::where('slug', $request->subcategory)->first()->id : null;
            $subsubcategory_id = (SubSubCategory::where('slug', $request->subsubcategory)->first() != null) ? SubSubCategory::where('slug', $request->subsubcategory)->first()->id : null;
            // updateCartSetup();
           
            return view('pages.single_product', compact('detailedProduct'));
        }
        //abort(404);
        return redirect()->back();
    }
    
    public function seller_product_view(Request $request, $id){
        $request->preview = 1;
        $slug = Product::where('id', decrypt($id))->first()->slug;
        return $this->single_product($request, $slug);
    }
    
    public function admin_product_view(Request $request, $id){
        $request->preview = 1;
        $slug = Product::where('id', decrypt($id))->first()->slug;
        return $this->single_product($request, $slug);
    }
    
    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;

        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
            else{
                $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
        }

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;
        }
        else{
            $price = $product->unit_price;
            $quantity = $product->current_stock;
        }

        //discount calculation
        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $key => $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return array('price' => single_price($price*$request->quantity), 'quantity' => $quantity);
    }

    public function flash_deal_details($slug)
    {
        $flash_deal = FlashDeal::where('slug', $slug)->first();
        if($flash_deal != null)
            return view('frontend.flash_deal', compact('flash_deal'));
        else {
            abort(404);
        }
    }

    public function featured_product(Request $request){

        $request->featured = 1;

        return $this->product_search($request);
    }
    
    public function get_category_items(Request $request){
        $category = Category::findOrFail($request->id);
        return view('ajax.category_elements', compact('category'));
    }
    
    public function get_markets_by_state(Request $request){
        $markets = Market::where('state_id', $request->state_id)->get();
        return $markets;
    }
    
    public function verify_account(Request $request){

        $account_no = $request->account_no;
        $bank_code = $request->bank_code;
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        
          CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=".$account_no."&bank_code=".$bank_code,
        
          CURLOPT_RETURNTRANSFER => true,
        
          CURLOPT_ENCODING => "",
        
          CURLOPT_MAXREDIRS => 10,
        
          CURLOPT_TIMEOUT => 30,
        
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        
          CURLOPT_CUSTOMREQUEST => "GET",
        
          CURLOPT_HTTPHEADER => array(
        
            "Authorization: Bearer sk_live_a140cc931f10f72857cbfa365cd9e778d344525c",
        
            "Cache-Control: no-cache",
        
          ),
        
        ));
        
        $response = curl_exec($curl);
        
        $err = curl_error($curl);
        
        curl_close($curl);
        
        
        
        if ($err) {
        
          return "cURL Error #:" . $err;
        
        } else {
        return $response;
        
        }
    }
}
