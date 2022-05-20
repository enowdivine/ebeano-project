<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Wallet;
use App\User;
use App\WalletWithdrawal;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Str;


class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::user()->id)->paginate(9);
        return view('pages.wallet', compact('wallets'));
    }

    public function recharge(Request $request)
    {
        $data['amount'] = $request->amount;

        $data['payment_method'] = $request->payment_option;
        $data['email']= $request->email;
        // $data['reference']= $request->reference;
        // dd($data);

        session()->put('payment_type', 'wallet_payment');
        $request->session()->put('payment_data', $data);

        if ($request->payment_option == 'paystack') {
            $payment = new PaymentController;
            return $payment->directToGateway($request);
            // $url = "https://api.paystack.co/transaction/initialize";
            // $fields = [
            //   'email' =>  $request->email,
            //   'amount' =>  $request->amount * 100
            // ];
            // $fields_string = http_build_query($fields);
            // //open connection
            // $ch = curl_init();
            
            // //set the url, number of POST vars, POST data
            // curl_setopt($ch,CURLOPT_URL, $url);
            // curl_setopt($ch,CURLOPT_POST, true);
            // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //   "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            //   "Cache-Control: no-cache",
            // ));
            
            // //So that curl_exec returns the contents of the cURL; rather than echoing it
            // curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            // //execute post
            // $result = curl_exec($ch);
            // $response = json_decode($result, true);
            // return redirect()->away($response['data']['authorization_url']);
        }

    }

    public function wallet_payment_done($payment_data, $payment_details){
        $user = \App\User::find(Auth::user()->id);
        $user->balance = $user->balance + $payment_data['amount'];
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $payment_data['amount'];
        $wallet->payment_method = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->save();

        Session::forget('payment_data');
        Session::forget('payment_type');

        Session::flash(__('Payment completed'))->success();
        return redirect()->route('wallet.index');
    }
    
        public function withdrawBalance(Request $request){
        
        $user_balance = Auth::user()->balance;
        
        if ($request->amount > $user_balance){
            return back()->withError('Your Balance is lower than requested amount');
        }

        $withdraw_request = new WalletWithdrawal;
        $withdraw_request->user_id = Auth::user()->id;
        $withdraw_request->amount = $request->amount;
        $withdraw_request->payment_info = $request->payment_info;
        $withdraw_request->trxn_id = Str::random(3).$request->orderID;

        $user = User::find(auth::user()->id);
        $user->balance -= $request->amount;
        if ($withdraw_request->save()) {
            if($user->save()){
            return redirect()->route('wallet.index')->withSuccess('Request has been sent successfully');
            }else{
              $withdraw = WalletWithdrawal::where('trxn_id',$withdraw_request->trxn_id)->first();
              WalletWithdrawal::destroy($withdraw->id);
              
            }
        }
        else{
            return back()->withError('Something went wrong');
        }
    }
}
