<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Image;
class UsersController extends Controller
{
    //index controller
    public function index(){
        
        
    }

    public function admin_view_user(){

        return view('admin.users.index');
    }

    public function admin_create_user(){

        return view('admin.users.form');
    }

    public function admin_edit_user($id){

        $edit = User::findOrFail(decrypt($id));

        return view('admin.users.form',['edit'=> $edit]);
    }

    public function user_edit_profile(){

        // $edit = User::findOrFail(decrypt($id));
        $banks = \App\Bank::all();
        $states = \App\State::all();
        $countries = \App\Country::all();
        $markets = \App\Market::all();
        return view('pages.update_profile', compact('banks','states','countries','markets'));
    }
    
    public function user_change_pass(){
        return view('pages.update_pass');
    }
    
    public function admin_store_user(Request $request){

                //
                $error=$success='';

                if (empty($request->input('password'))){
                    $pass = '123456';
                }else {
                    $pass = $request->input('password');
                }
        
                request()->validate([

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
                    'user_type' => 'user', 
                    'phone' => $data['phone'],
                );
        
                if (User::create($user_data)){
                    $success = 'User created successfully';
                 }

        return redirect()->route('users.list')->with(['data'=>$data, 'error'=>$error, 'success'=>$success]);
    }

    public function admin_update_user(Request $request, $id){

        //
        $error=$success='';
        $user = User::find($id);
        if ($request->input('pwd_reset')== 1){
            $pass = '123456';
            request()->validate([
                $pass => 'min:6'
            ]);

            $user->password = Hash::make($pass);
        }

        request()->validate([

            'email' => 'email|unique:users',

        ]);

        $data = $request->all();

            $user->name = $data['name']; 
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state_id = $data['state'];
            $user->country_id = $data['country'];
            $user->phone = $data['phone'];

        if ($user->save()){
            $success = 'User updated successfully';
         }else{
             $error = 'Something went wrong';
         }

    return redirect()->back()->with(['edit'=>$data, 'error'=>$error, 'success'=>$success]);
    }

    public function update_profile(Request $request){

        //
        $error=$success='';
        $user = User::find(decrypt($request->id));
        if ($request->input('pwd_reset')== 1){
            $pass = '123456';
            request()->validate([
                $pass => 'min:6'
            ]);

            $user->password = Hash::make($pass);
        }

        request()->validate([

            'email' => 'email|unique:users',

        ]);

        $data = $request->all();
        
            $user->name = $data['name']; 
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state_id = $data['state'];
            $user->country_id = $data['country'];
            $user->phone = $data['phone'];
            
            if($user->user_type =='artisan'){
                $artisan = \App\Artisans::where('user_id', $user->id)->first();
                $artisan->city = $data['city']; 
                $artisan->country = $data['country'];
                $artisan->address = $data['address'];
                $artisan->company_tagline = $data['business_name'];
                $artisan->company_description = $data['business_desc'];
                $artisan->category_id = $data['artisan_category'];
                $artisan->fb = $data['facebook'];
                $artisan->twitter = $data['twitter']; 
                $artisan->linkedin = $data['linkedin'];
                $artisan->bank_id = $data['bank_name'];
                $artisan->bank_acc_name = $data['bank_acc_name'];
                $artisan->bank_acc_no = $data['bank_acc_no'];
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = time() . '_' . '.jpg';
                    $location = 'assets/artisan/images/user/' . $filename;
                    $artisan->image = $filename;
        
                    $path = './assets/artisan/images/user/';
                    $link = $path . $artisan->image;
                    if (file_exists($link)) {
                        @unlink($link);
                    }
                    Image::make($image)->save($location);
                }
                $artisan->save();
            }
        
        $user->profile_completed = 1;
        if ($user->save()){
            $success = 'User updated successfully';
         }else{
             $error = 'Something went wrong';
         }

    return redirect('dashboard')->with(['edit'=>$data, 'error'=>$error, 'success'=>$success]);
    }
    
    public function change_pass(Request $request){
        $error=$success='';
        $user = User::find(decrypt($request->id));

        request()->validate([

            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',

        ]);
        $pass = Hash::make($request->input('current_password'));
        $new_pass = Hash::make($request->input('password'));
        $current_pass = $user->password;
        
        if ($pass == $current_pass){
            
            if ($pass == $current_pass){
                $notification = 'New Password should be different from a the recently used password';
                return redirect()->back()->withError($notification);
            }
            
            $user->password = $new_pass;
            if ($user->save()){
                $to =$user->email;
                $name = $user->name;
                $subject = 'Password Change';
    
                $link = url('/');
    
                $message = "Your password was changed successfully: <br><br>";
                $message .= "<a style='background: #eb790f; color: #fff; text-align: center; text-decoration: none; padding-top:10px; padding-bottom:10px; padding-left: 16px; padding-right: 16px; border-radius: 5px; margin-bottom: 10px;' href='".$link."'>Login Now</a>";
    
                send_email($to,  $name, $subject,$message);
                $notification = 'Password changed successfully';
                return redirect()->back()->withSuccess($notification);
            }
        }else{
            $notification = 'Current Password is not correct, please check and try again';
                
            return redirect()->back()->withError($notification);
        }
        
        $notification = 'Something went wrong, please try again';
                
        return redirect()->back()->withError($notification);
    }

}
