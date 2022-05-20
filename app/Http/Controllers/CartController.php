<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator, Redirect, Response;
use App\SubSubCategory;
use App\Category;
use App\State;
use App\ShippingRate;
use Session;
use App\Color;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        return view('pages.cart', compact('categories'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('ajax.addToCart', compact('product'));
    }

    public function updateNavCart(Request $request)
    {
        return view('ajax.cart');
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);

        $data = array();
        $data['id'] = $product->id;
        $str = '';
        

        //check the color enabled or disabled for the product
        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
            else{
                $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
        }

        $data['variant'] = $str;

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;

            if($quantity >= $request['quantity']){
                $variations->$str->qty -= $request['quantity'];
                $product->variations = json_encode($variations);
                $product->save();
            }
            else{
                return view('ajax.outOfStockCart');
            }
        }
        else{
            
            $price = $product->unit_price;
            
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1  && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

       $shipping_cost = 2000;

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['weight'] = ($product->weight == 0 ? 0.5 : $product->weight) * $request['quantity'];
        // $data['shipping'] = $product->shipping_cost == 0 ?$product->shipping_cost:$shipping_cost;

        if($request->session()->has('cart')){
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('cart') as $key => $cartItem){
                if($cartItem['id'] == $request->id){
                    if($cartItem['variant'] == $str){
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    }
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        }
        else{
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }

        return view('ajax.addedToCart', compact('product', 'data'));
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        return $request;
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('cart');
        // $cart = $cart->map(function ($object, $key) use ($request) {
        //     if($key == $request->key){
        //         $object['quantity'] = $request->quantity;
        //     }
            
        // });
        $newCart = [];
        foreach($cart as $key => $cartItem){
            if($key == $request->key){
                $product = Product::find($cartItem['id']);
                $cartItem['quantity'] = $request->quantity;
                $cartItem['weight'] = ($product->weight == 0 ? 0.5 : $product->weight) * $request->quantity;
            }
            array_push($newCart,$cartItem);
        }
        $request->session()->put('cart', $newCart);
        // return collect([$newCart]);
        return view('ajax.cart_details');
    }
    
        //updated the quantity for a cart item
    public function addShipping(Request $request)
    {
        $cart = $request->cart;

        $shipping_cost = 0;
        $weight = 0;
        foreach($cart as $key => $cartItem){
            $product = Product::find($cartItem['id']);
            $weight += ($product->weight == 0 ? 0.5 : $product->weight) * $cartItem['quantity'];
        }
        $state = State::where('state_id', $request->state_id)->first();
        
        $shipping_zone = $state->zone;
        $shipping = ShippingRate::where('min_weight', '<=', $weight)->where('max_weight', '>=', $weight)->where('zone', $shipping_zone)->first();
        
        if ($shipping != null){
            $shipping_cost = $shipping->rate;
            if ($weight >= 11){
                $additional_cost = 300;
                if ($shipping->zone == 1){
                    $additional_cost = 250;
                }
                $shipping_cost = $shipping->rate + ((floor($weight) - 10) * $additional_cost) ;
            }            
        }

        // array_push($newCart,$cart);
        $request->session()->put('shipping', $shipping_cost);
        // return collect([$newCart]);
        return view('ajax.cart_summary');
    }
}
