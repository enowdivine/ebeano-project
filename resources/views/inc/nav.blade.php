 <!-- Top Bar -->
 @php
 function logo(){

 @endphp

                        <img src="{{asset('assets/images/ebeano-logo.png')}}"
                                 alt="Ebeano Market">
 @php 
 }
 @endphp
 <div class="top-navbar">
     <div class="container-fluid container-lg">
         <div class="row">
             <div class="col-md-4 col">

             </div>

             <div class="col-md-8 text-right d-none d-md-block d-lg-block">
                 <ul class="inline-links nav">
                    @if(Auth::guest() || (Auth::user() && Auth::user()->subscribed != 1))
                     <li>
                         <!--<a href="/vendors/quick/registration" class="top-bar-item">Sell on Ebeano</a>-->
                         <a href="{{route('vendor.quick_register')}}" class="top-bar-item sell-on-ebeano"
                            ><span class="fa-stack fa-sm"
                              ><i class="fa fa-circle fa-stack-2x"></i
                              ><i
                                class="fa fa-star fa-stack-1x fa-inverse"
                                ></i></span
                            > Sell on Ebeano</a
                          >
                     </li>
                     @endif
                     
                     <li>
                         <a href="{{route('contact')}}" class="top-bar-item">Contact us</a>
                     </li>
                     <li>
                         <a href="/track_order" class="top-bar-item">Track Order</a>
                     </li>
                     @if (Auth::guest())
                     <li>
                         <a href="/login" class="top-bar-item">Login</a>
                     </li>
                     <li>
                         <a href="/register" class="top-bar-item">Register</a>
                     </li>
                     @else
                     <li class="nav-item dropdown">
                         <a href="#" class="nav-link top-bar-item dropdown-toggle" data-toggle="dropdown" href="#"
                             role="button" aria-haspopup="true" aria-expanded="false">
                             Hi, {{$user_name}}
                         </a>
                         <ul class="dropdown-menu border-0">
                             @if(Auth::user()->user_type =='institute_registrar')
                             <li><a class="dropdown-item" href="{{route('registrar.dashboard')}}"><span class="la la-user-alt mr-2"></span>
                                     Dashboard</a></li>
                            @else
                              <li><a class="dropdown-item" href="/dashboard"><span class="la la-user-alt mr-2"></span>
                                     account</a></li>
                             <li><a class="dropdown-item" href="user/orders"><span class="la la-box-open mr-2"></span>
                                     Orders</a></li>
                            @endif
                             <li><a class="dropdown-item" href="user/wallet"><span class="la la-wallet mr-2"></span>
                                     Wallet</a></li>
                             <div class="dropdown-divider"></div>
                             <li><a class="dropdown-item text-center" href="/logout">Logout</a></li>
                         </ul>
                     </li>
                     @endif
                     <li>
                         <a href="/login" class="top-bar-item"></a>
                     </li>

                 </ul>
             </div>
         </div>
     </div>
 </div>
 <!-- END Top Bar -->

 <!-- mobile menu -->
 <div class="mobile-side-menu hide d-lg-none">
     <div class="side-menu-overlay opacity-0" onclick="closeNav()"></div>
     <div class="side-menu-wrap opacity-0">
         <div class="side-menu closed">
             <div class="side-menu-list">
                 
                @include('inc/mobilesidenav')
             </div>
         </div>
     </div>
 </div>
 <!-- end mobile menu -->

 <div class="position-relative logo-bar-area">
     <div class="">
         <div class="container-fluid container-lg">
             <div class="row no-gutters align-items-center">
                 <div class="col-md-3 col-8">
                     <div class="d-flex">
                         <div class="d-block d-md-none mobile-menu-icon-box">
                             <!-- Navbar toggler  -->
                             <div class="hamburger-menu">
                                 <span style="font-size:25px;cursor:pointer" onload=""
                                     Onclick="openNav()">&#9776;</span>
                                 

                             </div>
                             {{-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mobileNav" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                               <span class="navbar-toggler-icon"></span>
                           </button> --}}
                         </div>

                         <!-- Brand/Logo -->
                         <a class="navbar-brand w-100" href="/">
                             {{logo()}}

                         </a>

                     </div>
                 </div>
                 <div class="col-md-9 col-4 position-static">
                     <div class="d-flex w-100">
                         <div class="search-box flex-grow-1 pr-4">
                             <form action="/search" method="GET">
                                 <div class="d-flex position-relative">
                                     <div class="d-lg-none search-box-back">
                                         <button class="" type="button"><i class="la la-long-arrow-left"></i></button>
                                     </div>
                                     <div class="w-100">
                                         <input type="text" aria-label="Search" id="search" name="q" class="w-100"
                                             placeholder="I am shopping for..." autocomplete="off">
                                     </div>

                                     <button class="d-none d-lg-block" type="submit">
                                         <i class="la la-search la-flip-horizontal"></i>
                                     </button>
                                     <div class="typed-search-box d-none">
                                         <div class="search-preloader">
                                             <div class="loader">
                                                 <div></div>
                                                 <div></div>
                                                 <div></div>
                                             </div>
                                         </div>
                                         <div class="search-nothing d-none">

                                         </div>
                                         <div id="search-content">

                                         </div>
                                     </div>
                                 </div>
                             </form>

                         </div>

                         <div class="logo-bar-icons d-inline-block ml-auto">
                             <div class="d-inline-block d-lg-none">
                                 <div class="nav-search-box">
                                     <a href="#" class="nav-box-link">
                                         <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                     </a>
                                 </div>
                             </div>

                             <div class="d-none d-lg-inline-block">
                                 <div class="nav-wishlist-box" id="wishlist">
                                     <a href="{{ route('wishlists.index') }}" class="nav-box-link">
                                         <i class="la la-heart-o d-inline-block nav-box-icon"></i>
                                         <span class="nav-box-text d-none d-lg-inline-block">{{__('Wishlist')}}</span>
                                         @if(Auth::check())
                                         @php
                                         $wishlists = \App\Wishlist::where('user_id',Auth::user()->id)->get();
                                         @endphp
                                         <span
                                             class="nav-box-number">{{ $wishlists !=null ? count($wishlists): '0'}}</span>
                                         @else
                                         <span class="nav-box-number">0</span>
                                         @endif
                                     </a>
                                 </div>
                             </div>
                             <div class="d-inline-block" data-hover="dropdown">
                                 <div class="nav-cart-box dropdown" id="cart_items">
                                     <a href="{{ route('cart') }}" class="nav-box-link" data-toggle="dropdown"
                                         aria-haspopup="true" aria-expanded="false">
                                         <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
                                         <span class="nav-box-text d-none d-xl-inline-block">Cart</span>
                                         @if(Session::has('cart'))
                                         <span class="nav-box-number"
                                             id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
                                         @else
                                         <span class="nav-box-number" id="cart_items_sidenav">0</span>
                                         @endif
                                     </a>
                                     {{-- <a href="{{ route('cart') }}" >
                                     <i class=""></i>
                                     <span>{{__('Cart')}}</span>
                                     @if(Session::has('cart'))
                                     <span class="badge" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
                                     @else
                                     <span class="badge" id="cart_items_sidenav">0</span>
                                     @endif
                                     </a> --}}
                                     <ul class="dropdown-menu dropdown-menu-right px-0">
                                         <li>
                                             <div class="dropdown-cart px-0">
                                                 @if(Session::has('cart'))
                                                 @if(count($cart = Session::get('cart')) > 0)
                                                 <div class="dc-header">
                                                     <h3 class="heading heading-6 strong-700">{{__('Cart Items')}}</h3>
                                                 </div>
                                                 <div class="dropdown-cart-items c-scrollbar">
                                                     @php
                                                     $total = 0;
                                                     @endphp
                                                     @foreach($cart as $key => $cartItem)
                                                     @php
                                                     $product = \App\Product::find($cartItem['id']);
                                                     $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                     @endphp
                                                     <div class="dc-item">
                                                         <div class="d-flex align-items-center">
                                                             <div class="dc-image">
                                                                 <a href="{{ route('product', $product->slug) }}">
                                                                     <img class="img-fluid"
                                                                         src="{{ asset('storage/'.$product->featured_img) }}"
                                                                         data-src="{{ asset('storage/'.$product->featured_img) }}"
                                                                         class="img-fluid lazyload"
                                                                         alt="{{ __($product->name) }}">
                                                                 </a>
                                                             </div>
                                                             <div class="dc-content">
                                                                 <span
                                                                     class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                                     <a href="{{ route('product', $product->slug) }}">
                                                                         {{ __($product->name) }}
                                                                     </a>
                                                                 </span>

                                                                 <span
                                                                     class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                                                 <span
                                                                     class="dc-price">{{ number_format($cartItem['price']*$cartItem['quantity'],2) }}</span>
                                                             </div>
                                                             <div class="dc-actions">
                                                                 <button onclick="removeFromCart({{ $key }})">
                                                                     <i class="la la-close"></i>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     @endforeach
                                                 </div>
                                                 <div class="dc-item py-3">
                                                     <span class="subtotal-text">{{__('Subtotal')}}</span>
                                                     <span class="subtotal-amount">{{ number_format($total,2) }}</span>
                                                 </div>
                                                 <div class="py-2 text-center dc-btn">
                                                     <ul class="inline-links inline-links--style-3">
                                                         <li class="px-1">
                                                             <a href="{{ route('cart') }}"
                                                                 class="link link--style-1 text-capitalize btn btn-default px-3 py-1">
                                                                 <i class="la la-shopping-cart"></i> {{__('View cart')}}
                                                             </a>
                                                         </li>
                                                         @if (Auth::check())
                                                         <li class="px-1">
                                                             <a href="{{ route('checkout') }}"
                                                                 class="link link--style-1 text-capitalize btn btn-default px-3 py-1 light-text">
                                                                 <i class="la la-mail-forward"></i> {{__('Checkout')}}
                                                             </a>
                                                         </li>
                                                         @endif
                                                     </ul>
                                                 </div>
                                                 @else
                                                 <div class="dc-header">
                                                     <h3 class="heading heading-6 strong-700">
                                                         {{__('Your Cart is empty')}}</h3>
                                                 </div>
                                                 @endif
                                                 @else
                                                 <div class="dc-header">
                                                     <h3 class="heading heading-6 strong-700">
                                                         {{__('Your Cart is empty')}}</h3>
                                                 </div>
                                                 @endif
                                             </div>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     {{-- <div class="hover-category-menu" id="hover-category-menu">
        <div class="container">
            <div class="row no-gutters position-relative">
                <div class="col-md-3 position-static">
                    <div class="category-sidebar" id="category-sidebar">
                        <div class="all-category">
                            <span>CATEGORIES</span>
                            <a href="https://ac.nosprodev.com/categories" class="d-inline-block">See All &gt;</a>
                        </div>
                        <ul class="categories">
                            <li class="category-nav-element" data-id="1">
                                <a href="https://ac.nosprodev.com/search?category=Demo-category-1">
                                    <img class="cat-image lazyload"
                                        src="https://ac.nosprodev.com/public/frontend/images/placeholder.jpg"
                                        data-src="https://ac.nosprodev.com/public/uploads/categories/icon/KjJP9wuEZNL184XVUk3S7EiZ8NnBN99kiU4wdvp3.png"
                                        width="30" alt="Demo category 1">
                                    <span class="cat-name">Demo category 1</span>
                                </a>
                                <div class="sub-cat-menu c-scrollbar">
                                    <div class="c-preloader">
                                        <i class="fa fa-spin fa-spinner"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="category-nav-element" data-id="2">
                                <a href="https://ac.nosprodev.com/search?category=Demo-category-2">
                                    <img class="cat-image lazyload"
                                        src="https://ac.nosprodev.com/public/frontend/images/placeholder.jpg"
                                        data-src="https://ac.nosprodev.com/public/uploads/categories/icon/h9XhWwI401u6sRoLITEk9SUMRAlWN8moGrpPfS6I.png"
                                        width="30" alt="Demo category 2">
                                    <span class="cat-name">Demo category 2</span>
                                </a>
                                <div class="sub-cat-menu c-scrollbar">
                                    <div class="c-preloader">
                                        <i class="fa fa-spin fa-spinner"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="category-nav-element" data-id="3">
                                <a href="https://ac.nosprodev.com/search?category=Demo-category-3">
                                    <img class="cat-image lazyload"
                                        src="https://ac.nosprodev.com/public/frontend/images/placeholder.jpg"
                                        data-src="https://ac.nosprodev.com/public/uploads/categories/icon/rKAPw5rNlS84JtD9ZQqn366jwE11qyJqbzAe5yaA.png"
                                        width="30" alt="Demo category 3">
                                    <span class="cat-name">Demo category 3</span>
                                </a>
                                <div class="sub-cat-menu c-scrollbar">
                                    <div class="c-preloader">
                                        <i class="fa fa-spin fa-spinner"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
 </div>
 <!-- Navbar -->

 <!-- <div class="main-nav-area d-none d-lg-block">
       <nav class="navbar navbar-expand-lg navbar--bold navbar--style-2 navbar-light bg-default">
           <div class="container">
               <div class="collapse navbar-collapse align-items-center justify-content-center" id="navbar_main">
                   <ul class="navbar-nav">
                                                   <li class="nav-item">
                               <a class="nav-link" href="https://ac.nosprodev.com/search?q=das">das</a>
                           </li>
                                                   <li class="nav-item">
                               <a class="nav-link" href="https://ac.nosprodev.com/search?q=dcs">dcs</a>
                           </li>
                                           </ul>
               </div>
           </div>
       </nav>
   </div> -->