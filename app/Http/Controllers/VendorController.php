<?php

namespace App\Http\Controllers;

use App\Role;
use App\Seller;
use App\Staff;
use App\Bank;
use App\State;
use Validator, Redirect, Response;
use App\User;
use App\Store;
use App\Country;
use App\Payment;
use App\Artisan;
use App\BookingClients;
use App\SubscriptionPlan;
use App\InstituteRegistrars;
use App\ArtisanCategory;
use App\Mart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    //
    public function Registration()
    {
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        $sub_plans = SubscriptionPlan::all();


        return view('seller.registration', ['states' => $states, 'banks' => $banks, 'countries' => $countries, 'sub_plans' => $sub_plans]);
    }

    public function quickRegistration()
    {
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        $sub_plans = SubscriptionPlan::all();

        return view('pages.vendor_reg', ['states' => $states, 'banks' => $banks, 'countries' => $countries, 'sub_plans' => $sub_plans]);
    }

    public function quickRegistrationStore(Request $request)
    {
        $error = $success = '';
        if ($request->continue != true){
            request()->validate([
    
                'name' => 'required',
                'email' => 'email|unique:users',
                'password' => 'min:6|required',
                'phone' => 'min:11',
    
            ]);
        }
        if ($request->vendor_type == 'sellers') {

            request()->validate([

                'business_name' => 'max:50|required',

            ]);
        }

        $data = $request->all();
        
        $user_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'referer' => $data['ref_code'],
            'password' => Hash::make($data['password']),
            'user_type' => ($data['vendor_type']=='flight_agent')?'booking_agent':$data['vendor_type'],
            'subscribed' => 1
            
        );
        $saved = 0;
        if ($request->continue != true && Auth::check()){
            $user_data = User::find(Auth::user()->id);
            $user_data->user_type = ($data['vendor_type']=='flight_agent')?'booking_agent':$data['vendor_type'];
            $user_data->subscribed = 1;
            if($user_data->save()){
                $check = $user_data;
                $saved = 1;
            }
        }else{
           if($check = User::create($user_data)){
               $saved = 1;
           }
               
        }
        // create user
        if ($saved) {

            
            //insert to artisans table
            if ($user_data['user_type'] == 'artisan') {
                          
                $vendor_data = array(
                    'user_id' => $check->id ?? '',
                    'referral_code' => $data['ref_code'],
                    'verification_info' => 'Awaiting approval',
                    'registered_by' => 0
    
                );
                
                if ($art = \App\Artisan::create($vendor_data)) {

                    $success = 'Registration successful and is pending verification by Admin';
                    //Session::put('vendor_email', $data['email']);
                    //Session::put('vendor_type', $user_data['user_type']);
                    //return $this->register_success();
                    return redirect()->route('login')->withSuccess('Registration was successful, Login now to complete your profile');
                    
                } else {

                    $error = 'Error 202: registration failed';
                }
                //insert to sellers table
            }
            
            //insert to institute table
            elseif ($user_data['user_type'] == 'institute_registrar') {
                
                // create user
                // $int = User::create($user_data);
            
                if ($reg = \App\InstituteRegistrars::create(
                        [
                            'user_id' => $check->id,
                            'verification_info' => 'Awaiting approval',
                            'referral_code' => $data['ref_code']
                        ]
                    )) {

                    $success = 'Registration successful and is pending verification by Admin';
                    //Session::put('vendor_email', $data['email']);
                    //Session::put('vendor_type', $user_data['user_type']);
                    //return $this->register_success();
                    return redirect()->route('login')->withSuccess('Registration was successful, Login now to complete your profile');
                    
                } else {

                    $error = 'Error 202: registration failed';
                }
                //insert to sellers table
            }
            elseif ($user_data['user_type'] == 'booking_agent' || $user_data['user_type'] == 'flight_agent') {
                $client_type = ($data['vendor_type']=='booking_agent')?1:2;
                
                // create user
                // $chk = User::create($user_data);
                if ($reg = \App\BookingClients::create(
                        [
                            'user_id' => $check->id,
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'client_type' => $client_type,
                            'first_name' => $data['name'],
                        ]
                    )) {

                    $success = 'Registration successful and is pending verification by Admin';
                    //Session::put('vendor_email', $data['email']);
                    //Session::put('vendor_type', $user_data['user_type']);
                    //return $this->register_success();
                    return redirect()->route('login')->withSuccess('Registration was successful, Login now to complete your profile');
                    
                } else {

                    $error = 'Error 202: registration failed';
                }
                //insert to sellers table
            }
            elseif ($user_data['user_type'] == 'seller') {
                
                // create user
                // $chck = User::create($user_data);
                
                $vendor_data = array(
                    'user_id' => $check->id ?? '',
                    'ref_method' => $data['referer'],
                    'referral_code' => $data['ref_code'],
                    'verification_info' => 'Awaiting approval',
                    'registered_by' => 0
    
                );
            
                if ($reg = Seller::create($vendor_data)) {

                    $store_data = array(
                        'seller_id' => $check->id,
                        'name' => $data['business_name'],
                        'slug' => Str::of($data['business_name'])->slug('-')
                       

                    );

                    if (Store::create($store_data)) {
                        $success = 'Registration successful and is pending verification by Admin';
                        //Session::put('vendor_email', $data['email']);
                        //Session::put('vendor_type', $user_data['user_type']);
                        //return $this->register_success();
                        
                      return redirect()->route('login')->withSuccess('Registration was successful, Login now to complete your profile');
                        
                        
                    } else {
                        $error = 'Error 203: registration failed';
                    }
                } else {
                    $error = 'Error 202: registration failed';
                }
            }else {
                
                // create user
                // $chk = User::create($user_data);
                $success = 'Registration successful and is pending verification by Admin';
                //Session::put('vendor_email', $data['email']);
                //Session::put('vendor_type', $user_data['user_type']);
                //return $this->register_success();
                return redirect()->route('login')->withSuccess('Registration was successful, Login now to complete your profile');
                
            }
            
        }

        // if nothing happens from the top, then redirect user back with error
        $error = 'Error 201: registration failed';
            
        return back()->with(['data' => $data, 'error' => $error]);
    }

    public function RegistraionStore(Request $request)
    {

        $error = $success = '';
        request()->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'min:6|required'

        ]);

        if ($request->vendor_type == 'seller') {

            request()->validate([

                'business_name' => 'required',
                'email' => 'required',
                'password' => 'min:6|required'

            ]);
        }

        $data = $request->all();

        $user_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'city' => $data['city'],
            'state_id' => $data['state'],
            'country_id' => $data['country'],
            'user_type' => ($data['vendor_type']=='flight_agent')?'booking_agent':$data['vendor_type'],
            'referer' => $data['ref_code']
        );

        if ($check = User::create($user_data)) {
            if (Auth::check() && (Auth::user()->user_type =='staff' || Auth::user()->user_type =='staff')){
                $admin_id = Auth::user()->id; 
            }else{
                $admin = User::where('user_type', 'admin');
                $admin_id = $admin->id;
            }
           
            if ($request->vendor_type == 'seller') {
                $seller_data = array(
                    'user_id' => $check->id,
                    'ref_method' => $data['referer'],
                    'referral_code' => $data['ref_code'],
                    'verification_info' => 'Awaiting approval',
                    'bank_name' => $data['bank_name'],
                    'bank_acc_name' => $data['bank_account_name'],
                    'bank_acc_no' => $data['bank_account_no'],
                    'registered_by' => $admin_id

                );

                if ($check = Seller::create($seller_data)) {

                    $store_data = array(
                        'seller_id' => $check->id,
                        'name' => $data['store_name'],
                        'slug' => Str::of($data['store_name'])->slug('-'),
                        'description' => $data['store_desc'],
                        'address' => $data['store_address'],
                        'city' => $data['store_city'],
                        'nearest_bus_stop' => $data['nearest_bus_stop'],
                        'state_id' => $data['store_state'],
                        'country_id' => $data['store_country']

                    );

                    if (Store::create($store_data)) {
                        $success = 'Registration successful and is pending verification by Admin';
                        session()->put('vendor_email', $data['email']);
                        session()->put('vendor_type', $data['vendor_type']);
                        return $this->register_success();
                    } else {
                        $error = 'Error 203: registration failed';
                    }
                } else {
                    $error = 'Error 202: registration failed';
                }
            }
             elseif ($request->vendor_type == 'institute_registrar') {
                $artisan_data = array(
                    'user_id' => $check->id,
                    'ref_method' => $data['referer'],
                    'referral_code' => $data['ref_code'],
                    'verification_info' => 'Awaiting approval',
                    'bank_id' => $data['bank_name'],
                    'bank_acc_name' => $data['bank_account_name'],
                    'bank_acc_no' => $data['bank_account_no'],
                    'registered_by' => $admin_id

                );

                if ($check = Artisan::create($artisan_data)) {

                        $success = 'Registration successful and is pending verification by Admin';
                        session()->put('vendor_email', $data['email']);
                        return $this->register_success();
                } else {
                    $error = 'Error 202: registration failed';
                }

            }
            
            elseif ($request->vendor_type == 'artisan') {
                $artisan_data = array(
                    'user_id' => $check->id,
                    'ref_method' => $data['referer'],
                    'referral_code' => $data['ref_code'],
                    'verification_info' => 'Awaiting approval',
                    'company_tagline' => $data['business_name'],
                    'company_description' => $data['business_desc'],
                    'bank_id' => $data['bank_name'],
                    'bank_acc_name' => $data['bank_account_name'],
                    'bank_acc_no' => $data['bank_account_no'],
                    'registered_by' => $admin_id,
                    'category_id' => $data['artisan_category']

                );

                if ($check = Artisan::create($artisan_data)) {

                        $success = 'Registration successful and is pending verification by Admin';
                        session()->put('vendor_email', $data['email']);
                        session()->put('vendor_type', $data['vendor_type']);
                        return $this->register_success();
                } else {
                    $error = 'Error 202: registration failed';
                }

            }  elseif ($request->vendor_type == 'booking_agent' || $request->vendor_type == 'flight_agent') {
                $user_id = User::whereEmail($data['email'])->first()->id;
                $client_type = ($request->vendor_type=='booking_agent')?1:2;
                $booking_data = [
                            'user_id' => $user_id,
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'client_type' => $client_type,
                            'first_name' => $data['name'],
                ];

                if (BookingClients::create($booking_data)) {
                    $success = 'Registration successful and is pending verification by Admin';
                    session()->put('vendor_email', $data['email']);
                    session()->put('vendor_type', $data['vendor_type']);
                    return $this->register_success();
                } else {
                    $error = 'Error 202: registration failed';
                }

            }
        } else {
            $error = 'Error 201: registration failed';
        }


        return back()->with(['data' => $data, 'error' => $error]);
    }

    public function loadInput(Request $request)
    {
        $type = $request->vendor_type;
        $category = ($type == 'seller') ? Mart::all() : ArtisanCategory::whereStatus(1)->get();
        return view('ajax.vendor_input', compact('type', 'category'));
    }

    public function loadPlan(Request $request)
    {
        $type = (($request->vendor_type == 'booking_agent')?'hotelier': $request->vendor_type );
        $sub_plan = SubscriptionPlan::where('category', $type)->first();
        return view('ajax.vendor_plan', compact('sub_plan'));
    }
    public function register_success()
    {
        return redirect()->route('vendor.payment');
        // return view('ajax.register_success');
    }

    public function vendor_payment(Request $request)
    {
        Session::put('payment_type', 'sub_payment');
        Session::put('payment_method', 'paystack');
        Session::put('route', 'vendor.payment');
        $data['email'] = Session::get('vendor_email');
        $vendor_type = ((Session::get('vendor_type') == 'booking_agent')?'hotelier': Session::get('vendor_type') );
        $data['amount'] = 2500;
        Session::put('sub_plan', 1);
        $sub_plan = SubscriptionPlan::where('category', $vendor_type )->first();
        
        if ($sub_plan != null){
            $data['amount'] = $sub_plan->price;
            Session::put('sub_plan', $sub_plan->id);
        }
        $request->session()->put('payment_data', $data);
        $payment = new PaymentController;
        return $payment->directToGateway($request);
    }

    public function payment_done($payment)
    {
        $user = User::where('email', $payment['data']['customer']['email'])->first();
        
        // return $user;
        $transaction = Payment::where('txn_code',$payment['data']['reference'])->first();
        $transaction->payment_details = json_encode($payment);
        $transaction->approved = 1;
        $transaction->save();
        
        $sub_plan = SubscriptionPlan::where('id', session()->get('sub_plan') )->first();
        $subscription = new \App\Subscription;
        $subscription->subscription_plan_id = $sub_plan->id;
        $subscription->user_id = $user->id;
        $subscription->active = 1;
        $subscription->expiration = strtotime(date('d-m-Y')) + ($sub_plan->duration * 24 * 60 * 60);
        $subscription->save();
        
        $user->subscribed = 1;
        $user->save();
        
        session()->forget('payment_method');
        session()->forget('payment_type');
        session()->forget('route');
        session()->forget('payment_data');
        session()->forget('vendor_email');
        session()->forget('sub_plan');

        return redirect()->route('login')->withSuccess('Payment was successful, your payment receipt was sent to the email provided. Login now to complete your profile');
    }
}
