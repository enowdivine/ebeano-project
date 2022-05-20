@extends('layouts.theme')

@section('title', 'Cart')

@section('content')
<div class="section px-3 m-2">

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Cart</li>

    </ul>
    <div id="cart-summary">
    <div class="row mb-5 cols-xs-space cols-sm-space cols-md-space">
        @if(Session::has('cart'))
        <div class="col-xl-8">
            <div class="form-default shadow-sm rounded bg-white p-4">
                <div class="">
                    <div class="">
                        <table class="table-cart border-bottom">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th class="d-none d-lg-table-cell">Price</th>
                                    <th class="d-none d-md-table-cell">Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                        $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cartItem)
                                            @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $qty = 0;
                                            if($product->variant_product){
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $product->current_stock;
                                            }
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                            $product_name_with_choice = $product->name ?? '';
                                            if ($cartItem['variant'] != null) {
                                                $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                            }
                                            // if(isset($cartItem['color'])){
                                            //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                            // }
                                            // foreach (json_decode($product->choice_options) as $choice){
                                            //     $str = $choice->name; // example $str =  choice_0
                                            //     $product_name_with_choice .= ' - '.$cartItem[$str];
                                            // }
                                            @endphp
                                <tr class="cart-item">
                                    <td class="" width="100px">
                                        <a href="#" class="mr-3">
                                            <img loading="lazy" width="60px" class=" img-fluid"
                                                src="{{ asset('storage/'.($product->featured_img ?? '')) }}">
                                        </a>
                                    </td>

                                    <td class="product-name">
                                        <span class="pr-4 d-block">{{ $product_name_with_choice }}</span>
                                    </td>

                                    <td class="product-price d-none d-lg-table-cell">
                                        <span class="pr-3 d-inline-block">₦{{ number_format($cartItem['price'],2) }}</span>
                                    </td>

                                    <td class="product-quantity d-none d-md-table-cell">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number minus" type="button" id=""
                                                        data-field="quantity[{{$key}}]" data-type="minus" >
                                                        <i class="la la-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity[{{$key}}]"
                                                    class="form-control rounded-lg input-number text-center"
                                                    placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="{{$qty}}" onchange="updateQuantity({{$key}},this)">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number plus" type="button" id=""
                                                        data-field="quantity[{{$key}}]" data-type="plus">
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-total">
                                        <span>₦{{number_format(($cartItem['price'])*$cartItem['quantity'],2)}}</span>
                                    </td>
                                    <td class="product-remove">
                                        <a href="#" onclick="removeFromCartView(event, {{$key}})" class="text-right pl-4">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row align-items-center pt-4">
                    <div class="col-6">
                        <a href="/" class="link link--style-3">
                            <i class="la la-arrow-alt-circle-left"></i>
                            Return to shop
                        </a>
                    </div>
                    <div class="col-6 text-right">
                                @if(Auth::check())
                                    <a href="{{ route('checkout') }}" class="btn btn-default">{{__('Continue to Checkout')}}</a>
                                @else
                                    <button class="btn btn-default" onclick="showCheckoutModal()">{{__('Continue to Checkout')}}</button>
                                @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4 ml-lg-auto">

            @include('ajax.cart_summary')
        </div>

        @else
        <div class="dc-header">
            <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
        </div>
        @endif
    </div>
</div> {{--section end--}}

    <!-- Modal -->
    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{url('post-login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}" required>
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}" required>
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{route('user.password.request')}}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-default btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                     {{-- @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 mt-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif --}}

                    <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout') }}" class="btn btn-default btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('script')
<script>
 cartQuantityInitialize();
    // $(document).ready(function() {
    // var x = $('.input-number');

    // $(".plus").click(function(){ 
        
    //     x.val( +x.val() + 1 );
       
    // });

    // $(".minus").click(function(){ 
    //     if (x.val()>1){
    //     x.val( +x.val() - 1 );
    //     }
       
    // });


    // });
</script>
<script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
            
            console.log(data);
            updateNavCart();
            $('#cart-summary').html(data);
        });
        console.log(element.value);
    }

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    </script>
@endsection