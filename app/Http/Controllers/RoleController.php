<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Validator,Redirect,Response;
Use App\User;
Use App\Permissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Permissions::all();
        return view('admin.role.form', ['permissions'=>$data]);
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
            'permissions' => 'required'

            ]);
            $input = $request->all();
            $input['permissions'] = $request->input('permissions');
            
            return Redirect("/eb-admin/staff/roles/create")->withSuccess('Successfully added');
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
        $permissions = Permissions::all();
        $data = Role::find($id);
        return view('admin.role.form', ['edit'=>$data,'permissions'=>$permissions]);
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
            'permissions' => 'required'

            ]);
            $data = Role::find($id);

            $data->name = $request->input('name');
            $data->permissions = $request->input('permissions');
            $data->save();
            
            return Redirect("/eb-admin/staff/roles/edit/".$id)->withSuccess('Successfully updated');
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
}
