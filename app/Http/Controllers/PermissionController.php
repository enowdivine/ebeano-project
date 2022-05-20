<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator, Redirect, Response;
use App\User;
use App\Permissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class PermissionController extends Controller
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
        return view('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.permission.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPermission(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
            'code' => 'required'

        ]);
        Permissions::create($request->all());
        return Redirect("/eb-admin/staff/permissions/create")->withSuccess('Successfully added');
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

        return view('admin.permission.form', ['edit' => Permissions::findOrFail($id)]);
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
