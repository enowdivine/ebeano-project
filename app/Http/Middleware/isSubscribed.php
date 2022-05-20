<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;


class isSubscribed
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
        if (Auth::check()) {
            $email = Auth::user()->email;
            if(Auth::user()->subscribed == 1){
            return $next($request);
            }
            else{
            session()->flush();
            Auth::logout();
            session()->put('vendor_email', $email);
            $msg = 'invalid access, please Subscribe first <a class="btn btn-block login-btn mb-4" href="'.route('vendor.login_payment').'">CLICK HERE</a>';
            return redirect('login')->withError(html_entity_decode($msg));
            }
        }
        else{
            session()->flush();
            Auth::logout();
            $msg = 'invalid access, please login first ';
            return redirect('login')->withError($msg);
        }
    }
}
