<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.brands.form');
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
            'logo' => 'required|image|mimes:png,jpg,svg|max:100|dimensions:width=200,height=200'

        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->description;
        if ($request->slug != null) {

            $brand->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $brand->slug = Str::of($request->name)->slug('-');
        }

        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands/logos');
        }

        //Resize image here
        // $thumbnailpath = public_path('storage/profile_images/thumbnail/'.$filenametostore);
        // $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
        //     $constraint->aspectRatio();
        // });

        if($brand->save()){
            
            return redirect()->route('brand.create')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 109: Something went wrong');
        }
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
        $edit = Brand::findOrFail(decrypt($id));
        return view('admin.brands.form',['edit'=>$edit]);
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
            'logo' => 'required|image|mimes:png,jpg,svg|max:200|dimensions:width=200,height=200'

        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->description;
        if ($request->slug != null) {

            $brand->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $brand->slug = Str::of($request->name)->slug('-');
        }

        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands/logos');
        }

        if($brand->save()){
            
            return redirect()->route('brands')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 109: Something went wrong');
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
        if (Brand::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 111: Something went wrong');
        }
    }
}
