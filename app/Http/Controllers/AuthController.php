<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\User;
use App\Artisans;
use App\EstateCategory;
use App\EstateCustomersRequest;
use App\EstateFeatures;
use App\EstateProperties;
use App\EstateSupportingImages;
use App\EstateTestimonials;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }  
 
    public function register()
    {
        return view('register');
    }
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
            {
                return Redirect()->intended('eb-admin');
            }
            elseif(auth()->user()->user_type == 'seller')
            {
                return redirect()->intended('sellers/dashboard');
            }
            elseif(auth()->user()->user_type == 'artisan')
            {
                return redirect()->intended('/dashboard');
            }
            elseif(auth()->user()->user_type == 'booking_agent')
            {
                return redirect()->intended('/booking/agent/home');
            }
            elseif(auth()->user()->user_type == 'institute_registrar')
            {
                return redirect()->intended('/eforms/registrar/home');
            }
            elseif(auth()->user()->user_type == 'estate_agent')
            {
                return redirect()->intended('/estate/agent/home');
            }
            elseif(session('link') != null){
                return redirect(session('link'));
            }
            else{
                return redirect()->intended('dashboard');
            }
                
        }
        return Redirect("login")->with(['error'=>'Opps! You have entered invalid credentials']);
    }
 
    public function postRegister(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        ]);
         
        $data = $request->all();
 
        $check = $this->create($data);
       
        return Redirect("login")->withSuccess('Great! You have Successfully created an account');
    }
     
    public function dashboard()
    {
        if(Auth::check()){
            if(auth()->user()->user_type == 'artisan'){
                // for artisan, force profile completion
                // if(Auth::user()->artisan->category_id ==null){
                //     return redirect()->route('user.edit_profile')->with(['error'=>'Opps! Please, complete your profile']);
                // }
                if(auth()->user()->subscribed ==0) {
                    return redirect()->route('logout')->with(['error'=>'Opps! You do not have access']);
                }
                $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
                return view('artisans.index', $data);
                
            }elseif(auth()->user()->user_type == 'estate_agent'){
                
                if(auth()->user()->subscribed ==0) {
                    return redirect()->route('logout')->with(['error'=>'Opps! You do not have access']);
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
            return view('users.index');
        }
        return Redirect("login")->with(['error'=>'Opps! You do not have access']);
    }
 
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
     
    public function logout() {
        
        if(Auth::check() && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff'))
        {
            $redirect_link = 'login';
        }
        else{
            $redirect_link = '/';
        }
        session()->flush();
        Auth::logout();
        return Redirect($redirect_link);
    }
}
?>