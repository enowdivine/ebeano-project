<?php

namespace App\Http\Controllers;
use App\Role;
use App\Seller;
use App\SellerWithdrawRequest;
use App\Staff;
use App\Bank;
use App\State;
use Validator, Redirect, Response;
use App\User;
use App\Store;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class SellerController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.sellers.index');
    }
    
    public function track()
    {
        //
        return view('seller.track');
    }
    
    public function trackPost(Request $request)
    {
        //
        $track_id = $request->input('order_id');
        
        $speedaf = new SpeedafController();
        
        $track_parameters =  [

        "mailNoList" => [$track_id]

        ];
        
        $response = $speedaf->track($track_parameters);
        
        return view('admin.sellers.track-product');
        
    }

    public function seller_dashboard()
    {
        //
        return view('seller.profile.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        
        
        return view('admin.sellers.form', ['states'=>$states, 'banks'=>$banks, 'countries'=>$countries]);
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
        $error=$success='';

        if (empty($request->input('password'))){
            $pass = '123456';
        }else {
            $pass = $request->input('password');
        }

        request()->validate([

            'store_name' => 'unique:stores,name',
            'email' => 'email|unique:users',
            $pass => 'min:6'

        ]);

        $data = $request->all();

        $user_data = array(
            'name' => $data['name'], 
            'email' => $data['email'], 
            'phone' => $data['phone'],
            'password' => Hash::make($pass),
            'address' => $data['address'],
            'city' => $data['city'], 
            'state_id' => $data['state'], 
            'country_id' => $data['country'],
            'user_type' => 'seller', 
            'phone' => $data['phone'],
        );

        if ($check = User::create($user_data)){

            $seller_data = array( 
                'user_id' => $check->id,
                'ref_method' => $data['referer'],
                'referral_code' => $data['ref_code'], 
                'verification_info' => 'Awaiting approval', 
                'bank_id' => $data['bank_name'],
                'bank_acc_name' => $data['bank_account_name'], 
                'bank_acc_no' => $data['bank_account_no'],
                'registered_by' => Auth::user()->id
    
            );

            if ($check= Seller::create($seller_data)) {

                $store_data = array(
                    'seller_id' => $check->id,
                    'name' => $data['store_name'], 
                    'slug' => Str::of($data['store_name'])->slug('-'), 
                    'description' => $data['store_desc'],
                    'address' => $data['store_address'],
                    'city' => $data['store_city'], 
                    'nearest_bus_stop' => $data['nearest_bus_stop'], 
                    'state_id' => $data['store_state'],
                    'country_id' => $data['store_country'], 
                    'market_id' => $data['market_place']
        
                );

                if (Store::create($store_data)){
                    $success = 'Registration successful and is pending verification by Admin';
                }else { 
                    $error = 'Error 103: Seller registration failed';
                }

            }else { 
                $error = 'Error 102: Seller registration failed';
            }
            
        } else { 
            $error= 'Error 101: Seller registration failed';
        }


        return redirect('eb-admin/sellers/create')->with(['data'=>$data, 'error'=>$error, 'success'=>$success]); 
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
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        
        
        return view('admin.sellers.edit', ['states'=>$states, 'banks'=>$banks, 'countries'=>$countries,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateInfo(Request $request, $id)
    {
        //
        $user_data = Seller::find($id);
        $user = User::find($user_data->user_id);
        if ($request->input('pwd_reset')== 1){
            $pass = '123456';
            request()->validate([
                $pass => 'min:6'
            ]);

            $user->password = Hash::make($pass);
        }



        $data = $request->all();
            $user->name = $data['name']; 
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user_data->user->state_id = $data['state'];
            $user->country_id = $data['country'];
            $user->phone = $data['phone'];

          if  ($user->save()){
            return redirect()->route('seller.edit',['id'=> $id])->withSuccess('Info Successfully updated');
          }else {
            return redirect()->route('seller.edit',['id'=> $id])->withError('Error 105: Update failed');
          }

    }
    public function updateBank(Request $request, $id)
    {
        //
        $data = $request->all();
        $seller_data = Seller::find($id);
        $seller_data->bank_name = $data['bank_name'];
        $seller_data->bank_acc_name = $data['bank_account_name']; 
        $seller_data->bank_acc_no = $data['bank_account_no'];
        if  ($seller_data->save()){
            return redirect()->route('seller.edit',['id'=> $id])->withSuccess('Bank Successfully updated');
          }else {
            return redirect()->route('seller.edit',['id'=> $id])->withError('Error 106: Update failed');
          }
    }

    public function sellerUpdateInfo(Request $request)
    {
        //
        $id = $request->seller_id;
        $user_data = Seller::find(decrypt($id));
        $user = User::find($user_data->user_id);
        $store_id = (Store::where('seller_id',$user_data->id)->first()) != null ? (Store::where('seller_id',$user_data->id)->first()->id): 0 ;
        $store = Store::find($store_id);
        if($store == null){
            $store = new Store;
            $store->seller_id = $user_data->id;
        }
        
        if ($request->input('pwd_reset')== 1){
            $pass = '123456';
            request()->validate([
                $pass => 'min:6'
            ]);

            $user->password = Hash::make($pass);
        }

        $data = $request->all();

        $user_data->bank_id = $data['bank_name'];
        if(Bank::where('code',$data['bank_name'])->first() != null ){
            $user_data->bank_id = Bank::where('code',$data['bank_name'])->first()->id;
        }
        $user_data->bank_acc_name = $data['bank_account_name'];
        $user_data->bank_acc_no = $data['bank_account_no'];
   


                $store->seller_id = $user_data->id;
                $store->name = $data['store_name'];
                $store->market_id = $data['market_place'];
                $store->slug = Str::of($data['store_name'])->slug('-');
                $store->description = $data['store_desc'];
                $store->address = $data['store_address'];
                $store->city = $data['store_city'];
                $store->nearest_bus_stop = $data['nearest_bus_stop'];
                $store->state_id = $data['store_state'];
                $store->country_id = $data['store_country'];



          if ($user_data->save() && $store->save()){
              
              $user->profile_completed = 1;
              $user->save();
              
            return redirect()->back()->withSuccess('Info Successfully updated');
          }else {
            return redirect()->back()->withError('Update failed, please complete all fields');
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
    }
    
    public function sellerEarning(){
        
        return view('seller.earning.index');
    }
    
    public function withdrawEarning(Request $request){
        
        $seller_earning = Seller::where('user_id',Auth::user()->id)->first()->admin_to_pay;
        
        if ($request->amount == 0 || $request->amount < 100){
            return back()->withError('Your Earning is too low');
        }
        
        if ($request->amount > $seller_earning){

            return back()->withError('Your earning is less than requested amount');
        }
        if (SellerWithrawRequest::where('user_id',Auth::user()->id)->first()!=null){
            $withdraw_request = SellerWithrawRequest::where('user_id',Auth::user()->id)->first();
            if ($withdraw_request->approved == 0 || $withdraw_request->paid == 0)
            {
                return back()->withError('You have a pending request');
                
            }
        }
        $seller_withdraw_request = new SellerWithdrawRequest;
        $seller_withdraw_request->user_id = Auth::user()->id;
        $seller_withdraw_request->amount = $request->amount;
        $seller_withdraw_request->method = $request->method;
        $seller_withdraw_request->trxn_id = Str::random(3).rand(100000000,999999999);
        $seller_withdraw_request->status = '0';
        $seller_withdraw_request->viewed = '0';
        if ($seller_withdraw_request->save()) {
            return redirect()->route('withdrawal.index')->withSuccess('Request has been sent successfully');
        }
        else{
            return back()->withError('Something went wrong');
        }
    }
    
    public function Stores(Request $request){

        return view('seller.store.index');
    }
    public function createStore(Request $request){
        $states = State::all();
        $countries = Country::all();
        return view('seller.store.form',['states'=>$states,'countries'=>$countries]);
    }
    public function addStore(Request $request){
        
        request()->validate([
            'store_name' => 'unique:stores,name',
            'state_id' => 'required',
            'market_id' => 'required'
        ]);

        $data = $request->all();
                //
        $seller_id = decrypt($request->seller_id);
        $user_data = Seller::find($seller_id);
        $user = User::find($user_data->user_id);
  
        $store = new Store;
        $store->seller_id = $user_data->id;
        $store->name = $data['store_name'];
        $store->market_id = $data['market_place'];
        $store->slug = Str::of($data['store_name'])->slug('-');
        $store->description = $data['store_desc'];
        $store->address = $data['store_address'];
        $store->city = $data['store_city'];
        $store->nearest_bus_stop = $data['nearest_bus_stop'];
        $store->state_id = $data['store_state'];
        $store->country_id = $data['store_country'];

      if ($store->save()){
        return redirect()->back()->withSuccess('Store Successfully Added');
      }else {
        return redirect()->back()->withError('Operation failed, please complete all fields');
      }
    }
    public function editStore(Request $request, $id){
        $edit = Store::find(decrypt($id));
        $states = State::all();
        $countries = Country::all();
        return view('seller.store.form',['edit'=>$edit,'states'=>$states,'countries'=>$countries]);
        
    }
    public function updateStore(Request $request){
            request()->validate([
                'store_name' => 'unique:stores,name',
                'state_id' => 'required',
                'market_id' => 'required'
            ]);
    
            $data = $request->all();
                    //
            $store_id = decrypt($data['store_id']) ;
            $store = Store::find($store_id);
    
            $store->name = $data['store_name'];
            $store->market_id = $data['market_place'];
            $store->slug = Str::of($data['store_name'])->slug('-');
            $store->description = $data['store_desc'];
            $store->address = $data['store_address'];
            $store->city = $data['store_city'];
            $store->nearest_bus_stop = $data['nearest_bus_stop'];
            $store->state_id = $data['store_state'];
            $store->country_id = $data['store_country'];
    
          if ($user_data->save() && $store->save()){
            return redirect()->back()->withSuccess('Store Successfully updated');
          }else {
            return redirect()->back()->withError('Update failed, please complete all fields');
          }        
    }
    public function deleteStore(Request $request){
        if (Store::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 111: Something went wrong');
        }
    }

}