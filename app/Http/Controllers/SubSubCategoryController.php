<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.subsubcategory.index');
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
        $subcategories = SubCategory::all();
        return view('admin.subsubcategory.form',['categories'=>$categories,'subcategories'=>$subcategories]);
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
        $subsubcategory = new SubSubCategory;
        $subsubcategory->name = $request->name;
        $subsubcategory->sub_category_id = $request->subcategory;
        $subsubcategory->meta_title = $request->meta_title;
        $subsubcategory->meta_description = $request->description;

        if ($request->slug != null) {

            $subsubcategory->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $subsubcategory->slug = Str::of($request->name)->slug('-');
        }


        if($subsubcategory->save()){
            
            return redirect()->route('subsubcategory.index')->withSuccess('Created successfuly');
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
        $edit = SubSubCategory::findOrFail(decrypt($id));
        $subcategories = SubCategory::all();
        return view('admin.subsubcategory.form',['edit'=>$edit,'subcategories'=>$subcategories]);
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
        $subsubcategory = SubSubCategory::find($id);
        $subsubcategory->name = $request->name;
        $subsubcategory->sub_category_id = $request->subcategory;
        $subsubcategory->meta_title = $request->meta_title;
        $subsubcategory->meta_description = $request->description;

        if ($request->slug != null) {

            $subsubcategory->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $subsubcategory->slug = Str::of($request->name)->slug('-');
        }


        if($subsubcategory->save()){
            
            return back()->withSuccess('Updated successfuly');
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
        if (SubSubCategory::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 108: Something went wrong');
        }
    }

    public function get_subsubcategories_by_subcategory(Request $request)
    {
        $subsubcategories = SubSubCategory::where('sub_category_id', $request->sub_category_id)->get();
        return $subsubcategories;
    }
}
