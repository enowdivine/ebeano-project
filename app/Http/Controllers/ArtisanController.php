<?php

namespace App\Http\Controllers;
use App\Role;
use App\Artisan;
use App\State;
use Validator, Redirect, Response;
use App\User;
use App\Store;
use App\Country;
use App\Bank;
use App\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.artisan.index');
    }

    public function artisan_dashboard()
    {
        //
        return view('artisan.profile.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $states = State::all();
        $countries = Country::all();
        
        
        return view('admin.artisan.form', ['states'=>$states, 'countries'=>$countries]);
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

            'name' => 'name',
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
            'user_type' => 'artisan', 
            'phone' => $data['phone'],
        );

        if ($check = User::create($user_data)){

            $artisan_data = array( 
                'user_id' => $check->id,
                'ref_method' => $data['referer'],
                'referral_code' => $data['ref_code'], 
                'verification_info' => 'Awaiting approval', 
                'registered_by' => Auth::user()->id
    
            );

            if ($check= Artisan::create($artisan_data)) {

                $store_data = array(
                    'artisan_id' => $check->id,
                    'name' => $data['name'], 
                    'slug' => Str::of($data['name'])->slug('-'), 
                    'description' => $data['description'],
                    'address' => $data['address'],
                    'city' => $data['city'], 
                    'nearest_bus_stop' => $data['nearest_bus_stop'], 
                    'state_id' => $data['state'],
                    'country_id' => $data['country'], 
                    
        
                );

                if (Store::create($store_data)){
                    $success = 'Registration successful and is pending verification by Admin';
                }else { 
                    $error = 'Error 103: Artisan registration failed';
                }

            }else { 
                $error = 'Error 102: Artisan registration failed';
            }
            
        } else { 
            $error= 'Error 101: Artisan registration failed';
        }


        return redirect('eb-admin/Artisan/create')->with(['data'=>$data, 'error'=>$error, 'success'=>$success]); 
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
        $states = State::all();
        $countries = Country::all();
        
        
        return view('admin.artisan.edit', ['states'=>$states, 'countries'=>$countries,'id'=>$id]);
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
        $user_data = Artisan::find($id);
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
            return redirect()->route('artisan.editprofile',['id'=> $id])->withSuccess('Info Successfully updated');
          }else {
            return redirect()->route('artisan.editprofile',['id'=> $id])->withError('Error 105: Update failed');
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

    public function artisanRegistration(){
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        
        
        return view('artisan.registration', ['states'=>$states, 'countries'=>$countries]);
    }

    public function artisanRegistraionStore(Request $request){
        $error=$success='';

        request()->validate([

            'name' => 'name',
            'email' => 'email|unique:users',
            'password' => 'min:6|required'

        ]);

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
            'user_type' => 'artisan', 
            'phone' => $data['phone'],
        );

        if ($check = User::create($user_data)){

            $admin = User::where('user_type','admin');

            $artisan_data = array( 
                'user_id' => $check->id,
                'ref_method' => $data['referer'],
                'referral_code' => $data['ref_code'], 
                'verification_info' => 'Awaiting approval', 
                'registered_by' => $admin->id
    
            );

            if ($check= Artisan::create($artisan_data)) {

                $store_data = array(
                    'artisan_id' => $check->id,
                    'name' => $data['name'], 
                    'slug' => Str::of($data['name'])->slug('-'), 
                    'description' => $data['description'],
                    'address' => $data['address'],
                    'city' => $data['city'], 
                    'nearest_bus_stop' => $data['nearest_bus_stop'], 
                    'state_id' => $data['state'],
                    'country_id' => $data['country'], 
        
                );

                if (Store::create($store_data)){
                    $success = 'Registration successful and is pending verification by Admin';
                    return redirect()->route('artisan.reg_success')->withSuccess($success);
                }else { 
                    $error = 'Error 203: registration failed';
                }

            }else { 
                $error = 'Error 202: registration failed';
            }
            
        } else { 
            $error= 'Error 201: registration failed';
        }


        return back()->with(['data'=>$data, 'error'=>$error]); 
    }
    
    public function jobs()
    { 
        return view('admin.job.index');
    }

    public function admin_view_job($id)
    { 
        $job = \App\Job::findOrFail(decrypt($id));
        return view('admin.job.view',compact('job'));
    }

    public function artisan_type()
    { 
        
        return view('admin.job.type');
    }

    public function add_artisan_type()
    { 
        return view('admin.job.type_form');
    }

    public function edit_artisan_type($id)
    { 
        $edit = \App\JobType::findOrFail(decrypt($id));
        return view('admin.job.type_form',compact('edit'));
    }

    public function store_artisan_type(Request $request)
    { 

        $type = new JobType;
        $type->name = $request->name;
        $type->description = $request->description;

        if ($request->slug != null) {

            $type->slug = $request->slug;
        }
        else {
            $type->slug = Str::of($request->name)->slug('-');
        }

        if($type->save()){
            
            return redirect()->route('artisan.type')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
        }
    }

    public function update_artisan_type(Request $request, $id)
    { 
        $request->validate([
            'name' => 'required',
        ]);
        $type = \App\JobType::find(decrypt($id));
        $type->name = $request->name;
        $type->description = $request->description;

        if ($request->slug != null) {

            $type->slug = $request->slug;
        }
        else {
            $type->slug = Str::of($request->name)->slug('-');
        }

        if($type->save()){
            
            return redirect()->route('artisan.type')->withSuccess('Updated successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
        }

    
    }

    public function frontend_listiing()
    { 
        return view('artisan.jobs.index');
    }

    public function show_artisan($id)
    { 
        $artisan = \App\Artisan::findOrFail(decrypt($id));
        return view('artisan.JobDetail.index', compact('artisan'));
    }

    public function assign_job()
    { 
        return view('artisan.JobDetail.index');
    }

    public function decline_job($id)
    { 
        $decline_job = \App\Job::findOrFail(decrypt($id));

        $decline_job->declined = 1;
        $decline_job->status = 'declined';

        if ($decline_job->save()){
            return back()->with(['success'=>'Job Declined successful']);
        }else{
            return back()->with(['error'=>'something went wrong']);
        }

    }

    public function accept_job($id)
    { 
        $accept_job = \App\Job::findOrFail(decrypt($id));

        $accept_job->confirmed = 1;
        $accept_job->status = 'confirmed';

        if ($accept_job->save()){
            return back()->with(['success'=>'Job Confirmed successful']);
        }else{
            return back()->with(['error'=>'something went wrong']);
        }

    }

    public function completed_job()
    { 
        return view('artisan.JobDetail.index');
    }

    public function post_job()
    { 
        return view('artisan.JobDetail.index');
    }

    public function post_job_store(Request $request){
        //
    }

    public function post_job_edit($id)
    { 
        $edit_post = \App\Job::findOrFail(decrypt($id));
        return view('artisan.jobs.index',compact('edit'));
    }

    public function post_job_delete($id)
    { 
        $delete_post = \App\Job::findOrFail(decrypt($id));
        return view('artisan.jobs.index',compact('delete'));
    }

    public function my_job()
    { 
        return view('artisan.JobDetail.index');
    }

    public function my_job_request()
    { 
        return view('artisan.JobDetail.index');
    }

    public function review ()
    { 
        return view('artisan.JobDetail.index');
    }

    public function store_review(Request $request){
        //
        
    }
}



