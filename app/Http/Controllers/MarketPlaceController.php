<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\State;
use App\Mart;
use App\Address;
use App\Helpers\ListHelper;

class MarketPlaceController extends Controller
{
    //index controller
    public function index(){
        $states = State::all();
        return view('market_place.index', ['states'=>$states]);
    }
    
    public function all_mart(){
        $states = State::all();
        $marts = Mart::all();
        return view('market_place.all_mart', ['states'=>$states, 'marts'=>$marts]);
    }
    
    public function load_featured_section(){
        return view('market_place.partials.featured_products_section');
    }
    
    public function load_top_selling_section(){
        return view('market_place.partials.top_selling_section');
    }

    public function load_home_categories_section(){
        return view('market_place.partials.mart_cat_section');
    }

    public function single_mart(Request $request, $slug)
    {
        $states = State::all();
        $detailedMart  = Mart::where('slug', $slug)->first();
        if($detailedMart!=null && $detailedMart->id){

            $products = filter_eb_products(\App\Product::where('published', 1)->where('market_id', $detailedMart->id))->latest()->paginate(20);
            return view('market_place.single_mart', compact('detailedMart','products', 'states'));
        }
        abort(404);
    }
    
    public function filter_store(Request $request)
    {
        $states = State::all();
        $detailedStore  = \App\Store::where('id', $request->store)->first();
        if($detailedStore!=null && $detailedStore->id){
            $products = filter_eb_products(\App\Product::where('published', 1)->where('store_id', $request->store))->latest()->paginate(20);
            return view('market_place.filter_store', compact('detailedStore','products', 'states'));
        }
        abort(404);
    }
    
    public function filter_mart(Request $request)
    {
        $states = State::all();
        $detailedMart  = Mart::where('id', $request->mart)->first();
        if($detailedMart!=null && $detailedMart->id){
            $products = filter_eb_products(\App\Product::where('published', 1)->where('market_id', $request->mart))->latest()->paginate(20);
            return view('market_place.filter_mart', compact('detailedMart','products', 'states'));
        }
        abort(404);
    }
    
    /**
     * Response AJAX call to return marts of a given state
     */
    public function ajaxStatesMarts(Request $request)
    {
        if ($request->ajax()){
            $marts = ListHelper::marts($request->input('state_id'));

            return response()->json([
                'ebMarts' => $marts
            ]);
        }

        return response('Not allowed!', 404);
    }
    
    /* Response AJAX call to return stores of a given market
     */
    public function ajaxMartsStores(Request $request)
    {
        if ($request->ajax()){
            $stores = ListHelper::stores($request->input('market_id'));

            return response()->json([
                'ebStores' => $stores
            ]);
        }

        return response('Not allowed!', 404);
    }
}
