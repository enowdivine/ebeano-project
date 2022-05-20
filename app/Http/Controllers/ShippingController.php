<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\ShippingRate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ShippingController extends Controller
{
    //
    public function index()
    {
        //
        return view('admin.shipping.index');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shippingRates = ShippingRate::all();
        return view('admin.shipping.form');
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
            'rate'=>'required',
            'zone'=>'required',
            'min_weight'=>'required',
            'max_weight'=>'required',
        ]);
        $shipping = new ShippingRate;
        $shipping->rate = $request->rate;
        $shipping->zone = $request->zone;
        $shipping->min_weight = $request->min_weight;
        $shipping->max_weight = $request->max_weight;


        if($shipping->save()){
            
            return redirect()->route('shipping.create')->withSuccess('Added successfuly');
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
        $edit = ShippingRate::find(decrypt($id));
        return view('admin.shipping.form',['edit'=>$edit]);
        
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
        
        $shipping = ShippingRate::find($id);
        $request->validate([
            'rate'=>'required',
            'zone'=>'required',
            'min_weight'=>'required',
            'max_weight'=>'required',
        ]);

        $shipping->rate = $request->rate;
        $shipping->zone = $request->zone;
        $shipping->min_weight = $request->min_weight;
        $shipping->max_weight = $request->max_weight;


        if($shipping->save()){
            
            return redirect()->route('shipping.create')->withSuccess('Updated successfuly');
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
        if (ShippingRate::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error 108: Something went wrong');
        }
    }   
}
