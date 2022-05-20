<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Wallet;
use App\Payment;
use App\User;
class PaymentController extends Controller
{
    private static $paystack_seckey = 'sk_live_a140cc931f10f72857cbfa365cd9e778d344525c';
    /**
     * Redirect the User to Paystack Payment Page 
     * @return Url
     */
    public function AutoApprovePayment(Request $request){
        $transactions = Payment::where('approved', 0)->where('payment_details',null)->get();
    foreach ($transactions as $transaction) {       
        if ($transaction->payment_method == 'paystack'){ 
        
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$transaction->txn_code,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".self::$paystack_seckey,
          "Cache-Control: no-cache",
        ),
      ));
      
      $result = curl_exec($curl);
    $response = json_decode($result, true);
      $err = curl_error($curl);
      curl_close($curl);
      
      if ($err) {

        return back()->with(['error'=>$err]);
      } else {
        
        if($response['data']['status'] == 'success'){
            $transaction = Payment::where('id',$transaction->id)->first();
            // if ($transaction->approved == 0){
            //     return back()->with(['error'=>'Payment already approved!']);
            // }
            $user = User::where('id', $transaction->user_id)->first();

            $transaction->payment_details = json_encode($response);
            $transaction->approved = 1;
            if ($transaction->save()){
            
                if ($transaction->payment_type == 'sub_payment'){
                    $subscription = new \App\Subscription;
                    if (\App\Subscription::where('user_id',$user->id)->first()!=null){
                        $subscription = \App\Subscription::where('user_id',$user->id)->first();
                    }
                    $subscription->subscription_plan_id = $transaction->subscription_plan_id;
                    $subscription->user_id = $user->id;
                    $subscription->active = 1;
                    $subscription->expiration = strtotime(date('d-m-Y',strtotime($response['data']['paid_at']))) + (90 * 24 * 60 * 60);
                    $subscription->save();
                    
                    $user->subscribed = 1;
                    if ($user->save()){
                    //   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                    }
                }elseif($request->payment_type == 'wallet_payment') {
                    $user->balance = $user->balance + ($response['data']['amount'] / 100);
                    $user->save();
            
                    $wallet = new Wallet;
                    $wallet->user_id = $user->id;
                    $wallet->amount = $response['data']['amount'] / 100;
                    $wallet->payment_method = $request->payment_method;
                    $wallet->payment_details = json_encode($response);
                    if($wallet->save()){
                    //   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                    }
                }
                
            }else{
                // return back()->with(['error'=>'Error approving payment']);
            }
            
        }
            $transaction = Payment::where('id',$transactions->id)->first();

            $transaction->payment_details = json_encode($response);
            $transaction->save();
        // return back()->with(['error'=>'Payment was not successful']);
      }
    //   return back()->with(['error'=>'Gateway init failed']);
        } //paystack
    }
    
