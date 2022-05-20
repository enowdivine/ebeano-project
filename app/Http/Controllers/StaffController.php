<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\role;
use Validator, Redirect, Response;
use App\User;
use App\Permissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.staff.form');
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
        request()->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);

        $data = $request->all();
 
        $check = $this->create($data);

        $staff = array('user_id' => $check->id ,'role_id'=>$data['role'] );

        Staff::create($staff);
        
        return Redirect("/eb-admin/staff/add")->withSuccess('Successfully added');
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
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }

        return view('admin.staff.form', ['edit' => Staff::findOrFail($id)]);
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
        request()->validate([
            'name' => 'required',
            'code' => 'required'

        ]);
        $data = Permissions::find($id);

        $data->name = $request->input('name');
        $data->code = $request->input('code');
        $data->save();

        return Redirect("/eb-admin/staff/permissions/edit/" . $id)->withSuccess('Successfully updated');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'user_type' => 'staff',
        'password' => Hash::make($data['password'])
      ]);
    }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
