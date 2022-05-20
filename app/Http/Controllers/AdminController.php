<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
use App\Page;
use App\Market;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    public function admin($page){
        //if (Auth::check()){
            return view('admin.'.$page);
        //}
        
    }

    public function pages()
    {
        //
        return view('admin.pages.index');
    }


    public function createPage()
    {
        //
        return view('admin.pages.form');
    }


    public function storePage(Request $request)
    {
        //
        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;

        if ($request->slug != null) {

            $page->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $page->slug = Str::of($request->title)->slug('-');
        }


        if($page->save()){
            
            return redirect()->route('page.create')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
        }
    }

    public function editPage($id)
    {
        //
        $edit = page::findOrFail(decrypt($id));
        return view('admin.pages.form',['edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePage(Request $request, $id)
    {
        //
        $page = Page::find(decrypt($id));
        $page->title = $request->title;
        $page->content = $request->content;

        if ($request->slug != null) {

            $page->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $page->slug = Str::of($request->title)->slug('-');
        }


        if($page->save()){
            
            return back()->withSuccess('Updated successfuly');
        }
        else{

            return back()->withError('Error 107: Something went wrong');
        }
    }

    public function destroyPage($id)
    {
        //
        if (Page::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 108: Something went wrong');
        }
    }
    
    public function payments(){
        
        return view('admin.payment.index');
    }
    
    public function approvePayment(){
        
        return view('admin.payment.approve');
    }
    
    public function market(){
        
        return view('admin.market.index');
    }
    
    public function createMarket(){
        
        return view('admin.market.form');
    }
    
    public function editMarket($id){
        
        $edit = Market::findOrFail(decrypt($id));
        
        return view('admin.market.form', compact('edit'));
    }
    
    public function storeMarket(Request $request){
        //
        request()->validate([
            'name' => 'required|max:50',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required'

        ]);

        $market = new Market;
        $market->name = $request->name;
        $market->description = $request->description;
        if ($request->slug != null) {

            $market->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $market->slug = Str::of($request->name)->slug('-');
        }
        $market->address = $request->address;
        $market->city = $request->city;
        $market->nearest_bus_stop = $request->nearest_bus_stop;
        $market->state_id = $request->state;
        $market->country_id = $request->country;
        $market->working_hours = $request->working_hours;

        if($market->save()){
            
            return redirect()->route('market.index')->withSuccess('Created successfuly');
        }
        else{

            return back()->withError('Error 109: Something went wrong');
        }
    }

    public function updateMarket(Request $request, $id){
        //
        request()->validate([
            'name' => 'required|max:50',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required'

        ]);

        $market = Market::findOrFail(decrypt($id));
        $market->name = $request->name;
        $market->description = $request->description;
        if ($request->slug != null) {

            $market->slug = Str::of($request->slug)->slug('-');
        }
        else {
            $market->slug = Str::of($request->name)->slug('-');
        }
        $market->address = $request->address;
        $market->city = $request->city;
        $market->nearest_bus_stop = $request->nearest_bus_stop;
        $market->state_id = $request->state;
        $market->country_id = $request->country;
        $market->working_hours = $request->working_hours;
        $market->approved = $request->approved;

        if($market->save()){
            
            return redirect()->route('market.edit',['id'=> $id])->withSuccess('Updated successfuly');
        }
        else{

            return back()->withError('Failed to Update');
        }
    }   
    public function destroyMarket($id)
    {
        //
        if (Market::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Something went wrong');
        }
    }   
    
    
    /* Real Estate Management */
    // =============== Categories ==============================================
    public function estateCategoryIndex()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.estate.category.index');
    }
    
    public function estateCategoryAdd()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.estate.category.form');
    }
    
    public function estateCategoryStore(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        \App\EstateCategory::create(array('name' => $data->id));
        
        return Redirect("/eb-admin/estate-category/add")->withSuccess('Successfully added');
    }
    
    public function estateCategoryEdit($id)
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }

        return view('admin.estate.category.form', ['edit' => \App\EstateCategory::findOrFail($id)]);
    }
    
    public function estateCategoryUpdate(Request $request, $id)
    {
        //
        request()->validate([
            'name' => 'required',
        ]);
        $data = \App\EstateCategory::find($id);

        $data->name = $request->input('name');
        $data->save();

        return Redirect("/eb-admin/estate-category/edit/" . $id)->withSuccess('Successfully updated');
    }
    
    public function estateCategoryDelete(Request $request, $id)
    {
        \App\EstateCategory::where('id', $id)->delete();
        return Redirect("/eb-admin/estate-category")->withSuccess('Successfully updated');
    }
    
    // =============== Features ==============================================
    public function estateFeatureIndex()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.estate.features.index');
    }
    
    public function estateFeatureAdd()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('admin.estate.features.form');
    }
    
    public function estateFeatureStore(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        \App\EstateFeatures::create(array('name' => $data->id));
        
        return Redirect("/eb-admin/estate-features/add")->withSuccess('Successfully added');
    }
    
    public function estateFeatureEdit($id)
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }

        return view('admin.estate.features.form', ['edit' => \App\EstateFeatures::findOrFail($id)]);
    }
    
    public function estateFeatureUpdate(Request $request, $id)
    {
        //
        request()->validate([
            'name' => 'required',
        ]);
        $data = \App\EstateFeatures::find($id);

        $data->name = $request->input('name');
        $data->save();

        return Redirect("/eb-admin/estate-features/edit/" . $id)->withSuccess('Successfully updated');
    }
    
    public function estateFeatureDelete(Request $request, $id)
    {
        \App\EstateFeatures::where('id', $id)->delete();
        return Redirect("/eb-admin/estate-category")->withSuccess('Successfully updated');
    }
    
    // =============== Customer Request =======================================
    public function estateRequestIndex()
    {
        //
        if (Auth::guest()) {

            return Redirect("login")->withSuccess('Opps! You do not have access');
        }
        $customer_requests = DB::table("estate_customers_request")->orderBy('id', 'DESC')->get();
        return view('admin.estate.requests.index', ['customer_requests'=>$customer_requests]);
    }

}
