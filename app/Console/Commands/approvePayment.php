<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wallet;
use App\Payment;
use App\User;

class approvePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will verify and approve payments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    private static $paystack_seckey = 'sk_live_a140cc931f10f72857cbfa365cd9e778d344525c';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
        return 0;
      } else {
        
        if(isset($response['data']['status']) && $response['data']['status'] == 'success'){
            $transaction = Payment::where('id',$transaction->id)->first();

            $user = User::where('id', $transaction->user_id)->first();

            $transaction->payment_details = json_encode($response);
            $transaction->approved = 1;
            if ($transaction->save()){
            
                if ($transaction->payment_type == 'sub_payment'){
                    $subscription = new \App\Subscription;
                    if (\App\Subscription::where('user_id',$transaction->user_id)->first()!=null){
                        $subscription = \App\Subscription::where('user_id',$transaction->user_id)->first();
                    }
                    $subscription->subscription_plan_id = $transaction->subscription_plan_id;
                    $subscription->user_id = $transaction->user_id;
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
                        //return 1;
                        return '1. '. $response['data']['email'];
                    }
                }
                
            }
            
        }
            $transaction = Payment::where('id',$transactions->id)->first();

            $transaction->payment_details = json_encode($response);
            $transaction->save();
      }
        } //paystack
        
    }
    
            return 0;
    }
}
