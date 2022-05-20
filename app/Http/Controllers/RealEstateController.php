<?php

namespace App\Http\Controllers;
use App\Helpers\MimeCheckRules;
use App\EstateCategory;
use App\EstateCustomersRequest;
use App\EstateFeatures;
use App\EstateProperties;
use App\EstateSupportingImages;
use App\EstateTestimonials;
use App\State;
use App\Country;
use App\User;
use Carbon\Carbon;
use Image;
use \Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;


class RealEstateController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
    }
    
    //index controller
    public function index()
    {
        $data['page_title'] = 'Ebeano Real Estate Properties';
        $data['page_name'] = "homepage";
        $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("is_delete", 0)->paginate(9);
        $data['featured_properties'] = EstateProperties::limit(5)->get();
        $data['all_cities'] = EstateProperties::select("city")->groupBy('city')->get();
        $data['range_price'] = EstateProperties::select("price")->groupBy('price')->orderBy("price", "ASC")->get();
        $data['category'] = EstateProperties::select("category_id")->groupBy('category_id')->orderBy("category_id", "ASC")->get();
        $data['type'] = EstateProperties::select("type")->groupBy('type')->get();
        $data['categories'] = EstateCategory::get();
        $data['agents'] = User::limit(5)->where("user_type" , 'estate_agent')->where("subscribed",1)->get();
        
        return view('estate.welcome', $data);
    }
    
    //filter controller
    public function filterEstate($slug)
    {
        $data['all_cities'] = EstateProperties::select("city")->groupBy('city')->get();
        $data['range_price'] = EstateProperties::select("price")->groupBy('price')->orderBy("price", "ASC")->get();
        $data['category'] = EstateProperties::select("category_id")->groupBy('category_id')->orderBy("category_id", "ASC")->get();
        $data['type'] = EstateProperties::select("type")->groupBy('type')->get();
        $data['categories'] = EstateCategory::get();
        
        if($slug =='property-for-sale') {
            $data['page_title'] = 'Properties for Sale';
            $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("type", 'SALE')->where("is_delete", 0)->paginate(12);
            return view('estate.filter', $data);
            
        }else if($slug =='property-for-rent') {
            $data['page_title'] = 'Properties for Rent';
            $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("type", 'RENT')->where("is_delete", 0)->paginate(12);
            return view('estate.filter', $data);
            
        }else if($slug =='property-for-shortlet') {
            $data['page_title'] = 'Properties for Shortlet';
            $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("type", 'SHORTLET')->where("is_delete", 0)->paginate(12);
            return view('estate.filter', $data);
        
        }else if($slug =='land') {
            $data['page_title'] = 'Landed Properties';
            $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("type", 'LAND')->where("is_delete", 0)->paginate(12);
            return view('estate.filter', $data);
            
        }else if($slug =='agents') {
            $data['page_title'] = 'Estate Agents';
            $data['agents'] = User::where("user_type" , 'estate_agent')->where("subscribed",1)->paginate(12);
            return view('estate.agents', $data);
        
        }else {
            
            // by category
            $category = DB::table("estate_category")->where("id", $slug)->first();
            $data['page_title'] = $category->name.' Properties';
            $data['properties'] = EstateProperties::orderBy("featured", "DESC")->orderBy("id", "DESC")->where("category_id", $category->id)->where("is_delete", 0)->paginate(12);
            return view('estate.filter', $data);
        }
        
        abort(404);
    }
    
    
    //search controller
    public function searchEstate()
    {
        $data['page_title'] = 'Browse Properties';
        $data['all_cities'] = EstateProperties::select("city")->groupBy('city')->get();
        $data['range_price'] = EstateProperties::select("price")->groupBy('price')->orderBy("price", "ASC")->get();
        $data['category'] = EstateProperties::select("category_id")->groupBy('category_id')->orderBy("category_id", "ASC")->get();
        $data['type'] = EstateProperties::select("type")->groupBy('type')->get();
        $data['categories'] = EstateCategory::get();
        
        $keywords = "";
        if (!empty(Input::get("keywords"))) {
            $keywords = Input::get("keywords");
        }
        
        $type = "";
        if (!empty(Input::get("type"))) {
            $type = Input::get("type");
        }


        $cat = "";
        if (!empty(Input::get("category"))) {
            $cat = Input::get("category");
        }

        $range_price = 0;
        if (!empty(Input::get("range-price"))) {
            $range_price = Input::get("range-price");
        }
        $location = 0;
        if (!empty(Input::get("location"))) {
            $location = Input::get("location");
        }

        $query = EstateProperties::where("is_delete", 0);

        if (!empty($keywords)) {
            $query->where('title', 'like', "%$keywords%");
            $query->orWhere('address', 'like', "%$keywords%");
            $query->orWhere('zip', 'like', "%$keywords%");
            $query->orWhere('city', 'like', "%$keywords%");
            $query->orWhere('state', 'like', "%$keywords%");
            $query->orWhere('bath', 'like', "%$keywords%");
            $query->orWhere('bed', 'like', "%$keywords%");
        }
        
        if (!empty($range_price)) {
            $query->where('price', '<=', $range_price);
        }

        if (!empty($cat)) {
            $query->where('category_id', $cat);
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        $forms = array(
            "keywords" => $keywords,
            "type" => $type,
            "category" => $cat,
            "range_price" => $range_price,
            "location" => $location
        );
        
        $order = "new";
        $orderby = "id";
        $ordertype = "desc";
        if (!empty(Input::get("order"))) {
            $order = Input::get("order");

            if ($order == "priceh") {
                $orderby = "price";
                $ordertype = "desc";
            }

            if ($order == "pricel") {
                $orderby = "price";
                $ordertype = "asc";
            }
        }

        $query->orderBy($orderby, $ordertype);
        $properties = $query->paginate(12);
        
        $data['properties'] = $properties;
        return view('estate.search', $data);
            
    }
    
    // estate details
    public function showEstate($slug)
    {
        $data['property'] = EstateProperties::where(['slug'=>$slug, 'is_delete'=>0])->first(); 
        $data['page_title'] = $data['property']->title;
        if(!$data['property']) {
            return back()->with('error', 'Property does not exist');
        }
        $data['categories'] = EstateCategory::get();
        $data['features'] = DB::table("estate_features")->where("is_delete",0)->get();
        $data['agent'] = User::find($data['property']->agent_id);
        $data['property_photos'] = DB::table('estate_supporting_images')->where("property_id", $data['property']->id)->get();
        return view('estate.details', $data);
    }
    
    //dashboard controller
    public function dashboard()
    {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && !Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        $total_properties = DB::table("estate_properties")->where("is_delete",0)->where("agent_id", Auth::user()->id)->count();
        $featured_properties = DB::table("estate_properties")->where("is_delete",0)->where("featured",1)->where("agent_id", Auth::user()->id)->count();

        $total_customer_requets = DB::table("estate_customers_request")->where("agent_id", Auth::user()->id)->count();
        if (Auth::user()->user_type =='estate_agent') {
            $properties = DB::table("estate_properties")->where("is_delete",0)->where("agent_id", Auth::user()->id)->get();
            $property_ids = array();
            foreach ($properties as $pro) {
                $property_ids[] = $pro->id;
            }

            $customer_requets = DB::table("estate_customers_request")->where("agent_id", Auth::user()->id)->whereIn("property_id", $property_ids)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $customer_requets = DB::table("estate_customers_request")->where("agent_id", Auth::user()->id)->orderBy('id', 'DESC')->limit(10)->get();
        }

        $payments = DB::table("estate_property_payments")->select("amount")->where("agent_id", Auth::user()->id)->get();
        $data = array(
            "page_title" => 'Estate Agent Dashboard',
            "total_properties" => $total_properties,
            "featured_properties" => $featured_properties,
            "customer_requests" => $customer_requets,
            "total_customer_requests" => $total_customer_requets
        );
        
        return view('estate.agent.dashboard', $data);
    }
    
    // customers requests
    public function propertyCustomerRequest()
    {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && !Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        
        $customer_requets = DB::table("estate_customers_request")->where("agent_id", Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        $data = array(
            "page_title" => 'Customers Requests',
            "customer_requests" => $customer_requets
        );
        
        return view('estate.agent.property.request', $data);
    }
    
    // my properties
    public function allProperty() {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && !Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        $properties = EstateProperties::where('agent_id', Auth::user()->id)->paginate(25);
        
        $data = array(
            "page_title" => 'My Properties',
            "properties" => $properties,
        );
        
        return view('estate.agent.property.manage', $data);
    }
    
    // my featured properties
    public function featuredProperty() {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && !Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        $properties = EstateProperties::where('agent_id', Auth::user()->id)->where('featured', 1)->paginate(25);
        
        $data = array(
            "page_title" => 'Featured Properties',
            "properties" => $properties,
        );
        
        return view('estate.agent.property.featured', $data);
    }
    
    //create property controller
    public function createProperty()
    {
        if(!Auth::check()){
            return redirect('login/estate');
        }
        if(Auth::check() && !Auth::user()->user_type =='estate_agent'){
            return Redirect("login/estate")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        $properties = DB::table("estate_properties")->where("is_delete",0)->get();

        $categories = EstateCategory::where("is_delete",0)->get();
        $features = EstateFeatures::where("is_delete",0)->get();
        $agents = User::find(Auth::user()->id);
            
        $data = array(
            "page_title" => 'Create Property',
            "properties" => $properties,
            "features" => $features,
            "agents" => $agents,
            "categories" => $categories,
        );
        
        return view('estate.agent.property.create', $data);
    }
    
    
    /**
     * Property Edit.
     *
     */
    public function editProperty($id) {
        $property = EstateProperties::where(['id'=>$id])->first();
		
		if(!$property) { 
			return back()->with('error', 'Property does not exist');
		}
		if($property->agent_id != Auth::user()->id) { 
			return back()->with('error', 'Property does not exist');
		}
		Session::put("edit_property" , $property->user_id);
        $properties = EstateProperties::where("is_delete",0)->where("id", '!=', $id)->get();
        $categories = EstateCategory::where("is_delete",0)->get();
        $features = EstateFeatures::where("is_delete",0)->get();
        $agents = User::find(Auth::user()->id);

        $property_images = DB::table("estate_supporting_images")->where("property_id", $id)->get();

        $data = array(
            "page_title" => 'Edit Property',
            "property" => $property,
            "properties" => $properties,
            "property_images" => $property_images,
            "features" => $features,
            "agents" => $agents,
            "categories" => $categories,
        );
        
        return view('estate.agent.property.edit', $data);
    }

    /**
     * Property Store.
     *
     */
    public function createPropertyProcess(Request $request) {
        $id = $request->input("id");
        $data = array(
            "title" => $request->input("title"),
            "category_id" => $request->input("category_id"),
            "agent_id" => $request->input("agent_id"),
            "slug" => Str::slug($request->input("title"), '-'),
            "type" => $request->input("type"),
            "address" => $request->input("address"),
            "city" => $request->input("city"),
            "state" => $request->input("state"),
            "zip" => $request->input("zip"),
            "longitude" => $request->input("longitude"),
            "latitude" => $request->input("latitude"),
            "price" => $request->input("price"),
            "beds" => $request->input("bedrooms"),
            "bath" => $request->input("bathrooms"),
            "year" => $request->input("year"),
            "size" => $request->input("size"),
            "body" => $request->input("description")
        );

        if (!empty($request->input("features"))) {
            $data["features"] = implode(",", $request->input("features"));
        }

        if (!empty($request->input("related"))) {
            $data["related"] = implode(",", $request->input("related"));
        }
			$user_id = Auth::user()->id;
			if (!file_exists("assets/estate/images/uploads")) {
				$oldmask = umask(0);
				mkdir("assets/estate/images/uploads", 0777);
				umask($oldmask);
			}
			$destinationPath = "assets/estate/images/uploads/";
        if ($request->hasFile("mainfile")) {
            $fileName = rand(11111, 999999) . $user_id; // renameing image
            $request->file("mainfile")->move($destinationPath, "$fileName.jpg");
            $data["image_name"] = "$fileName.jpg";
            $path = public_path("assets/estate/images/uploads/$fileName.jpg");
            Image::make($path)->resize(
                    500, null, function ($constraint) {
                $constraint->aspectRatio();
            }
            )->save($path);
        }
		
        if ($id) {
			$data['updated_at'] = date("Y-m-d h:i:s");
            EstateProperties::where("id", $id)->update($data);
            $g_id = "eb-estate".$user_id;
            $data1 = array(
                "property_id" => $id,
                "g_id" => 0
            );
			$uploads_dir = "assets/estate/images/uploads/$id";
			if(!file_exists($uploads_dir)) { 
				$old = umask(0);
				mkdir("assets/estate/images/uploads/$id", 0777);
				umask($old);
			}
	
            DB::table("estate_supporting_images")->where("g_id", $g_id)->update($data1);
			foreach(glob("assets/estate/images/uploads/$g_id/*.*") as $file) {
				 $file_to_go = str_replace("$g_id/","$id/",$file);
					copy($file, $file_to_go);
			}
			
			return redirect()->route('estate.all.property')->withSuccess('Successfully updated');
        } else {
			$data['created_at'] = date("Y-m-d h:i:s");
            $insert_id = EstateProperties::insertGetId($data);
            $g_id = "eb-estate".$user_id;
            $data1 = array(
                "property_id" => $insert_id,
                "g_id" => 0
            );
            DB::table("estate_supporting_images")->where("g_id", $g_id)->update($data1);
			//rename(asset("assets/estate/images/uploads/$g_id"), asset("assets/estate/images/uploads/$insert_id"));
            
        }
        return redirect()->route('estate.dashboard')->withSuccess('Successfully created');
    }

    /**
     * Property Delete.
     *
     */
    public function delete($id) {
        $result = EstateProperties::where("id" , $id)->where("agent_id" , Auth::user()->id)->first();
		if($result) { 
			EstateProperties::where("id", $id)->delete();
		}
        return redirect()->route('estate.all.property')->withSuccess('Successfully deleted');
    }

    /**
     * Property File Upload by ajax.
     *
     */
    public function fileUpload() {
		$id = "eb-estate" . Auth::user()->id;
		if (!file_exists("assets/estate/images/uploads/$id")) {
			$oldmask = umask(0);
			mkdir("assets/estate/images/uploads/$id", 0777);
			umask($oldmask);
		}
        $files = Input::file('file');
        if ($files[0]->isValid()) {
            $destinationPath = "assets/estate/images/uploads/$id/";
            $fileName = rand(11111, 99999) . "_" . $id;
            $files[0]->move($destinationPath, "$fileName.jpeg");
            $path = public_path("assets/estate/images/uploads/$id/$fileName.jpeg");
            Image::make($path)->resize(
                    500, null, function ($constraint) {
                $constraint->aspectRatio();
            }
            )->save($path);
           
            $g_id = $id;
               
            $data = array(
                "property_id" => "",
                "image_name" => "$fileName.jpeg",
                "g_id" => $g_id
            );
            DB::table("estate_supporting_images")->insert($data);
            return 'Upload successfully';
        }
    }

    /**
     * Property Image Delete.
     *
     */
    function imageDelete($id) {
        $image = DB::table("supporting_images")->where('id', $id)->first();

        //unlink("assets/images/uploads/" . $property->user_id . "/" . $image->image_name);
        DB::table("supporting_images")->where('id', $id)->delete();
        return redirect("admin/listing/edit/" . $image->property_id);
    }

    
}