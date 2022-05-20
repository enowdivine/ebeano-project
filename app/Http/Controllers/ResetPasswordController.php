<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\PasswordReset;

class ResetPasswordController extends Controller
{
    
    protected $redirectTo = '/login';

    public function showResetForm(Request $request, $token)
    {
        $data['page_title'] = "Change Password";
         $tk =PasswordReset::where('token',$token)->where('status',0)->first();
        
         if(is_null($tk))
         {
            $notification =  array('error' => 'Token Not Found or used!!','alert-type' => 'warning');
            return redirect()->route('user.password.request')->with($notification);
         }else{
                
            $email = $tk->email;

            return view('pages.resetpass',$data)->with(
                ['token' => $token, 'email' => $email]
            );
         }
    }


    public function reset(Request $request)
    {
        request()->validate([
            'email' => 'email|required',

        ]);
        $tk =PasswordReset::where('token',$request->token)->where('status',0)->first();
        $user = User::whereEmail($tk->email)->first();
        if(!$user)
        {
            $notification =  array('error' => 'Email don\'t match!!','alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        
        $tk->status = 1;
        $tk->save();
        
        $notification =  array('success' => 'Successfully Password Reset.','alert-type' => 'success');
        return redirect('/login')->with($notification);
    }
}
