<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\SubCategory;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.subcategory.index');
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

        return view('admin.subcategory.form', ['categories'=>$categories]);
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
        $subcategory = new SubCategory;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_description = $request->description;

        if ($request->slug != null) {

            $subcategory->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $subcategory->slug = Str::of($request->name)->slug('-');
        }


        if($subcategory->save()){
            
            return redirect()->route('subcategory.create')->withSuccess('Created successfuly');
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
        $edit = SubCategory::findOrFail(decrypt($id));
        $categories = Category::all();

        return view('admin.subcategory.form', ['categories'=>$categories, 'edit'=>$edit]);
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
        $subcategory = SubCategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_description = $request->description;

        if ($request->slug != null) {

            $subcategory->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $subcategory->slug = Str::of($request->name)->slug('-');
        }


        if($subcategory->save()){
            
            return redirect()->route('subcategory.index')->withSuccess('Updated successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
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
        if (SubCategory::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 108: Something went wrong');
        }
    }

    public function get_subcategories_by_category(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return $subcategories;
    }
}