    return back()->with(['error'=>'Select Payment method']);
    }
    public function ApprovePayment(Request $request){
        
        request()->validate([

                'reference' => 'required',
                'payment_method' => 'required'

            ]);
            
    if ($request->payment_method == 'paystack'){ 
        
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$request->reference,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".self::$paystack_seckey,
          "Cache-Control: no-cache",
        ),
      ));
      
      $result = curl_exec($curl);
    $response = json_decode($result, true);
      $err = curl_error($curl);
      curl_close($curl);
      
      if ($err) {

        return back()->with(['error'=>$err]);
      } else {
        
        if($response['data']['status'] == 'success'){
            $transaction = Payment::where('txn_code',$request->reference)->first();
            if ($transaction['approved'] == 1){
                return back()->with(['error'=>'Payment already approved!']);
            }
            $user = User::where('email', $response['data']['customer']['email'])->first();
            // if ($transaction == null){
            //     $transaction = new Payment;
            //     $transaction->user_id = $user->id;
            //     $transaction->amount = $response['data']['amount'] / 100;
            //     $transaction->payment_method = $request->payment_method;
            //     $transaction->payment_type = $request->payment_type;
            //     $transaction->txn_code = $response['data']['reference'];
                
            // }
            
            $transaction->payment_details = json_encode($response);
            $transaction->approved = 1;
            if ($transaction->save()){
            
            if ($request->payment_type == 'sub_payment'){
                $subscription = new \App\Subscription;
                if (\App\Subscription::where('user_id',$user->id)->first()!=null){
                    $subscription = \App\Subscription::where('user_id',$user->id)->first();
                }
                
                $subscription->subscription_plan_id = 1;
                
                if ($transaction->subscription_plan_id != 0){
                    $subscription->subscription_plan_id = $transaction->subscription_plan_id;
                }
                
                $subscription->user_id = $user->id;
                $subscription->active = 1;
                $subscription->expiration = strtotime(date('d-m-Y',strtotime($response['data']['paid_at']))) + (90 * 24 * 60 * 60);
                $subscription->save();
                
                $user->subscribed = 1;
                if ($user->save()){
                   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                }
            }elseif($request->payment_type == 'wallet_payment') {
                $user->balance = $user->balance + ($response['data']['amount'] / 100);
                $user->save();
        
                $wallet = new Wallet;
                $wallet->user_id = $user->id;
                $wallet->amount = $response['data']['amount'] / 100;
                $wallet->payment_method = $request->payment_method;
                $wallet->payment_details = json_encode($response);
                if($wallet->save()){
                   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                }
            }elseif($request->payment_type == 'order_payment') {
                $user = User::where('email', $payment['data']['customer']['email'])->first();
        
        // return $user;
        $transaction = Payment::where('txn_code',$payment['data']['reference'])->first();
        $transaction->payment_details = json_encode($payment);
        $transaction->approved = 1;
        $transaction->save();
        
        $order = Order::findOrFail($transaction->order_id);
        $buyer_info  = json_decode($order->shipping_address);
        $ordersD = OrderDetail::where('order_id', $order->id)->first();
        
        //Get product details
        $pro = Product::where('id', $ordersD->product_id)->first();
        
        $speedaf_price = $pro->unit_price * $ordersD->quantity;
        
        $speedaf_weight = $pro->unit_price * $ordersD->weight;
        
        
        //Initiate Speedaf to deliver products
        $speedaf = new SpeedafController;
        
        $orderID = mt_rand(111111111, 999999999);
        
        //prepare data to send
        $data = [

        "acceptAddress" => $buyer_info->address ,

        "acceptCityCode" => $buyer_info->city ,

        "acceptCityName" => $buyer_info->city ,

        "acceptCompanyName" => "EbeanoMarket" ,

        "acceptCountryCode" => "NG" ,

        "acceptCountryName" => "Nigeria" ,

        "acceptDistrictCode" => "acceptDistrictCode" ,

        "acceptDistrictName" => "acceptDistrictName" ,

        "acceptEmail" => $buyer_info->email ,

        "acceptMobile" => $buyer_info->phone ,

        "acceptName" => "acceptName" ,

        "acceptPhone" => "999999" ,

        "acceptPostCode" => "acceptPostCode" ,

        "acceptProvinceCode" => "acceptProvinceCode" ,

        "acceptProvinceName" => "acceptProvinceName" ,

        "codFee" => 700 ,

        "customOrderNo" => $orderID ,

        "customerCode" => "2340002" ,

        "goodsDesc" => (String) $pro->description ,

        "goodsHigh" => 0 ,

        "goodsLength" => 0 ,

        "goodsName" => (String) $pro->name ,

        "goodsPrice" => $speedaf_price ,

        "goodsQTY" => (int) $ordersD->quantity ,

        "goodsValue" => 100 ,

        "goodsVolume" => (int) $ordersD->quantity ,

        "goodsWeight" => $speedaf_weight ,

        "goodsWidth" => 0 ,

        "insurePrice" => 0 ,

        "itemList" => [

                [

                        "battery" => 0 ,

                        "blInsure" => 0 ,

                        "dutyMoney" => 1000 ,

                        "goodsId" => "19999" ,

                        "goodsMaterial" => "" ,

                        "goodsName" => "item mane" ,

                        "goodsNameDialect" => "item namme" ,

                        "goodsQTY" => 1 ,

                        "goodsRemark" => "goodsRemark" ,

                        "goodsRule" => "goodsRule" ,

                        "goodsType" => "IT02" ,

                        "goodsUnitPrice" => 1 ,

                        "goodsValue" => 1 ,

                        "goodsWeight" => 1 ,

                        "high" => 1 ,

                        "length" => 1 ,

                        "makeCountry" => "makeCountry" ,

                        "salePath" => "salePath" ,

                        "sku" => "sku001" ,

                        "unit" => "" ,

                        "width" => 1

                ]

        ],

        "piece" => 1 ,

        "remark" => "1" ,

        "sendAddress" => "sendAddress" ,

        "sendCityCode" => "sendCityCode" ,

        "sendCityName" => "sendCityName" ,

        "sendCompanyName" => "sendCompanyName" ,

        "sendCountryCode" => "CN" ,

        "sendCountryName" => "CHINA" ,

        "sendDistrictCode" => "sendDistrictCode" ,

        "sendDistrictName" => "sendDistrictName" ,

        "sendMail" => "sendMail" ,

        "sendMobile" => "sendMobile" ,

        "sendName" => "sendName" ,

        "sendPhone" => "sendPhone" ,

        "sendPostCode" => "sendPostCode" ,

        "sendProvinceCode" => "sendProvinceCode" ,

        "sendProvinceName" => "sendProvinceName" ,

        "shippingFee" => 1 ,

     "deliveryType" => "DE01" ,

     "payMethod" => "PA01" ,

  "parcelType" => "PT01" ,

     "shipType" => "ST01" ,

     "transportType" => "TT01" ,

     "platformSource" => "csp" ,

     "smallCode" => "" ,

     "threeSectionsCode" => ""

    ];
        $value_log = $speedaf->InitiateOrder($data);
        
        //Save Order ID
        $ordersD->track_id = $value_log['billCode'];
        
        //Save Biller ID
        $ordersD->bill_id = $value_log['customerOrderNo'];
        
        //Save Status Order
        $ordersD->track_status = $value_log['success'];

        if ($ordersD->save()){
            return back()->with(['success'=>'Payment was verified and approved successfully']); 
        }
            }
            
            }else{
                return back()->with(['error'=>'Error approving payment']);
            }
            
        }
            $transaction = Payment::where('id',$transaction->id)->first();
            $transaction->payment_details = json_encode($response);
            $transaction->save();
            
            return back()->with(['error'=>$response['data']['message']]);
      }
      return back()->with(['error'=>'Gateway init failed']);
    } //paystack
    
    if ($request->payment_method == 'cash'){
        
        request()->validate([
                'reference' => 'email',
                'amount' => 'required',
                'payment_info' => 'required'
            ]);
        $user = User::where('email', $request->reference)->first();
        if ($user == null){
        return back()->with(['error'=>'User not found, check the email and try again']);
        }
                $transaction = new Payment;
                $transaction->user_id = $user->id;
                $transaction->amount = $request->amount;
                $transaction->payment_method = $request->payment_method;
                $transaction->payment_type = $request->payment_type;
                $transaction->txn_code = 'cash'.strtotime('now') ;

            $transaction->payment_details = $request->payment_info;
            $transaction->approved = 1;
            if ($transaction->save()){
            
            if ($request->payment_type == 'sub_payment'){
                $subscription = new \App\Subscription;
                if (\App\Subscription::where('user_id',$user->id)->first()!=null){
                    $subscription = \App\Subscription::where('user_id',$user->id)->first();
                }
                $subscription->subscription_plan_id = 1;
                $subscription->user_id = $user->id;
                $subscription->active = 1;
                $subscription->expiration = strtotime(date('d-m-Y',strtotime('now'))) + (90 * 24 * 60 * 60);
                $subscription->save();
                
                $user->subscribed = 1;
                if ($user->save()){
                   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                }
            }elseif($request->payment_type == 'wallet_payment') {
                $user->balance = $user->balance + ($request->amount);
                $user->save();
        
                $wallet = new Wallet;
                $wallet->user_id = $user->id;
                $wallet->amount = $request->amount;
                $wallet->payment_method = $request->payment_method;
                $wallet->payment_details = $request->payment_info;
                if($wallet->save()){
                   return back()->with(['success'=>'Payment was verified and approved successfully']); 
                }
            }
            
            }else{
                return back()->with(['error'=>'Error approving payment']);
            } 
        
    }
    
    return back()->with(['error'=>'Select Payment method']);
    }
    public function AuthorizationUrl($fields){
        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer ".self::$paystack_seckey,
          "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        $response = json_decode($result, true);
        // return $response;
        
        $user = User::where('email', $fields['email'])->first();
        $transaction = new Payment;
        $transaction->user_id = $user->id;
        $transaction->amount = $fields['amount'] / 100;
        $transaction->payment_method = Session::get('payment_method');
        $transaction->payment_type = Session::get('payment_type');
        
        if (Session::has('sub_plan')){
            $transaction->subscription_plan_id = Session::get('sub_plan');
        }
        
        if (Session::has('order_id')){
            $transaction->order_id = Session::get('order_id');
        }
        
        $transaction->approved = 0;
        $transaction->txn_code = $response['data']['reference'];
        $transaction->save();
        
        return redirect()->away($response['data']['authorization_url']);
    }

    public function directToGateway(Request $request)
    {

        // try{   

            if(Session::get('payment_type') == 'wallet_payment'){
                $fields = [
                    'email' =>  $request->email,
                    'amount' =>  $request->amount * 100
                ];
                return $this->AuthorizationUrl($fields);
            }  elseif(Session::get('payment_type') == 'sub_payment'){
                $fields = [
                    'email' =>  $request->session()->get('payment_data')['email'],
                    'amount' =>  round(Session::get('payment_data')['amount'] * 100)
                ];
                return $this->AuthorizationUrl($fields);
            } 
            
             elseif(Session::get('payment_type') == 'order_payment'){
                $fields = [
                    'email' =>  $request->session()->get('payment_data')['email'],
                    'amount' =>  round(Session::get('payment_data')['amount'] * 100)
                ];
                return $this->AuthorizationUrl($fields);
            } 
                
        // }catch(\Exception $e) {
        //     return Redirect::route('login')->with(['error'=>'The paystack token has expired. Please try logging in and follow the instructions.']);
        // }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        // try{
            
            $transactionRef = request()->query('trxref');
            $paymentDetails = $this->verifyTransactionPaystack($transactionRef);
            //$paymentDetails = Paystack::getPaymentData();
            
            // dd($paymentDetails);

            if (Session::get('payment_type') == 'wallet_payment') {
                
                $payment = $paymentDetails;
                if(!empty($payment['data']) && $payment['data']['status'] == 'success'){
    
                    $walletController = new WalletController;
                    return $walletController->wallet_payment_done(Session::get('payment_data'), $payment);
                }
                Session::forget('payment_data');
                session()->flash(__('Payment cancelled'))->success();
                return redirect()->route('home');
                
            }elseif(Session::get('payment_type') == 'sub_payment'){
                $payment = $paymentDetails;
                if(!empty($payment['data']) && $payment['data']['status'] == 'success'){
                    
                    //dd($payment);
                    $vendorController = new VendorController;
                    return $vendorController->payment_done($payment);
                    
                }
                 Session::forget('payment_data');
                session()->forget('payment_type');
                session()->forget('route');
                session()->forget('payment_data');
                session()->forget('vendor_email');
                session()->forget('sub_plan');
                session()->flash('error','Payment cancelled, try logging in to retry payment');
                return redirect()->route('login');
            }
            
            elseif(Session::get('payment_type') == 'order_payment'){
                $payment = $paymentDetails;
                if(!empty($payment['data']) && $payment['data']['status'] == 'success'){
                    
                    //dd($payment);
                    $orderController = new OrderController;
                    return $orderController->payment_done($payment);
                    
                }
                Session::forget('payment_data');
                session()->forget('payment_type');
                session()->forget('payment_data');
                session()->forget('email');
                $order = Order::findOrFail($request->session()->get('order_id'));
                $shipping_info = json_decode($order->shipping_address);
                $error = 'Payment cancelled, try logging in to retry payment';
                return view('pages.checkout',compact('error', 'success', 'saved' , 'shipping_info'));
            }
            // Now you have the payment details,
            // you can store the authorization_code in your db to allow for recurrent subscriptions
            // you can then redirect or do whatever you want
        
        // }catch(\Exception $e) {
        //     return Redirect::route(Session::get('route')??'login')->with(['error'=>'The paystack token has expired. Please refresh the page and try again.']);
        // } 
    }
    
    
    private function verifyTransactionPaystack($trxref)
    {
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$trxref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer ".self::$paystack_seckey,
              "Cache-Control: no-cache",
            ),
        ));
      
        $result = curl_exec($curl);
        $response = json_decode($result, true);
        $err = curl_error($curl);
        curl_close($curl);
      
        if ($err) {
            return false;
        } else {
            return $response;
        }
    }
}
