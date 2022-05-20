<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
class isSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->user_type == 'seller')) {
            // $seller_id = \App\Seller::where('user_id',Auth::user()->id)->first()->id;
            // if(\App\Subscription::where('user_id', Auth::user()->id)->first() == null){
            //     Session::put('payment_type', 'sub_payment');
            //     Session::put('payment_method', 'paystack');
            //     Session::put('route', 'vendor.payment');
            //     $data['email'] = Session::get('vendor_email');
            //     $data['amount'] = 2500;
            //     $request->session()->put('payment_data', $data);
            //     $payment = new PaymentController;
            //     return $payment->directToGateway($request);
            // }

            // if(\App\Store::where('seller_id', $seller_id)->first() == null){
            //     return redirect()->route('user.update_profile');
            // }
            return $next($request);
        }
        else{

        return redirect('login')->withError('invalid access, please login first');
        }
    }
}
