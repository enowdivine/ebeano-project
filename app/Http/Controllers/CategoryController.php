<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.category.index');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'icon' => 'required|image|mimes:png,svg|max:1024',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->description;

        if ($request->slug != null) {

            $category->slug = $request->slug;
        }
        else {
            $category->slug = Str::of($request->name)->slug('-');
        }

        if($request->hasFile('icon')){
            $category->icon = $request->file('icon')->store('uploads/categories/icons');
        }
        
        if($request->hasFile('mobile_image')){
            $category->mobile_image = $request->file('mobile_image')->store('uploads/categories/images');
        }
        
        if($request->hasFile('desktop_image')){
            $category->desktop_image = $request->file('desktop_image')->store('uploads/categories/images');
        }

        if($category->save()){
            
            return redirect()->route('category.create')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
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
        $edit = Category::find(decrypt($id));
        return view('admin.category.form',['edit'=>$edit]);
        
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
        
        $category = Category::find($id);
        $category->name = $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->description;

        if ($request->slug != null) {

            $category->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $category->slug = Str::of($request->name)->slug('-');
        }

        if($request->hasFile('icon')){
            $request->validate([
            'icon' => 'required|image|mimes:png,svg|max:2048|dimensions:width=512,height=512',
            ]);
            $category->icon = $request->file('icon')->store('uploads/categories/icons');
        }
        
        if($request->hasFile('mobile_image')){
            
            $category->mobile_image = $request->file('mobile_image')->store('uploads/categories/images');
        }
        
        if($request->hasFile('desktop_image')){
            $category->desktop_image = $request->file('desktop_image')->store('uploads/categories/images');
        }

        if($category->save()){
            
            return redirect()->route('category.index')->withSuccess('Updated successfully');
        }
        else{

            return back()->withError('Error 108: Something went wrong');
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
        if (Category::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 108: Something went wrong');
        }
    }
}
