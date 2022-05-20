<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use DB;

class ForgotPasswordController extends Controller
{
    
    public function showLinkRequestForm()
    {
        $data['page_title'] = "Send Link password";
        return view('pages.forgotpass',$data);
    }

    public function sendResetLinkEmail(Request $request)
    {
        request()->validate([
            'email' => 'email|required',

        ]);
        $us = User::whereEmail($request->email)->count();
        if ($us == 0)
        {
            $notification =  array('error' => 'We can\'t find a user with that e-mail address.','alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }else{
            $user = User::whereEmail($request->email)->first();
            $to =$user->email;
            $name = $user->name;
            $subject = 'Password Reset';
            $code = Str::random(30);

            $link = url('/user-password/').'/reset/'.$code;

            $message = "Click on the Link below to Reset your Password: <br><br>";
            $message .= "<a style='background: #eb790f; color: #fff; text-align: center; text-decoration: none; padding-top:10px; padding-bottom:10px; padding-left: 16px; padding-right: 16px; border-radius: 5px; margin-bottom: 10px;' href='".$link."'>Reset Your Password</a>";


            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );

            send_email($to,  $name, $subject,$message);
            
            $notification =  array(
                'success' => 'Password reset link has been sent to your E-mail',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
