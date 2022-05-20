@extends('layouts.theme')

@section('title', 'Checkout')

@section('content')
@php

    if(!isset($shipping_info)){
        $shipping_info = null;
    }

    $subtotal = 0;
    $shipping = 0;
    
    if (Session::get('shipping') != 0){
            $shipping = Session::get('shipping');
    } 
@endphp
@if (Session::get('cart'))
@foreach (Session::get('cart') as $key => $cartItem)
    @php
    $product = \App\Product::find($cartItem['id']);
    $subtotal += $cartItem['price']*$cartItem['quantity'];

    $product_name_with_choice = $product->name ?? '';
    if ($cartItem['variant'] != null) {
        $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
    }
    @endphp
    @php
        $total = $subtotal+$shipping;
        if(Session::has('coupon_discount')){
            $total -= Session::get('coupon_discount');
        }
    @endphp
@endforeach
@endif
<div class="row my-3 py-2">
    <div class="col-lg-8 order-2 order-md-2">
        <div class="card border-0 shadow-sm rounded mb-4 p-3">
        
            <div class="title-container pl-0">
                <div class="title-info">
                    <h4 class="mb-3">Shipping Info</h4>
                </div>
                @if(Auth::check() || $shipping_info != null)
                
                <span class="view-more" id="s-change"><a href="#" onclick="change()" >CHANGE</a></span>
                <span class="view-more d-none" id="s-close"><a href="#" onclick="close_change()" >CLOSE</a></span>
                @endif
            </div>
             
            <form class="needs-validation" method="POST" action="{{isset($saved)?route('order.pay'):route('order.save')}}" novalidate>
                @csrf
            @if(Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                <div id="s-address">
                        <h5>{{$shipping_info != null ? $shipping_info['name']: $user->name}}</h5>
                        <p>{{$shipping_info != null ? $shipping_info['address']: $user->address}}</p>
                        <p>{{$shipping_info != null ? $shipping_info['phone']: $user->phone}}</p>
                </div>
                <div class="form-wrap  d-none" id="s-info">
                    
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name</label>
                    <input type="text" name="shipping_info[name]" class="form-control" id="name" placeholder="" value="{{$shipping_info != null ? $shipping_info['name']: $user->name}}" required>
                        <div class="invalid-feedback">
                            Valid full name is required.
                        </div>
                    </div>
                    </div>


                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" name="shipping_info[email]" class="form-control" id="email" placeholder="you@example.com" value="{{$shipping_info != null ? $shipping_info['email']: $user->email}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="phone">Phone </label>
                    <input type="tel" name="shipping_info[phone]" class="form-control" id="phone" placeholder="0801 xxx xxxx" value="{{$shipping_info != null ? $shipping_info['phone']: $user->phone}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid phone numeber for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="shipping_info[address]" id="address" placeholder="1234 Main St" value="{{$shipping_info != null ? $shipping_info['address']: $user->address}}" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" name="shipping_info[country]" required>
                            <option value="">Choose...</option>
                            @php 
                                $countries = \App\Country::all();
                            @endphp
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}" {{($user->country_id == $country->id) || ($shipping_info != null && $shipping_info['country'] == $country->id) ?'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" name="shipping_info[state]" id="state" onchange="addShipping(this,{{Session::get('cart')}})" required>
                            <option value="">Choose...</option>
                            @php 
                                $states = \App\State::all();
                            @endphp
                            @foreach ($states as $state)
                                <option value="{{$state->state_id}}" {{($user->state_id  == $state->state_id) || ($shipping_info != null && $shipping_info['state'] == $state->id) ?'selected':''}}>{{$state->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="city">Post Code</label>
                        <input type="text" class="form-control" name="shipping_info[city]" id="city" value="{{$shipping_info != null ? $shipping_info['city']: ""}}" placeholder="" required>
                        <div class="invalid-feedback">
                            city required.
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div id="s-address">
                        <h4>{{$shipping_info != null ? $shipping_info['name']: ''}}</h4>
                        <p>{{$shipping_info != null ? $shipping_info['address']: ''}}</p>
                        <p>{{$shipping_info != null ? $shipping_info['phone']: ''}}</p>
                    </div>
            <div class="form-wrap" id="s-info">
                    
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name</label>
                    <input type="text" name="shipping_info[name]" class="form-control" id="name" placeholder="" value="{{$shipping_info != null ? $shipping_info['name']: '' }}" required>
                        <div class="invalid-feedback">
                            Valid full name is required.
                        </div>
                    </div>
                    </div>


                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" name="shipping_info[email]" class="form-control" id="email" placeholder="you@example.com" value="{{$shipping_info != null ? $shipping_info['email']: ''}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="phone">Phone </label>
                    <input type="tel" name="shipping_info[phone]" class="form-control" id="phone" placeholder="0801 xxx xxxx" value="{{$shipping_info != null ? $shipping_info['phone']: ''}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid phone numeber for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="shipping_info[address]" id="address" placeholder="1234 Main St" value="{{$shipping_info != null ? $shipping_info['address']: ''}}" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" name="shipping_info[country]" required>
                            <option value="">Choose...</option>
                            @php 
                                $countries = \App\Country::all();
                            @endphp
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}" {{($shipping_info != null && $shipping_info['country'] == $country->id) ?'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" name="shipping_info[state]" id="state" onchange="addShipping(this,{{Session::get('cart')}})" required>
                            <option value="">Choose...</option>
                            @php 
                                $states = \App\State::all();
                            @endphp
                            @foreach ($states as $state)
                                <option value="{{$state->state_id}}" {{($shipping_info != null && $shipping_info['state'] == $state->id) ?'selected':''}}>{{$state->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="city">Post Code</label>
                        <input type="text" class="form-control" name="shipping_info[city]" id="city" value="{{$shipping_info != null ? $shipping_info['city']: ''}}" placeholder="" required>
                        <div class="invalid-feedback">
                            city required.
                        </div>
                    </div>
                </div>
            </div>
            @endif
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="same_info" id="same-info" onchange="billing_info()" value="1">
                    <label class="custom-control-label font-weight-bold mb-2" for="same-info">Shipping Info is the same as my billing
                        Info.</label>
                </div>
                <div class="form-wrap" id="billing-info">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="billing-name">Billing Name</label>
                            <input type="text" class="form-control" name="billing_info[name]" id="billing-name" placeholder="" value="" required>
                        </div>
                    </div>
                    <div class="mb-3">
                <label for="billing-email">Billing Email</label>
                <input type="email" class="form-control" name="billing_info[email]" id="billing-email" placeholder="@" value="" required>

            </div>

                </div>
                @if(Auth::check())
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info" name="save_info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                @endif
                <hr class="mb-3">
                @if(!isset($saved))
                <h6 class="mb-2">Select Payment Method</h6>
                <div class="d-block ">
                    <div class="custom-control custom-radio mb-3">
                        @if(Auth::check() && Auth::user()->balance >= $total)
                        <input id="wallet" name="paymentMethod" type="radio" class="custom-control-input" checked
                            value="wallet">
                        <label class="custom-control-label" for="wallet">Wallet (Balance: <strong>{{number_format(Auth::user()->balance,2)}}</strong>)</label>
                        @endif
                    </div>
                    <!--<div class="custom-control custom-radio">-->
                    <!--    <input id="interswitch" name="paymentMethod" type="radio" class="custom-control-input" -->
                    <!--        value="interswitch">-->
                    <!--    <label class="custom-control-label" for="interswitch">Interswitch</label>-->
                    <!--</div>-->
                    <div class="custom-control custom-radio mb-3">
                        <input id="paystack" name="paymentMethod" type="radio" class="custom-control-input" value="paystack" checked>
                        <label class="custom-control-label p-1 bg-white rounded border" for="paystack"><img width="190px" height="40px" class="" src="{{asset('assets/images/paystack.png')}}"></label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input id="delivery" name="paymentMethod" type="radio" class="custom-control-input" value="delivery" >
                        <label style="width: 200px; height: 44px; text-align: center; font-weight: bold;" class="custom-control-label rounded py-2 border" for="delivery"><span >Pay On Delivery</span></label>
                    </div>
                </div>
                
                <hr class="mb-4">
                @endif
                <button class="btn btn-default btn-lg btn-block" type="submit">{{isset($saved) ? 'Pay': 'Save and Continue'}} <span id="spinner" class="d-none"><img src="{{asset('assets/images/pulse2.gif')}}"></span></button>
            </form>

        </div>
    </div>
    <div class="col-lg-4 order-1 mb-2 order-md-2 ">
        <div id= "cart-summary">
        @include('ajax.cart_summary')
        </div>
    </div>
</div>

@endsection
@section("script")
    <script>
        function billing_info(){

            $('#billing-info').toggle("slow", function() {
                // Animation complete.
            });

        }
        function change(){
            
            $('#s-info').removeClass("d-none", 5500);
            
            $('#s-close').removeClass("d-none");
            $('#s-change').addClass("d-none");
            $('#s-address').addClass("d-none");
        }
        function close_change(){

            $('#s-info').addClass("d-none ", 3000);
            
            $('#s-close').addClass("d-none");
            
            $('#s-change').removeClass("d-none");
            $('#s-address').removeClass("d-none");
        }
        
        function addShipping(element,cart){
            $.post('{{ route('cart.addShipping') }}', { _token:'{{ csrf_token() }}', state_id: element.value, cart: cart}, function(data){
                console.log(data);
                $('#cart-summary').html(data);
            });
            console.log(element.value);
        }
    </script>
@endsection