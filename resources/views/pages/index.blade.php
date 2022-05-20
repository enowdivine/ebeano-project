<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="robots" content="index, follow">

    @php
    $seosetting = App\SeoSetting::first();
    $generalsetting = App\GeneralSetting::first();
    @endphp
    
    <meta name="description" content="@yield('meta_description', isset($seosetting->description)? $seosetting->description:'' )" />
    <meta name="keywords" content="@yield('meta_keywords', isset($seosetting->keyword)?$seosetting->keyword:'')">
    <meta name="author" content="{{ isset($seosetting->author) ?$seosetting->author:'' }}">
    <meta name="sitemap_link" content="{{ isset($seosetting->sitemap_link) ?$seosetting->sitemap_link:'' }}">
    
    
    @if(!isset($detailedProduct) && isset($generalsetting))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ config('app.name', 'Ebeano Market') }}">
        <meta itemprop="description" content="{{ $seosetting->description }}">
        <meta itemprop="image" content="{{ asset($generalsetting->logo) }}">
    
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="{{ config('app.name', 'Ebeano Market') }}">
        <meta name="twitter:description" content="{{ $seosetting->description }}">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="{{ asset($generalsetting->logo) }}">
    
        <!-- Open Graph data -->
        <meta property="og:title" content="{{ config('app.name', 'Ebeano Market') }}" />
        <meta property="og:type" content="Ecommerce Site" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{ asset($generalsetting->logo) }}" />
        <meta property="og:description" content="{{ $seosetting->description }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    @endif

    <link type="image/x-icon" href="{{ asset('assets/images/favicon1.png') }}" rel="icon" />
    
    <title>Ebeano</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;900&amp;display=swap"
      type="text/css"
      rel="stylesheet"
      media="all"
    />
    <!-- fontawesome  -->
    <link
      rel="stylesheet"
      href="{{ asset('assets/homepage/assets/plugins/fontaswesome/v5.12.0/css/all.css') }}"
    />
     <!-- custom -->
    <link href="{{ asset('assets/css/main.css') }}?{{uniqid()}}" type="text/css" rel="stylesheet" media="all" />
    <link
      href="{{ asset('assets/homepage/assets/css/styles.css') }}?{{uniqid()}}"
      type="text/css"
      rel="stylesheet"
      media="all"
    />
    
    <!-- custom -->
    <link href="{{ asset('assets/homepage/assets/css/custom.css') }}?{{uniqid()}}" type="text/css" rel="stylesheet" media="all" />
    
    <!-- responsive -->
    <link href="{{ asset('assets/homepage/assets/css/responsive.css') }}?{{uniqid()}}" type="text/css" rel="stylesheet" media="all" />
    
    <!-- swiper  -->
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{ asset('assets/homepage/assets/plugins/swiper/swiper-bundle.min.css') }}" />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/homepage/assets/plugins/slick/slick.css') }}?{{uniqid()}}"
    />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/assets/plugins/slick/slick-theme.css') }}?{{uniqid()}}" />
    
    <link href="{{ asset('assets/homepage/image/catalog/cart.png') }}" rel="icon" />
    <!--Custom code between head tag-->
    <style>
        .promo_image img {
            border-radius:5px;
        }
        .new_category_image img {
            border-radius:30px;
        }
    </style>
  </head>
  <body class="common-home">
    <div class="mz-pure-container">
      <div
        id="mz-component-1626147655"
        class="mz-pure-drawer"
        data-position="left"
      >
        <div id="entry_216901" class="entry-component container-fluid">
          <div id="entry_216902" class="entry-row row">
            <div
              id="entry_216903"
              class="
                entry-col
                gutters-y
                col-12
                justify-content-between
                align-items-center
              "
            >
              <div
                id="entry_216904"
                data-id="216904"
                class="entry-widget widget-html"
              >
                <h5>Top categories</h5>
              </div>
              <div
                id="entry_216905"
                data-id="216905"
                class="
                  entry-design
                  design-link
                  order-1
                  flex-grow-0 flex-shrink-0
                "
              >
                <a
                  href="#mz-component-1626147655"
                  data-toggle="mz-pure-drawer"
                  class="icon-left icon text-reset"
                  target="_self"
                >
                  <i class="icon fas fa-times"></i>
                </a>
              </div>
            </div>
          </div>
          @php 
            $categories = App\Category::where('featured',1)->get();
          @endphp
          <div
            id="entry_216906"
            data-id="216906"
            class="entry-widget widget-navbar pixel-space gutters-x-off"
          >
            <nav class="navbar no-expand navbar-light bg-default vertical">
              <div
                class="
                  collapse
                  navbar-collapse
                  show
                  align-items-stretch align-self-stretch
                "
                id="widget-navbar-216906"
              >
                <ul class="navbar-nav vertical">
                    @if(count($categories) > 0)
                    
                        @foreach($categories as $category)
                            
                          <li class="nav-item">
                            <a class="icon-left both nav-link" data-id="{{ $category->id }}" href="{{route('products.by_category',['slug' => $category->slug])}}">
                              <div
                                class="icon svg-icon"
                                style="width: 20px; height: 20px"
                              >
                                <img class="img-fluid" src="{{asset('storage/'.$category->icon)}}" alt="icon" width="30px" >
                              </div>
                              <div class="info">
                                <span class="title"> {{Str::title($category->name)}} </span>
                              </div>
                            </a>
                          </li>
                        @endforeach
                    @endif
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <div
        id="mz-component-162614767"
        class="mz-pure-drawer"
        data-position="right"
      >
        <div id="entry_216907" class="entry-component container-fluid">
          <div id="entry_216908" class="entry-row row">
            <div
              id="entry_216909"
              class="
                entry-col
                gutters-y
                col-12
                justify-content-between
                align-items-center
              "
            >
              <div
                id="entry_216910"
                data-id="216910"
                class="entry-widget widget-html"
              >
                <h5>Quick Links</h5>
              </div>
              <div
                id="entry_216911"
                data-id="216911"
                class="
                  entry-design
                  design-link
                  order-1
                  flex-grow-0 flex-shrink-0
                "
              >
                <a
                  href="#mz-component-162614767"
                  data-toggle="mz-pure-drawer"
                  class="icon-left icon text-reset"
                  target="_self"
                >
                  <i class="icon fas fa-times"></i>
                </a>
              </div>
            </div>
          </div>
          <div
            id="entry_216912"
            data-id="216912"
            class="entry-widget widget-navbar pixel-space gutters-x-off"
          >
            <nav class="navbar no-expand navbar-default bg-default vertical">
              <div
                class="
                  collapse
                  navbar-collapse
                  show
                  align-items-stretch align-self-stretch
                "
                id="widget-navbar-216912"
              >
                <ul class="navbar-nav vertical">
                  <!--<li class="nav-item">-->
                  <!--  <a class="icon-left both nav-link" href="special.html">-->
                  <!--    <i class="icon fas fa-tags"></i>-->
                  <!--    <div class="info">-->
                  <!--      <span class="title"> Special </span>-->
                  <!--    </div>-->
                  <!--    <span class="badge mx-1 mz-menu-label-53">Hot</span>-->
                  <!--  </a>-->
                  <!--</li>-->
                  <li class="nav-item">
                    <a class="icon-left both nav-link" href="{{ route('wishlists.index') }}">
                      <i class="icon fas fa-heart"></i>
                      <div class="info">
                        <span class="title"> Wishlist </span>
                      </div>
                    </a>
                  </li>
                  @if (Auth::guest())
                  <li class="nav-item">
                    <a class="icon-left both nav-link" href="/login">
                      <i class="icon fas fa-user-alt"></i>
                      <div class="info">
                        <span class="title"> Login </span>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="icon-left both nav-link" href="/register">
                      <i class="icon fas fa-user-alt"></i>
                      <div class="info">
                        <span class="title"> Register </span>
                      </div>
                    </a>
                  </li>
                  @else
                  <li class="nav-item">
                    <a class="icon-left both nav-link" href="{{ url('/dashboard') }}">
                      <i class="icon fas fa-user-alt"></i>
                      <div class="info">
                        <span class="title"> My account </span>
                      </div>
                    </a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <a
                      class="icon-left both nav-link"
                      href="{{ url('/track_order') }}"
                    >
                      <i class="icon fas fa-truck"></i>
                      <div class="info">
                        <span class="title"> Tracking </span>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="icon-left both nav-link" href="{{route('contact')}}">
                      <i class="icon fas fa-address-card"></i>
                      <div class="info">
                        <span class="title"> Contact us </span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <div
            id="entry_216913"
            data-id="216913"
            class="entry-design design-horizontal_line"
          >
            <hr />
          </div>
          <div
            id="entry_216914"
            data-id="216914"
            class="entry-design design-alert"
          >
            <div class="alert alert-info">
              <p>
                
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="mz-pure-overlay"></div>
      <div id="container" class="mz-pure-pusher-container">
        <header class="header">
          <div class="">
            <div id="top-header">
              <div id="section-244630449" class="collapse show">
                <!--mobile advert-->
                <main class="mobile-top-advert">
                    <img src="{{asset('assets/homepage/assets/image/promo/get-deals.gif')}}" alt="" />
                </main>
                <main class="top-advert">
                  <div class="container">
                    <img src="{{asset('assets/homepage/assets/image/promo/top-advt.gif')}}" alt="" />
                  </div>
                </main>
                
                <div id="top-bars">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="d-flex">
                          <a href="{{route('vendor.quick_register')}}" class="sell-on-ebeano"
                            ><span class="fa-stack fa-lg"
                              ><i class="fa fa-circle fa-stack-2x"></i
                              ><i
                                class="fa fa-star fa-stack-1x fa-inverse"
                                style="font-size: 11px"
                              ></i></span
                            ><strong>Sell on Ebeano</strong></a
                          >
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="top-services d-flex justify-content-center">
                          <a href="{{url('/marketplace')}}"
                            ><i class="fa fa-map-marker"></i> Market</a
                          >
                          <a href="{{url('/artisans')}}"
                            ><i class="fa fa-audio-description"></i>Artisan</a
                          >
                          <a href="{{url('/category/automobile')}}"><i class="fa fa-car"></i>Automobile</a>
                          <a href="{{url('/estate')}}"
                            ><i class="fas fa-building"></i>Real Estate</a
                          >
                          <a href="{{url('/bookings')}}"><i class="fa fa-newspaper"></i>Booking</a>
                          <a href="{{url('/eforms')}}"
                            ><i class="fa fa-certificate"></i>Education</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- top header end -->

            <div id="main-header">
              <div
                id="entry_216881"
                class="
                  entry-section
                  container
                  d-none d-md-flex
                  flex-row
                  align-items-center
                  flex-wrap flex-md-nowrap
                "
              >
            
                <div
                  id="entry_216882"
                  data-id="216882"
                  class="entry-design design-image flex-grow-0 flex-shrink-0"
                >
                  <figure class="figure">
                    <a href="#" title="" target="_self">
                      <img
                        src="{{ asset('assets/homepage/assets/image/catalog/ebeano-logo.png') }}"
                        alt="Ebeano Logo"
                        width="151"
                        height="50"
                        class="figure-img img-fluid m-0 default"
                      />
                    </a>
                  </figure>
                </div>
                <div
                  id="entry_216883"
                  data-id="216883"
                  class="entry-widget widget-search"
                >
                  <div class="search-wrapper">
                    <form
                       action="/search"
                      method="GET"
                    >
                      <div id="search" class="d-flex">
                        <div class="search-input-group flex-fill">
                          <div class="search-input d-flex">
                            <div class="flex-fill">
                              <input
                                type="text"
                                 id="search" name="q"
                                value=""
                                data-autocomplete="5"
                                placeholder="Search products, brands and categories"
                              />
                            </div>
                          </div>
                          <div class="dropdown">
                            <ul class="dropdown-menu autocomplete w-100"></ul>
                          </div>
                        </div>
                        <div class="search-button">
                          <button type="submit" class="type-text">
                            Search
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
                      </div>
                    </form>
                  </div>
                </div>
                <div
                  id="entry_216884"
                  data-id="216884"
                  class="entry-design design-link flex-grow-0 flex-shrink-0"
                >
                  <ul class="navbar-nav flex-row">
                    <li class="nav-item dropdown mr-3 dropdown-hoverable">
                      <a
                        class="icon-left both nav-link px-2 dropdown-toggle"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        href="#"
                      >
                        <i class="icon far fa-user" style="font-size: 19px"></i>
                        <div class="info">
                          <span class="title">Account </span>
                        </div>
                      </a>
                      <ul class="mz-sub-menu-96 pt-0 dropdown-menu">
                        <li class="px-3 py-3">
                          <a
                            class="icon-left both sign-in dropdown-item"
                            href="/login"
                          >
                            <div class="info">
                              <span class="title"> Sign In </span>
                            </div>
                          </a>
                        </li>
                        <div class="menu-divider"></div>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="icon far fa-user"></span>
                              <span class="title"> My Account </span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="icon fas fa-store-alt"></span>
                              <span class="title"> Orders </span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="{{ route('wishlists.index') }}">
                            <div class="info">
                              <span class="icon far fa-heart"></span>
                              <span class="title"> Saved Items </span>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <!-- help -->
                    <li class="nav-item dropdown dropdown-hoverable">
                      <a
                        class="icon-left both nav-link px-2 dropdown-toggle"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        href="#"
                      >
                        <i
                          class="icon far fa-question-circle"
                          style="font-size: 19px"
                        ></i>
                        <div class="info">
                          <span class="title">Help</span>
                        </div>
                      </a>
                      <ul class="mz-sub-menu-96 dropdown-menu">
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="title">Help center </span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="title">Place & track orders </span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="title">Orders cancellation</span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="title">Returns & Refunds</span>
                            </div>
                          </a>
                        </li>
                        <li class="">
                          <a class="icon-left both dropdown-item" href="#">
                            <div class="info">
                              <span class="title">Payment</span>
                            </div>
                          </a>
                        </li>
                        <div class="menu-divider"></div>
                        <li class="px-3 py-3">
                          <a
                            class="icon-left both sign-in dropdown-item"
                            href="#"
                          >
                            <div class="info">
                              <span class="title"> Live Help </span>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
                <div
                  id="entry_216886"
                  data-id="216886"
                  class="entry-widget widget-cart flex-grow-0 flex-shrink-0"
                >
                  <a
                    href="cart.html"
                    data-total_format="(\d+) item\(s\) \- (.+)"
                    class="cart text-reset text-decoration-none no-title"
                  >
                    <div class="cart-icon">
                      <i class="fas fa-shopping-cart"></i>
                      <span class="badge badge-pill badge-info cart-item-total"
                        >0</span
                      >
                    </div>
                    <div class="cart-info">
                      <div class="cart-items">0 item(s) - $0.00</div>
                    </div>
                  </a>
                </div>
              </div>
              <div
                id="entry_216887"
                data-toggle="sticky"
                data-sticky-up="1"
                class="
                  entry-section
                  container
                  d-md-none
                  flex-row
                  align-items-center
                "
              >
                <div
                  id="entry_216888"
                  data-id="216888"
                  class="entry-design design-link flex-grow-0 flex-shrink-0"
                >
                  <a
                    href="#mz-component-1626147655"
                    data-toggle="mz-pure-drawer"
                    class="icon-left icon text-reset"
                    target="_self"
                  >
                    <span
                      data-toggle="tooltip"
                      title="Shop by Category"
                      class="icon svg-icon"
                      style="width: 20px; height: 20px"
                    >
                      <i class="fas fa-bars"></i>
                    </span>
                  </a>
                </div>
                <div
                  id="entry_216889"
                  data-id="216889"
                  class="
                    entry-design
                    design-image
                    mr-auto
                    flex-grow-0 flex-shrink-0
                  "
                >
                  <figure class="figure">
                    <a href="{{ url('/') }}" title="Ebeano" target="_self">
                      <img
                        src="{{ asset('assets/homepage/assets/image/catalog/ebeano-logo.png') }}"
                        alt="Ebeano Market"
                        width="120"
                        height="40"
                        class="figure-img img-fluid m-0 default"
                      />
                    </a>
                  </figure>
                </div>
                <div
                  id="entry_216890"
                  data-id="216890"
                  class="entry-design design-link flex-grow-0 flex-shrink-0"
                >
                    <a
                    style="color:#eb790f!important;font-weight:bold"
                    href="{{route('vendor.quick_register')}}"
                    data-toggle="mz-pure-drawer"
                    class="right-widget"
                    target="_self"
                  >
                    Start Selling
                  </a>
                  <a
                    href="/dashboard"
                    data-toggle="mz-pure-drawer"
                    class="icon-left icon text-reset right-widget"
                    target="_self"
                  >
                    <span class="iconify" style="font-size: 25px" data-icon="feather:user"></span>
                  </a>
                  <a
                    style="margin-right: -15px;"
                    href="/cart"
                    data-toggle="mz-pure-drawer"
                    class="icon-left icon text-reset"
                    target="_self"
                  >
                    <span class="iconify" style="font-size: 25px" data-icon="feather:shopping-cart"></span>
                  </a>
                  
                </div>
                
                <div
                  id="entry_216891"
                  data-id="216891"
                  class="entry-widget widget-cart flex-grow-0 flex-shrink-0"
                >
                
                  <!--desktop-->
                  <a href="cart.html" data-total_format="(\d+) item\(s\) \- (.+)"
                    class="cart top-cart text-reset text-decoration-none no-title">
                    
                    <div class="cart-icon">
                      <div class="icon svg-icon" style="width: 30px; height: 30px">
                        <svg>
                          <use
                            xlink:href="#svgd892f9195deca49932f59ef00e4f6b89"
                          ></use>
                        </svg>
                      </div>
                      <span class="badge badge-pill badge-info cart-item-total"
                        >0</span>
                    </div>
                    <div class="cart-info">
                      <div class="cart-items">0 item(s) - $0.00</div>
                    </div>
                  </a>
                  
                </div>
              </div>
            </div>
            
            <!--mobile search -->
            <div id="main-header" data-toggle="sticky"
                data-sticky-up="1" class="mobile-search">
                <form style="background: #fff;" class="search-mobile">
                  <input class="search-mobile" type="text" placeholder="Search products, brands and categories">
                </form>
            </div>
            
            <!--mobile top menus services -->
            <div id="mobile-top-menus">
                <a class="service" href="{{url('/marketplace')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="feather:shopping-bag"></span>
                    <div>Market</div>
                </a>
                <a class="service" href="{{url('/artisans')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="feather:scissors"></span>
                    <div>Artisan</div>
                </a>
                <a class="service" href="{{url('/artisans')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="feather:tool"></span>
                    <div>Automobile</div>
                </a>
                <a class="service" href="{{url('/estate')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="feather:home"></span>
                    <div>Estate</div>
                </a>
                <a class="service" href="{{url('/eforms')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="feather:book-open"></span>
                    <div>Education</div>
                </a>
                <a class="service" href="{{url('/bookings')}}">
                    <span style="font-size: 20px" class="iconify" data-icon="carbon:flight-schedule"></span>
                    <div>Bookings</div>
                </a>
            </div>
            
            
          </div>
        </header>
        
        
        <main class="content" id="common-home">
          <div id="" class="container">
            <!-- 3 COLUMN -->
            <div class="row hero_banner">
              <!-- categories -->
              
              <div class="col-lg-2 col-xl-2 hero_category">
                <div class="list-group side-category">
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                          <a style="font-size:13px" data-id="{{ $category->id }}" href="{{route('products.by_category',['slug' => $category->slug])}}" class="list-group-item list-group-item-action">
                            <img class="img-fluid" src="{{asset('storage/'.$category->icon)}}" alt="icon" width="13px" > {{Str::title($category->name)}}</a
                          >
                        @endforeach
                    @endif
                </div>
              </div>

              <!-- large banners -->
              <div class="col-lg-8 col-xl-8 hero_main_banner">
                <!-- Swiper -->
                <div class="swiper mainBanner">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        
                      <img src="{{ asset('assets/images/banners/slider1.jpg') }}" alt="" />
                    </div>
                    <div class="swiper-slide">
                      <img
                        src="{{ asset('assets/images/banners/slider2.jpg') }}"
                        alt=""
                      />
                    </div>
                    <div class="swiper-slide">
                      <img
                        src="{{ asset('assets/images/banners/slider3.jpg') }}"
                        alt=""
                      />
                    </div>
                    <!--<div class="swiper-slide">-->
                    <!--  <img-->
                    <!--    src="{{asset('assets/homepage/assets/image/promo/ebeano-utility.jpg')}}"-->
                    <!--    alt=""-->
                    <!--  />-->
                    <!--</div>-->
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
                <!-- Swiper -->
              </div>

              <!-- small banners -->
              <div class="col-lg-2 col-xl-2 hero_mini_banner">
                <div class="side-banner">
                  <a href="{{ url('expressbills') }}">
                    <img style="border-radius:5px" src="{{ asset('assets/homepage/assets/image/banners/free-delivery.gif') }}" alt="Ebeano - Utility bills" />
                  </a>

                  <a href="{{ url('eforms') }}">
                    <img
                      style="border-radius:5px"
                      src="{{ asset('assets/homepage/assets/image/banners/academic-form.jpg') }}"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
            
            <!-- new category item mobile -->
            <main class="mobile_new_category">
              <a href="{{ url('/category/automobile') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesAutomobile.jpg')}}" alt="Automobile" />
                </div>
                <p class="mobile_new_category_title">Automobile</p>
              </a>

              <a href="{{ url('/category/phone-tablets') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesPhone.jpg')}}" alt="Phones & Tablets" />
                </div>
                <p class="mobile_new_category_title">Phones & Tablets</p>
              </a>

              <a href="{{ url('/category/fashion') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesfashion.jpg')}}" alt="Fashion" />
                </div>
                <p class="mobile_new_category_title">Fashion</p>
              </a>

              <a href="{{ url('/category/health-beauty') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesbeauty.jpg')}}" alt="Health & Beauty" />
                </div>
                <p class="mobile_new_category_title">Health & Beauty</p>
              </a>

              <a href="{{ url('/category/electronics') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categorieselectronics.jpg')}}" alt="Electronics" />
                </div>
                <p class="mobile_new_category_title">Electronics</p>
              </a>

              <a href="{{ url('/category/baby-products') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesbaby.jpg')}}" alt="Baby Products" />
                </div>
                <p class="mobile_new_category_title">Baby Products</p>
              </a>

              <a href="{{ url('/category/gaming') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesgame.jpg')}}" alt="Video Games" />
                </div>
                <p class="mobile_new_category_title">Video Games</p>
              </a>

              <a href="{{ url('/category/home-office') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesOffice.jpg')}}" alt="Home & Office" />
                </div>
                <p class="mobile_new_category_title">Home & Office</p>
              </a>

              <a href="{{ url('/category/supermarket') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriessupermarket.jpg')}}" alt="Supermarket" />
                </div>
                <p class="mobile_new_category_title">Supermarket</p>
              </a>

              <a href="{{ url('/category/computing') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesComputing.jpg')}}" alt="Computing" />
                </div>
                <p class="mobile_new_category_title">Computing</p>
              </a>

              <a href="{{ url('/category/sporting-goods') }}" class="mobile_new_category_item">
                <div class="mobile_new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesSport.jpg')}}" alt="Sporting Items" />
                </div>
                <p class="mobile_new_category_title">Sporting Items</p>
              </a>

            </main>
            
            <!-- new category item for desktop-->
            <main class="new_category">
              <a href="{{ url('/category/automobile') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesAutomobile.jpg')}}" alt="Automobile" />
                </div>
                <p class="new_category_title">Automobile</p>
              </a>

              <a href="{{ url('/category/phone-tablets') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesPhone.jpg')}}" alt="Phones & Tablets" />
                </div>
                <p class="new_category_title">Phones & Tablets</p>
              </a>

              <a href="{{ url('/category/fashion') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesfashion.jpg')}}" alt="Fashion" />
                </div>
                <p class="new_category_title">Fashion</p>
              </a>

              <a href="{{ url('/category/health-beauty') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesbeauty.jpg')}}" alt="Health & Beauty" />
                </div>
                <p class="new_category_title">Health & Beauty</p>
              </a>

              <a href="{{ url('/category/electronics') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categorieselectronics.jpg')}}" alt="Electronics" />
                </div>
                <p class="new_category_title">Electronics</p>
              </a>

              <a href="{{ url('/category/baby-products') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesbaby.jpg')}}" alt="Baby Products" />
                </div>
                <p class="new_category_title">Baby Products</p>
              </a>

              <a href="{{ url('/category/gaming') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriesgame.jpg')}}" alt="Video Games" />
                </div>
                <p class="new_category_title">Video Games</p>
              </a>

              <a href="{{ url('/category/home-office') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesOffice.jpg')}}" alt="Home & Office" />
                </div>
                <p class="new_category_title">Home & Office</p>
              </a>

              <a href="{{ url('/category/supermarket') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/Categoriessupermarket.jpg')}}" alt="Supermarket" />
                </div>
                <p class="new_category_title">Supermarket</p>
              </a>

              <a href="{{ url('/category/computing') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesComputing.jpg')}}" alt="Computing" />
                </div>
                <p class="new_category_title">Computing</p>
              </a>

              <a href="{{ url('/category/sporting-goods') }}" class="new_category_item">
                <div class="new_category_image">
                  <img src="{{asset('assets/homepage/assets/image/category/CategoriesSport.jpg')}}" alt="Sporting Items" />
                </div>
                <p class="new_category_title">Sporting Items</p>
              </a>
            </main>
            
            
            <!--flash sales-->
            @php
            $latest_product = App\Product::where('published',1)->where('featured_img','<>', null)->where('unit_price','>', 0)->orderBy('created_at','desc')->limit(12)->get();
           @endphp
            @if ($latest_product != null)
             <section id="entry_213257" class="top-product">
              <div class="top-product-header">
                <h3 class="module-title">
                  <i class="fa fa-tag"></i> Flash Sales | Free Delivery
                </h3>
                <h3 class="module-counter">Time Left: 09h : 42m : 01s</h3>
                <a href="#">See all <i class="fa fa-angle-right"></i></a>
              </div>
              <div class="entry-module module-mz_product_listing">
                <div id="mz-product-listing-37213259" class="mz-tab-listing">
                  <div class="mz-tab-listing-content clearfix"></div>
                  <div class="tab-content">
                    <div
                      id="mz-product-tab-37213259-0"
                      class="active show tab-pane fade"
                    >
                      <div class="top_product_swiper">
                            @foreach($latest_product as $latest)
                                <!--<a href="{{route('product', $latest->slug)}}">-->
                                  <div class="product-thumb image-top">
                                    <div class="product-thumb-top">
                                      <span class="mz-new-badge">Hot</span>
                                      <div class="image">
                                        <div class="product_img_wrapper">
                                          <img
                                            class="lazy-load"
                                            src="{{asset('storage/'.$latest->featured_img)}}"
                                            alt="{{$latest->name}}"
                                            title="{{$latest->name}}"
                                          />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="caption">
                                      <h4 class="title">
                                        <a class="text-ellipsis-50" href="{{route('product', $latest->slug)}}"
                                          >{{$latest->name}}
                                        </a>
                                      </h4>
                                      <div class="price">
                                          @php
                                            $unitPrice = $latest->unit_price ?? 0;
                                          @endphp
                                        <span class="price-new">₦ {{ $unitPrice }}</span>
                                        <span class="price-old">{{ ($latest->discount.'% off') ?? ''}}</span>
                                      </div>
                                      <button type="button" class="btn buy-now btn-flash-buy mr-1" onclick="showAddToCartModal({{ $latest->id }})">Buy now</button>
                                    </div>
                                  </div>
                                <!--</a>-->
                            @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

        @endif
            
    
    <!-- promo ads -->
    <section class="promo_adss" style="margin: 2rem 0;">
      <h2 class="promo_title">Don't Miss Out On These!!!</h2>
      <div class="promo_box">
        <a href="{{ url('marketplace') }}" class="promo_link">
          <div class="promo_image">
            <img
              src="{{asset('assets/homepage/assets/image/promo/shop-everything.png')}}"
              alt=""
            />
          </div>
        </a>
        <a href="{{ url('artisans') }}" class="promo_link">
          <div class="promo_image">
            <img
              src="{{asset('assets/homepage/assets/image/promo/ebeano-market.jpg')}}"
              alt=""
            />
          </div>
        </a>
      </div>
    </section>
    <section class="promo_adss">
      <div class="promo_box">
        <a href="{{ url('bookings') }}" class="promo_link">
          <div class="promo_image">
            <img
              src="{{asset('assets/homepage/assets/image//promo/best-hotel.jpg')}}"
              alt=""
            />
          </div>
        </a>
        <a href="{{ url('expressbills') }}" class="promo_link">
          <div class="promo_image">
            <img
              src="{{asset('assets/homepage/assets/image//promo/ebeano-bills.png')}}"
              alt=""
            />
          </div>
        </a>
      </div>
    </section>
     <!-- top deals -->
    <section class="top-deals">
      <div class="container p-0">
        <div class="row">
          <!-- column 1 -->
          
          <div class="col-md- col-3 col-lg-3 col-xl-3">
            <a href="{{url('/marketplace')}}">
              <div class="icon_wrapper">
                <img
                  src="{{ asset('assets/images/services/marketplace.svg') }}"
                  alt=""
                  width="36"
                />
              </div>
              <span class="deal-title">Marketplace</span>
            </a>
          </div>
          <!-- coulmn 2 -->
          
          <div class="col-md-3 col-3 col-lg-3 col-xl-3">
            <a href="{{url('/expressbills')}}">
              <div class="icon_wrapper">
                <img
                  src="{{ asset('assets/images/services/utilities.svg') }}"
                  alt=""
                  width="36"
                />
              </div>
              <span class="deal-title">Utility Bills</span>
            </a>
          </div>
          <!-- column 3 -->
          <div class="col-md-3 col-3 col-lg-3 col-xl-3">
            <a href="{{url('/artisans')}}">
              <div class="icon_wrapper">
                <img
                  src="{{ asset('assets/images/services/artisan.svg') }}"
                  alt=""
                  width="36"
                />
              </div>
              <span class="deal-title">Artisans</span>
            </a>
          </div>
          <!-- column 4 -->
          <div class="col-md-3 col-3 col-lg-3 col-xl-3">
            <a href="{{url('/estate')}}">
              <div class="icon_wrapper">
                <img
                  src="{{ asset('assets/images/services/real_estate.svg') }}"
                  alt=""
                  width="36"
                />
              </div>
              <span class="deal-title">Real Estate</span>
            </a>
          </div>
        </div>
      </div>
    </section>
            
            
    @php
            $todays_deal = App\Product::where('published',1)->where('todays_deal',1)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at','desc')->limit(6)->get();
    @endphp

    @if ($todays_deal != null)
            <section id="entry_213257" class="card collections">
              <div class="card-header d-flex justify-content-between">
                <span>
                  <span class="font-weight-bolder">Top Deal</span>
                </span>
                <a href="{{route('products')}}" class="see-all">See All</a>
              </div>
              <div class="card-body">
                <div class="row m-0 top_deal_products">
                    
                @foreach($todays_deal as $deal)
                @if($deal->featured_img != null && $deal->unit_price > 0)
                  <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                    <a href="{{route('product', $deal->slug)}}">
                    <div class="product-thumb image-top">
                      <div class="product-thumb-top">
                        <div class="image">
                          <div class="product_img_wrapper">
                            <img
                              class="lazy-load"
                              src="{{asset('storage/'.$deal->featured_img)}}"
                              alt="{{$deal->name}}"
                              title="{{$deal->name}}"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="caption">
                        <h4 class="title">
                          <a class="text-ellipsis-50" href="{{route('product', $deal->slug)}}"
                            >{{$deal->name}}
                          </a>
                        </h4>
                        <div class="price">
                          <span class="price-new">₦{{number_format($deal->unit_price ?? 0, 2)}}</span>
                          <span class="price-old">{{($deal->discount==0.00)?'' : ('-'.number_format($deal->discount,0).'%')}}</span>
                        </div>
                        <button type="button" class="btn add-to-cart btn-default mr-2" onclick="showAddToCartModal({{ $deal->id }})">Add to cart</button>
                      </div>
                    </div>
                    </a>
                  </div>
               @endif
                @endforeach
                  
                </div>
              </div>
            </section>
         @endif
         
        
        {{--  AUTOMOBILE CATEGORY --}}
         
        @php
            $automobileCat = App\Category::where('name', 'automobile')->first();
            $automobileProducts = App\Product::where('published',1)->where('category_id', $automobileCat->id)->where('todays_deal',1)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at', 'desc')->limit(12)->get();
        @endphp
        @if($automobileProducts->count() > 0)
            <section id="entry_213257" class="card collections">
                <div class="card-header d-flex justify-content-between">
                    <span>
                        <span class="font-weight-bolder">{{Str::title($automobileCat->name)}}</span>
                    </span>
                    <a href="{{route('products.by_category',['slug' => $automobileCat->slug])}}" class="see-all">See All</a>
                </div>
                 <div class="card-body">
                    <div class="row m-0 fashion_deals">
                    @foreach($automobileProducts as $automobileProduct)
                        @if($automobileProduct->featured_img != null && $automobileProduct->unit_price > 0)
                          <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                            <a href="{{route('product', $automobileProduct->slug)}}">
                            <div class="product-thumb image-top">
                              <div class="product-thumb-top">
                                <div class="image">
                                  <div class="product_img_wrapper">
                                    <img
                                      class="lazy-load"
                                      src="{{asset('storage/'.$automobileProduct->featured_img)}}"
                                      alt="{{$automobileProduct->name}}"
                                      title="{{$automobileProduct->name}}"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="caption">
                                <h4 class="title">
                                  <a class="text-ellipsis-50" href="{{route('product', $automobileProduct->slug)}}"
                                    >{{$automobileProduct->name}}
                                  </a>
                                </h4>
                                <div class="price">
                                  <span class="price-new">₦{{number_format($automobileProduct->unit_price ?? 0, 2)}}</span>
                                  <span class="price-old">{{($automobileProduct->discount==0.00)?'' : ('-'.number_format($automobileProduct->discount,0).'%')}}</span>
                                </div>
                                <button type="button" class="btn add-to-cart btn-default mr-2" onclick="showAddToCartModal({{ $automobileProduct->id }})">Add to cart</button>
                              </div>
                            </div>
                            </a>
                          </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif
            
            
        {{--  LATEST PRODUCTS --}}
         
        @php
            $jewelryCat = App\Category::where('name', 'Health & Beauty')->first();
            $latestProducts = App\Product::where('published',1)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at', 'desc')->limit(36)->get();
        @endphp
            @if($latestProducts->count() > 0)
                <section id="entry_213257" class="card collections">
                        <div class="card-header d-flex justify-content-between">
                            <span>
                                <span class="font-weight-bolder">{{Str::title('RECOMMENDED FOR YOU')}}</span>
                            </span>
                            <a href="{{route('products.by_category',['slug' => $jewelryCat->slug])}}" class="see-all">See All</a>
                        </div>
                         <div class="card-body">
                            <div class="row m-0 latest_products">
                                @foreach($latestProducts as $latestProduct)
                                    @if($latestProduct->featured_img != null && $latestProduct->unit_price > 0)
                                      <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                                        <a href="{{route('product', $latestProduct->slug)}}">
                                        <div class="product-thumb image-top">
                                          <div class="product-thumb-top">
                                            <div class="image">
                                              <div class="product_img_wrapper">
                                                <img
                                                  class="lazy-load"
                                                  src="{{asset('storage/'.$latestProduct->featured_img)}}"
                                                  alt="{{$latestProduct->name}}"
                                                  title="{{$latestProduct->name}}"
                                                />
                                              </div>
                                            </div>
                                          </div>
                                          <div class="caption">
                                            <h4 class="title">
                                              <a class="text-ellipsis-50" href="{{route('product', $latestProduct->slug)}}"
                                                >{{Str::title($latestProduct->name)}}
                                              </a>
                                            </h4>
                                            <div class="price">
                                              <span class="price-new">₦{{number_format($latestProduct->unit_price ?? 0, 2)}}</span>
                                              <span class="price-old">{{($latestProduct->discount==0.00)?'' : ('-'.number_format($latestProduct->discount,0).'%')}}</span>
                                            </div>
                                            <button type="button" class="btn add-to-cart btn-default mr-2" onclick="addToCart()">Add to cart</button>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    @endif
                                @endforeach
                        </div>
                    </div>
                </section>
            @endif
            
        
        {{--  FASHION CATEGORY --}}
         
        @php
            $fashionCat = App\Category::where('name', 'fashion')->first();
            $fashionProducts = App\Product::where('published',1)->where('category_id', $fashionCat->id)->where('todays_deal',1)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at', 'desc')->limit(6)->get();
        @endphp
        @if($fashionProducts->count() > 0)
            <section id="entry_213257" class="card collections">
                <div class="card-header d-flex justify-content-between">
                    <span>
                        <span class="font-weight-bolder">{{Str::title($fashionCat->name)}}</span>
                    </span>
                    <a href="{{route('products.by_category',['slug' => $fashionCat->slug])}}" class="see-all">See All</a>
                </div>
                 <div class="card-body">
                    <div class="row m-0 fashion_deals">
                        @foreach($fashionProducts as $fashionProduct)
                            @if($fashionProduct->featured_img != null && $fashionProduct->unit_price > 0)
                              <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                                <a href="{{route('product', $fashionProduct->slug)}}">
                                <div class="product-thumb image-top">
                                  <div class="product-thumb-top">
                                    <div class="image">
                                      <div class="product_img_wrapper">
                                        <img
                                          class="lazy-load"
                                          src="{{asset('storage/'.$fashionProduct->featured_img)}}"
                                          alt="{{$fashionProduct->name}}"
                                          title="{{$fashionProduct->name}}"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="caption">
                                    <h4 class="title">
                                      <a class="text-ellipsis-50" href="{{route('product', $fashionProduct->slug)}}"
                                        >{{$fashionProduct->name}}
                                      </a>
                                    </h4>
                                    <div class="price">
                                      <span class="price-new">₦{{number_format($fashionProduct->unit_price ?? 0, 2)}}</span>
                                      <span class="price-old">{{($fashionProduct->discount==0.00)?'' : ('-'.number_format($fashionProduct->discount,0).'%')}}</span>
                                    </div>
                                    <button type="button" class="btn add-to-cart btn-default mr-2" onclick="showAddToCartModal({{ $fashionProduct->id }})">Add to cart</button>
                                  </div>
                                </div>
                                </a>
                              </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </section>
        @endif
        
        {{--  COMPUTER CATEGORY --}}
         
        @php
            $computerCat = App\Category::where('name', 'regexp' , 'computing')->first();
            $computerProducts = App\Product::where('published',1)->where('category_id', $computerCat->id)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at', 'desc')->limit(12)->get();
        @endphp
        
            @if($latestProducts->count() > 0)
                <section id="entry_213257" class="card collections">
                        <div class="card-header d-flex justify-content-between">
                            <span>
                                <span class="font-weight-bolder">{{Str::title($computerCat->name)}}</span>
                            </span>
                            <a href="{{route('products.by_category',['slug' => $computerCat->slug])}}" class="see-all">See All</a>
                        </div>
                         <div class="card-body">
                            <div class="row m-0 computer_products">
                                @foreach($computerProducts as $computerProduct)
                                    @if($computerProduct->featured_img != null && $computerProduct->unit_price > 0)
                                      <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                                        <a href="{{route('product', $computerProduct->slug)}}">
                                        <div class="product-thumb image-top">
                                          <div class="product-thumb-top">
                                            <div class="image">
                                              <div class="product_img_wrapper">
                                                <img
                                                  class="lazy-load"
                                                  src="{{asset('storage/'.$computerProduct->featured_img)}}"
                                                  alt="{{$computerProduct->name}}"
                                                  title="{{$computerProduct->name}}"
                                                />
                                              </div>
                                            </div>
                                          </div>
                                          <div class="caption">
                                            <h4 class="title">
                                              <a class="text-ellipsis-50" href="{{route('product', $computerProduct->slug)}}"
                                                >{{$computerProduct->name}}
                                              </a>
                                            </h4>
                                            <div class="price">
                                              <span class="price-new">₦{{number_format($computerProduct->unit_price ?? 0, 2)}}</span>
                                              <span class="price-old">{{($computerProduct->discount==0.00)?'' : ('-'.number_format($computerProduct->discount,0).'%')}}</span>
                                            </div>
                                            <button type="button" class="btn add-to-cart btn-default mr-2" onclick="showAddToCartModal({{ $computerProduct->id }})">Add to cart</button>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    @endif
                                @endforeach
                        </div>
                    </div>
                </section>
            @endif
            
            
            {{--  ELECTRONIC CATEGORY --}}
         
        @php
            $electronicCat = App\Category::where('name', 'electronics')->first();
            $electronicProducts = App\Product::where('published',1)->where('category_id', $electronicCat->id)->where('todays_deal',1)->where('unit_price','<>',0)->where('featured_img','<>',null)->orderBy('created_at', 'desc')->limit(12)->get();
        @endphp
        @if($electronicProducts->count() > 0)
            <section id="entry_213257" class="card collections">
                <div class="card-header d-flex justify-content-between">
                    <span>
                        <span class="font-weight-bolder">{{Str::title($electronicCat->name)}}</span>
                    </span>
                    <a href="{{route('products.by_category',['slug' => $electronicCat->slug])}}" class="see-all">See All</a>
                </div>
                 <div class="card-body">
                    <div class="row m-0 fashion_deals">
                    @foreach($electronicProducts as $electronicProduct)
                        @if($electronicProduct->featured_img != null && $electronicProduct->unit_price > 0)
                          <div class="col-md-3 p-0 px-2 col-lg-2 col-4">
                            <a href="{{route('product', $electronicProduct->slug)}}">
                            <div class="product-thumb image-top">
                              <div class="product-thumb-top">
                                <div class="image">
                                  <div class="product_img_wrapper">
                                    <img
                                      class="lazy-load"
                                      src="{{asset('storage/'.$electronicProduct->featured_img)}}"
                                      alt="{{$electronicProduct->name}}"
                                      title="{{$electronicProduct->name}}"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="caption">
                                <h4 class="title">
                                  <a class="text-ellipsis-50" href="{{route('product', $electronicProduct->slug)}}"
                                    >{{$electronicProduct->name}}
                                  </a>
                                </h4>
                                <div class="price">
                                  <span class="price-new">₦{{number_format($electronicProduct->unit_price ?? 0, 2)}}</span>
                                  <span class="price-old">{{($electronicProduct->discount==0.00)?'' : ('-'.number_format($electronicProduct->discount,0).'%')}}</span>
                                </div>
                                <button type="button" class="btn add-to-cart btn-default mr-2" onclick="showAddToCartModal({{ $electronicProduct->id }})">Add to cart</button>
                              </div>
                            </div>
                            </a>
                          </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        

          </div>
        </main>
        
        
     <footer class="footer">
          <main class="upper-footer">
            <div
              id="entry_213180"
              class="entry-section container flex-row align-items-center flex-wrap flex-sm-nowrap"
            >
              <div
                id="entry_213181"
                data-id="213181"
                class="entry-design design-image d-none d-sm-block flex-grow-0 flex-shrink-0"
              >
                <figure class="figure">
                  <a
                    href="."
                  >
                   <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="132px" height="40px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 1000 267" xmlns:xlink="http://www.w3.org/1999/xlink">
                     <defs>
                      <font id="FontID1" horiz-adv-x="777" font-variant="normal" class="str0" style="fill-rule:nonzero" font-weight="900">
                    	<font-face font-family="Arial Black">
                    	</font-face>
                       <missing-glyph><path d="M0 0z"></path></missing-glyph>
                       <glyph unicode="R" horiz-adv-x="777"><path d="M76.005 0l0 716.038 368.67 0c68.2967,0 120.68,-5.88479 156.651,-17.7373 36.1376,-11.6038 65.3129,-33.4853 87.5259,-65.1471 22.1301,-31.8276 33.1538,-70.6175 33.1538,-116.287 0,-39.7016 -8.53709,-74.0157 -25.5284,-102.86 -16.8255,-29.0095 -40.116,-52.3 -69.9544,-70.3688 -18.8976,-11.2723 -44.8404,-20.804 -77.6627,-28.3465 26.2743,-8.78574 45.5035,-17.4886 57.4389,-26.2743 8.03978,-5.88479 19.8923,-18.4832 35.3916,-37.7124 15.3336,-19.1463 25.6113,-33.9826 30.833,-44.5089l107.501 -206.797 -250.062 0 -118.11 218.317c-15.0021,28.3465 -28.3465,46.6639 -40.0332,55.201 -15.9967,10.9407 -34.1484,16.494 -54.2893,16.494l-19.5607 0 0 -290.012 -221.964 0zm221.964 425.031l93.4936 0c10.029,0 29.6726,3.31538 58.6821,9.78036 14.6705,2.81807 26.6888,10.3605 35.8889,22.5446 9.28305,12.184 14.0075,25.9428 14.0075,41.608 0,23.2076 -7.37671,41.0278 -22.0472,53.3775 -14.6705,12.5155 -42.1881,18.649 -82.6357,18.649l-97.3891 0 0 -145.959z"></path></glyph>
                       <glyph unicode="A" horiz-adv-x="777"><path d="M513.469 118.027l-250.642 0 -35.9718 -118.027 -225.86 0 269.54 716.038 242.105 0 268.38 -716.038 -231.662 0 -35.8889 118.027zm-46.8297 154.994l-78.16 257.273 -78.4915 -257.273 156.651 0z"></path></glyph>
                       <glyph unicode="O" horiz-adv-x="832"><path d="M45.0062 357.48c0,116.867 32.4907,207.874 97.6378,272.855 65.23,65.1471 155.823,97.6378 272.192,97.6378 119.188,0 211.024,-31.9934 275.508,-95.8143 64.484,-63.9867 96.6432,-153.668 96.6432,-268.794 0,-83.7132 -14.0075,-152.176 -42.1881,-205.719 -28.0978,-53.4604 -68.9598,-95.1513 -122.172,-124.99 -53.2947,-29.8384 -119.602,-44.6747 -199.088,-44.6747 -80.7294,0 -147.534,12.8471 -200.58,38.5412 -52.7973,25.777 -95.8143,66.4733 -128.637,122.172 -32.8222,55.4496 -49.3162,125.155 -49.3162,208.786zm220.97 -0.497306c0,-72.1094 13.5102,-124.161 40.3647,-155.657 27.0203,-31.4961 63.6552,-47.327 109.988,-47.327 47.4927,0 84.5421,15.4994 110.485,46.3324 26.1915,30.9988 39.2043,86.3655 39.2043,166.515 0,67.3021 -13.6759,116.453 -40.862,147.451 -27.3518,31.1645 -64.1525,46.6639 -110.816,46.6639 -44.6747,0 -80.6465,-15.8309 -107.667,-47.327 -27.1861,-31.4961 -40.6962,-83.7961 -40.6962,-156.651z"></path></glyph>
                       <glyph unicode="C" horiz-adv-x="777"><path d="M550.021 292.996l193.949 -58.5164c-12.93,-54.2893 -33.4853,-99.7928 -61.666,-136.179 -27.932,-36.4691 -62.6606,-63.9867 -104.269,-82.47 -41.5251,-18.4832 -94.4053,-27.8492 -158.558,-27.8492 -77.9942,0 -141.484,11.3552 -190.966,33.8168 -49.3162,22.7103 -91.8359,62.4948 -127.642,119.354 -35.8889,56.8587 -53.8748,129.88 -53.8748,218.483 0,118.359 31.4961,209.366 94.4882,273.021 63.1579,63.4894 152.341,95.317 267.717,95.317 90.0953,0 161.127,-18.1517 212.764,-54.6208 51.5541,-36.552 90.0124,-92.499 115.044,-168.172l-195.027 -43.1828c-6.79652,21.6328 -14.0075,37.4637 -21.4671,47.4927 -12.5155,16.8255 -27.6834,29.8384 -45.5035,38.8728 -17.9859,9.11728 -38.0439,13.6759 -60.1741,13.6759 -50.3108,0 -88.8521,-20.2238 -115.541,-60.3398 -20.1409,-29.8384 -30.3357,-76.8338 -30.3357,-140.738 0,-79.3203 12.0182,-133.444 36.2205,-162.951 24.1194,-29.3411 58.0191,-44.0116 101.616,-44.0116 42.3539,0 74.3473,11.8525 96.063,35.6403 21.6328,23.7049 37.298,58.1848 47.1612,103.357z"></path></glyph>
                       <glyph unicode="T" horiz-adv-x="722"><path d="M22.959 716.038l673.021 0 0 -177.041 -225.943 0 0 -538.997 -221.053 0 0 538.997 -226.026 0 0 177.041z"></path></glyph>
                       <glyph unicode="K" horiz-adv-x="832"><path d="M74.0157 716.038l220.97 0 0 -270.535 231.828 270.535 294.157 0 -261.334 -269.043 273.353 -446.995 -272.192 0 -150.932 293.991 -114.878 -119.685 0 -174.306 -220.97 0 0 716.038z"></path></glyph>
                       <glyph unicode="E" horiz-adv-x="722"><path d="M73.0211 716.038l591.96 0 0 -153.005 -369.996 0 0 -114.049 342.976 0 0 -145.959 -342.976 0 0 -140.986 381.019 0 0 -162.039 -602.984 0 0 716.038z"></path></glyph>
                       <glyph unicode="." horiz-adv-x="333"><path d="M61.0029 199.005l212.018 0 0 -199.005 -212.018 0 0 199.005z"></path></glyph>
                       <glyph unicode="M" horiz-adv-x="943"><path d="M71.0319 716.038l291.836 0 111.148 -435.723 111.479 435.723 290.51 0 0 -716.038 -181.019 0 0 545.794 -139.66 -545.794 -164.028 0 -139.329 545.794 0 -545.794 -180.937 0 0 716.038z"></path></glyph>
                      </font>
                      <font id="FontID0" horiz-adv-x="685" font-variant="normal" style="fill-rule:nonzero" font-style="normal" font-weight="400">
                    	<font-face font-family="Titania">
                    	</font-face>
                       <missing-glyph><path d="M0 0z"></path></missing-glyph>
                       <glyph unicode="n" horiz-adv-x="562"><path d="M517 0c-16.6617,22.6713 -24.9993,49.9986 -24.9993,81.9956 0,7.33602 0,16.3369 0,27.0025 0,10.6657 0.338377,23.3345 1.0016,38.0066l0 64.9955 0 114.994c0,24.6745 -3.83043,47.6706 -11.5048,69.0019 -7.66086,21.3313 -18.5025,39.5089 -32.4978,54.5058 -13.9953,14.9969 -30.9954,26.8266 -51.0002,35.5026 -20.0049,8.66246 -42.3378,12.9937 -66.9987,12.9937 -55.9947,0 -97.6693,-16.6617 -124.997,-49.9986l0 45.0042 -190.006 0c15.3353,-44.0026 22.9961,-79.6676 22.9961,-107.008l0 -303.998c0,-36.0034 -8.32408,-63.6691 -24.9993,-82.9972l214.003 0c-15.9985,20.6681 -23.9977,46.9939 -23.9977,79.0044 0,12.6689 0,27.9906 0,45.9923 0,18.6649 0.338377,40.3346 1.0016,65.0091l0 111.989 0 69.0019c2.00319,18.6649 9.32568,34.1761 21.9945,46.5066 12.6689,12.3305 28.3425,18.5025 47.0074,18.5025 15.9985,0 29.1681,-6.172 39.4954,-18.5025 10.3273,-12.3305 15.4977,-26.5017 15.4977,-42.5002 0,-13.3321 0,-29.6689 0,-48.997 0,-19.3417 0.338377,-42.3378 1.0016,-69.0019 0.66322,-26.6777 1.0016,-49.6738 1.0016,-69.0019 0,-19.3417 0,-35.665 0,-48.997 0,-67.3371 -9.00084,-113.343 -27.0025,-138.004 11.3289,0 26.0009,0 44.0026,0 18.0017,0 38.6698,-0.338377 62.0043,-1.0016l106.995 0z"></path></glyph>
                       <glyph unicode="e" horiz-adv-x="545"><path d="M503 248.998c0.668278,3.99545 0.995308,8.00512 0.995308,12.0006 0,3.99545 0,7.66387 0,11.0053 0,10.664 -0.668278,21.6693 -1.99062,33.0016 -1.33656,11.3323 -3.34139,23.6599 -6.00028,36.997 -10.01,50.6612 -38.6748,90.9996 -86.0088,121.001 -43.3243,27.9966 -91.9949,42.002 -145.997,42.002 -77.3354,0 -139.329,-22.3376 -185.995,-66.9984 -47.334,-45.3434 -71.0081,-106 -71.0081,-182.013 0,-87.9994 26.6742,-154.998 80.0085,-200.995 49.9929,-43.9926 119.664,-66.0031 209,-66.0031 45.3292,0 87.3312,10.6782 125.992,32.0063 45.3434,25.3377 68.008,58.9933 68.008,100.995 0,22.0105 -6.34153,39.6701 -19.0104,53.0073 -12.6546,13.3229 -29.9872,19.9915 -51.9977,19.9915 -6.00028,0 -15.996,-2.65889 -30.0014,-7.9909 13.3371,-18.6691 20.0057,-38.0065 20.0057,-57.998 0,-28.6791 -9.32746,-51.6707 -27.9966,-69.0033 -18.6691,-17.3326 -42.9973,-26.006 -72.9987,-26.006 -44.6751,0 -75.3448,18.0009 -92.0091,54.0026 -12.0006,24.6694 -18.0009,62.3347 -18.0009,112.996l0 47.007 305.005 0.995308zm-178.999 44.0068l-124.996 0c-0.668278,4.66373 -1.00953,8.65918 -1.00953,12.0006 0,3.32717 0,6.00028 0,7.9909 0,8.00512 0.170624,15.4984 0.511873,22.5082 0.32703,6.99559 0.824684,13.8348 1.49296,20.4891 3.32717,33.3428 7.66387,57.0027 12.9959,71.0081 11.3323,25.3377 29.3331,37.9923 54.0026,37.9923 38.0065,0 57.0027,-29.6602 57.0027,-88.9947l0 -82.9945z"></path></glyph>
                       <glyph unicode="b" horiz-adv-x="554"><path d="M508.005 266.998c0,63.33 -14.6737,116.664 -44.0068,160.003 -33.9969,49.9929 -81.0038,75.0036 -140.992,75.0036 -39.3431,0 -81.3451,-18.0009 -126.006,-54.0026 0.668278,6.66856 1.16593,11.6593 1.50718,15.0007 0.32703,3.32717 0.497654,4.99076 0.497654,4.99076l0 193.004 -187.999 0c14.6595,-30.0014 21.9963,-52.666 21.9963,-67.9937l-3.00014 -524.001c0,-4.66373 -7.33684,-27.6696 -21.9963,-69.0033l289.99 0c69.9986,0 123.674,27.9966 160.998,84.004 32.6745,48.6563 49.0118,109.669 49.0118,182.994zm-181.999 14.0054c0,-44.0068 -2.00483,-92.0091 -6.00028,-144.007 -2.00483,-21.328 -12.6688,-41.6607 -32.0063,-60.9982 -19.3374,-19.3374 -39.3289,-28.9919 -60.0028,-28.9919l-33.0016 0 0 261.993c0,26.006 4.67795,49.9929 14.0054,72.0034 13.3371,27.3283 31.338,40.9925 54.0026,40.9925 42.002,0 63.003,-46.9927 63.003,-140.992z"></path></glyph>
                       <glyph unicode="a" horiz-adv-x="552"><path d="M506.998 1.0016c-15.3353,39.9962 -22.9961,70.6667 -22.9961,91.9981l0 210.999c0,78.0028 -16.3369,131.006 -48.997,158.997 -30.6705,25.3377 -85.3388,38.0066 -164.005,38.0066 -7.33602,0 -18.6649,-1.66482 -34.0002,-5.00799 -8.66246,-1.98966 -15.6601,-3.49205 -20.9929,-4.49365 -5.34636,-1.0016 -9.67759,-1.82724 -13.0072,-2.50399 -12.6689,-1.32644 -27.6657,-2.32804 -45.0042,-2.99126 -17.3249,-0.676755 -37.6682,-1.0016 -60.9891,-1.0016l-12.0056 0c-3.32963,0 -7.1736,0.825641 -11.5048,2.49046 -4.33123,1.67835 -8.50004,3.34317 -12.4929,5.00799 -4.00639,1.66482 -7.83682,3.32963 -11.5048,4.99445 -3.66801,1.66482 -5.83363,2.50399 -6.49685,2.50399 -1.33997,0 -2.00319,-2.66641 -2.00319,-7.99924 0,-36.0034 9.00084,-68.3387 27.0025,-97.006 20.6681,-34.6634 47.9955,-51.9883 81.9956,-51.9883 12.6689,0 28.0041,3.32963 46.0058,9.9889 23.3345,7.99924 35.0018,16.3369 35.0018,24.9993 0,4.66961 -1.66482,10.8416 -5.00799,18.5025 -3.32963,7.6744 -4.99445,13.8329 -4.99445,18.5025 0,22.6713 13.9953,34.0002 41.9994,34.0002 34.6634,0 52.0018,-21.9945 52.0018,-65.9971 0,-19.3417 -9.66406,-34.6634 -29.0057,-46.0058 0,0 -4.49365,-1.82724 -13.4945,-5.49525 -9.00084,-3.66801 -22.1705,-9.16326 -39.4954,-16.4993 -22.6713,-9.33922 -47.3458,-18.3401 -74.0099,-27.0025 -39.9962,-12.6689 -72.6699,-31.6721 -97.9941,-56.9963 -28.0041,-29.3306 -41.9994,-63.6691 -41.9994,-103.002 0,-43.3394 17.0001,-78.3411 51.0002,-105.005 30.657,-24.6609 68.3252,-36.9914 112.991,-36.9914 46.0058,0 89.67,18.0017 131.006,53.9915l13.9953 -38.9946 179.002 0zm-195 289.001c-0.66322,-13.3321 -1.0016,-24.9993 -1.0016,-35.0018 0,-10.0024 0,-18.6649 0,-26.0009l0 -119.001c0,-10.0024 -6.99764,-21.0065 -20.9929,-32.9986 -13.3321,-12.0056 -24.9993,-18.0017 -35.0018,-18.0017 -20.0049,0 -36.0034,8.66246 -47.9955,26.0009 -10.0024,14.672 -15.0104,32.9986 -15.0104,54.9931 0,28.0041 13.0072,59.013 39.0081,93.0132 26.6641,34.6634 53.6667,53.6667 80.994,56.9963z"></path></glyph>
                       <glyph unicode="o" horiz-adv-x="563"><path d="M510.002 250.995c0,69.3403 -25.3377,128.34 -75.9996,176.998 -49.3354,48.6722 -108.998,73.0083 -179.002,73.0083 -68.6635,0 -127,-24.6745 -174.995,-73.9964 -47.3458,-49.3354 -71.0051,-108.01 -71.0051,-176.01 0,-73.3332 22.6713,-135.324 68.0003,-185.999 46.669,-52.0018 106.67,-77.9892 180.003,-77.9892 74.6596,0 135.662,24.9993 182.995,74.998 46.669,50.6619 70.0035,113.668 70.0035,188.991zm-175.009 49.0106c0,-3.34317 0,-7.01118 0,-11.004 0,-3.32963 -0.324842,-7.6744 -0.988062,-13.0072l0 -22.9961c0,-3.99285 0.162421,-9.16326 0.500799,-15.4977 0.324842,-6.33443 0.487263,-13.1696 0.487263,-20.5057 0,-6.65927 0.175956,-13.1561 0.500799,-19.4905 0.338377,-6.33443 0.500799,-11.5048 0.500799,-15.4977 0,-103.34 -23.6593,-155.004 -70.9916,-155.004 -55.3315,0 -82.9972,56.9963 -82.9972,171.002 0,3.32963 0,7.32249 0,11.9921 0,4.66961 0.324842,10.3408 0.988062,17.0001l0 30.0073c0,135.324 24.0113,202.999 72.0067,202.999 53.3283,0 79.9924,-53.3418 79.9924,-159.998z"></path></glyph>
                      </font>
                      <style type="text/css">
                       
                        @font-face { font-family:"Arial Black";src:url("#FontID1") format(svg)}
                        @font-face { font-family:"Titania";src:url("#FontID0") format(svg)}
                        .str0 {stroke-width:63.1575}
                        .str2 {stroke:white;stroke-width:3}
                        .fil2 {fill:#F77F45}
                        .fil3 {fill:white}
                        .fnt2 {font-weight:900;font-size:47.5px;font-family:'Arial Black'}
                        .fnt0 {font-weight:normal;font-size:276.89px;font-family:'Titania'}
                        .fnt1 {font-weight:normal;font-size:290.874px;font-family:'Titania'}
                       
                      </style>
                     </defs>
                     <g id="Layer_x0020_1">
                      <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                      <g id="_482696368">
                       <path class="fil3" d="M43 173c5,8 15,16 38,25 145,0 281,0 422,1 -25,9 -45,17 -61,26 -72,-5 -144,-11 -216,-17 -135,-6 -179,4 -224,14 8,-19 21,-35 41,-49z"></path>
                       <path class="fil3" d="M60 7c24,14 38,35 36,63 11,-3 23,-7 38,-9 0,-8 0,-12 0,-20 -24,-10 -49,-24 -74,-34z"></path>
                       <ellipse class="fil3" cx="121" cy="243" rx="33" ry="24"></ellipse>
                       <ellipse class="fil3" cx="384" cy="249" rx="33" ry="24"></ellipse>
                       <path class="fil2" d="M900 67c31,3 70,15 102,3 -12,13 -24,27 -36,40 -12,-29 -38,-37 -66,-43z"></path>
                       <g transform="matrix(0.934393 0 -0.167358 0.761815 -396.527 78.412)">
                        <text x="500" y="133" class="fil2 fnt0">e</text>
                        <text x="662" y="133" class="fil2 fnt0">b</text>
                        <text x="827" y="133" class="fil2 fnt0">e</text>
                       </g>
                       <g transform="matrix(0.945143 0 -0.156298 0.761801 37.7326 82.987)">
                        <text x="500" y="133" class="fil3 fnt1">ano</text>
                       </g>
                       <g transform="matrix(1.03864 0 0 0.761815 0.690618 127.122)">
                        <text x="500" y="133" class="fil3 str2 fnt2">M</text>
                        <text x="548" y="133" class="fil3 str2 fnt2">A</text>
                        <text x="588" y="133" class="fil3 str2 fnt2">R</text>
                        <text x="628" y="133" class="fil3 str2 fnt2">K</text>
                        <text x="670" y="133" class="fil3 str2 fnt2">E</text>
                        <text x="707" y="133" class="fil3 str2 fnt2">T</text>
                        <text x="737" y="133" class="fil3 str2 fnt2">.</text>
                        <text x="756" y="133" class="fil3 str2 fnt2">C</text>
                        <text x="796" y="133" class="fil3 str2 fnt2">O</text>
                        <text x="838" y="133" class="fil3 str2 fnt2">M</text>
                       </g>
                      </g>
                     </g>
                    </svg>
                    
                  </a>
                </figure>
              </div>
              <div
                id="entry_213182"
                data-id="213182"
                class="entry-widget widget-newsletter"
              >
                <div class="newsletter">
                  <h3>New To Ebeano Market?</h3>
                  <p>
                    Subscribe to our newsletter to get updates on our latest
                    offers!
                  </p>
                  <form
                    method="post"
                    class="newsletter"
                    onsubmit="return false;"
                  >
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span
                          class="input-group-text fas fa-envelope"
                          id="my-addon"
                        ></span>
                      </div>
                      <input
                        class="form-control form-control-sm"
                        type="text"
                        name=""
                        placeholder="Enter Email Address"
                      />
                      <button style="border-radius:5px;" class="btn newsletter-btn">Male</button>
                      <button style="border-radius:5px;" class="btn newsletter-btn">Female</button>
                    </div>
                  </form>
                </div>
              </div>
              <div
                id="entry_213183"
                data-id="213183"
                class="entry-design design-menu social-connect d-none d-lg-block flex-grow-0"
              >
                <div class="menu-wraper image-top horizontal">
                  <div class="menu-items d-flex align-items-start">
                    <nav class="nav horizontal">
                      <a
                        class="nav-link icon-left icon"
                        href="#"
                        title="Google+"
                      >
                        <i
                          title="Google+"
                          class="icon fab fa-google-plus-g"
                        ></i>
                      </a>
                      <a
                        class="nav-link icon-left icon"
                        href="#"
                        title="Twitter"
                      >
                        <i title="Twitter" class="icon fab fa-twitter"></i>
                      </a>
                      <a
                        class="nav-link icon-left icon"
                        href="#"
                        title="Youtube"
                      >
                        <i title="Youtube" class="icon fab fa-youtube"></i>
                      </a>
                      <a
                        class="nav-link icon-left icon"
                        href="#"
                        title="facebook"
                      >
                        <i title="facebook" class="icon fab fa-facebook-f"></i>
                      </a>
                      <a
                        class="nav-link icon-left icon"
                        href="#"
                        title="instagram"
                      >
                        <i title="instagram" class="icon fab fa-instagram"></i>
                      </a>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </main>

          <main class="bottom-footer">
            <div id="entry_213184" class="entry-section container">
              <div id="entry_213185" class="entry-row row">
                <div
                  id="entry_213186"
                  class="entry-col col-12 col-lg-3 flex-column"
                >
                  <div
                    id="entry_213187"
                    data-id="213187"
                    class="entry-widget widget-html"
                  >
                    <h6 class="widget-title">Let Us Help You</h6>
                    <ul class="list-unstyled">
                      <li>
                        <a class="_link -pbxs" href="{{ url('help-center') }}">Help Center</a>
                      </li>
                      <li>
                        <a class="_link -pbxs" href="{{ url('how-to-shop') }}"
                          >How to shop on Ebeano?</a
                        >
                      </li>
                      <li>
                        <a class="_link -pbxs" href="{{ url('delivery-options') }}"
                          >Delivery options and timelines</a
                        >
                      </li>
                      <li>
                        <a class="_link -pbxs" href="{{ url('ebeano-return-policy') }}"
                          >How to return a product on Ebeano?</a
                        >
                      </li>
                      <li>
                        <a class="_link -pbxs" href="{{ url('corporate-and-bulk-purchases') }}"
                          >Corporate and bulk purchases</a
                        >
                      </li>
                      <li>
                        <a class="_link -pbxs" href="">Report a Product</a>
                      </li>
                      <li>
                        <a class="_link -pbxs" href="{{ url('ebeano-logistics') }}"
                          >Ship your package anywhere in Nigeria</a
                        >
                      </li>
                    </ul>
                  </div>
                  <div
                    id="entry_213188"
                    data-id="213188"
                    class="entry-design design-menu social-connect d-lg-none order-1 flex-grow-0"
                  >
                    <div class="menu-wraper image-top horizontal">
                      <div class="menu-items d-flex align-items-start">
                        <nav class="nav horizontal">
                          <a
                            class="nav-link icon-left icon"
                            href="#"
                            title="Google+"
                          >
                            <i
                              title="Google+"
                              class="icon fab fa-google-plus-g"
                            ></i>
                          </a>
                          <a
                            class="nav-link icon-left icon"
                            href="#"
                            title="Twitter"
                          >
                            <i title="Twitter" class="icon fab fa-twitter"></i>
                          </a>
                          <a
                            class="nav-link icon-left icon"
                            href="#"
                            title="Youtube"
                          >
                            <i title="Youtube" class="icon fab fa-youtube"></i>
                          </a>
                          <a
                            class="nav-link icon-left icon"
                            href="#"
                            title="facebook"
                          >
                            <i
                              title="facebook"
                              class="icon fab fa-facebook-f"
                            ></i>
                          </a>
                          <a
                            class="nav-link icon-left icon"
                            href="#"
                            title="instagram"
                          >
                            <i
                              title="instagram"
                              class="icon fab fa-instagram"
                            ></i>
                          </a>
                        </nav>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  id="entry_213189"
                  class="entry-col col-6 col-sm-3 col-lg-3 order-1 flex-column align-items-start align-items-md-center"
                >
                  <div
                    id="entry_213190"
                    data-id="213190"
                    class="entry-design design-menu flex-grow-0"
                  >
                    <div class="menu-wraper image-top vertical">
                      <h3 class="design-title">About Ebeano Market</h3>
                      <div class="menu-items d-flex align-items-start">
                        <ul class="list-unstyled">
                          <li>
                            <a class="_link -pbxs" href="{{ url('about-us') }}">About us</a>
                          </li>
                          <li>
                            <a class="_link -pbxs" href="#">Ebeano careers</a>
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('expressbills') }}">Ebeano Expressbills</a>
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('terms-and-conditions') }}"
                              >Terms and Conditions</a
                            >
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('privacy-policy') }}"
                              >Privacy and Cookie Notice</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  id="entry_213191"
                  class="entry-col col-6 col-sm-3 col-lg-3 order-2 flex-column align-items-start align-items-md-center"
                >
                  <div
                    id="entry_213192"
                    data-id="213192"
                    class="entry-design design-menu flex-grow-0"
                  >
                    <div class="menu-wraper image-top vertical">
                      <h3 class="design-title">Make Money With Ebeano Market</h3>
                      <div class="menu-items d-flex align-items-start">
                        <ul class="list-unstyled">
                          <li>
                            <a class="_link -pbxs" href="#">Sell on Ebeano</a>
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('ebeano-sales-consultant') }}"
                              >Become a Sales Consultant</a
                            >
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('ebeano-vendor-service-provider') }}"
                              >Become a Ebeano Vendor Service Provider</a
                            >
                          </li>
                          <li>
                            <a class="_link -pbxs" href="{{ url('bills-payment-partner') }}"
                              >Become a Bills Payment Partner</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  id="entry_213193"
                  class="entry-col col-12 col-sm-3 col-lg-3 order-3 flex-column align-items-start align-items-md-center"
                >
                  <div
                    id="entry_213194"
                    data-id="213194"
                    class="entry-widget widget-contact_us"
                  >
                    <h5 class="widget-title">Get in touch</h5>
                    <ul class="list-unstyled">
                      <li class="both">
                        <i class="icon fas fa-map-marker-alt"></i>
                        38 Umuezebi Street, New Haven, Enugu
                      </li>
                      <li class="both">
                        <i class="icon fas fa-clock"></i>
                        9:00 AM - 7:00PM
                      </li>
                      <li class="both">
                        <i class="icon fas fa-phone-alt"></i>
                        Call us: 07011520778
                      </li>
                      <li class="both">
                        <i class="icon fas fa-envelope"></i>
                        Info@ebeanomarket.com
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div id="entry_213195" class="">
              <div class="entry-section container">
                <div id="entry_213196" class="entry-row row align-items-center">
                  <div
                    id="entry_213197"
                    class="entry-col col-12 col-sm-6 col-md-5 col-lg-4 order-sm-1 order-md-0 flex-column align-items-center align-items-md-stretch"
                  >
                    <div
                      id="entry_213198"
                      data-id="213198"
                      class="entry-widget widget-html flex-grow-0 flex-lg-grow-1"
                    >
                      <p>2022 © Ebeano Market</p>
                    </div>
                  </div>

                  <div
                    id="entry_213202"
                    class="entry-col col-12 col-sm-6 col-md-5 col-lg-4 order-2 flex-column align-items-center align-items-md-end"
                  >
                    <div
                      id="entry_213203"
                      data-id="213203"
                      class="entry-design design-menu flex-grow-0"
                    >
                      <div class="menu-wraper image-top horizontal">
                        <div class="menu-items d-flex align-items-start">
                          <nav class="nav horizontal">
                            <a
                              class="nav-link icon-left icon"
                              href="#"
                              title="Amazon pay"
                            >
                              <i
                                title="Amazon pay"
                                class="icon fab fa-cc-amazon-pay"
                                style="font-size: 24px"
                              ></i>
                            </a>
                            <a
                              class="nav-link icon-left icon"
                              href="#"
                              title="Master"
                            >
                              <i
                                title="Master"
                                class="icon fab fa-cc-mastercard"
                                style="font-size: 24px"
                              ></i>
                            </a>
                            <a
                              class="nav-link icon-left icon"
                              href="#"
                              title="Visa"
                            >
                              <i
                                title="Visa"
                                class="icon fab fa-cc-visa"
                                style="font-size: 24px"
                              ></i>
                            </a>
                            <a
                              class="nav-link icon-left icon"
                              href="#"
                              title="paypal"
                            >
                              <i
                                title="paypal"
                                class="icon fab fa-cc-paypal"
                                style="font-size: 24px"
                              ></i>
                            </a>
                            <a
                              class="nav-link icon-left icon"
                              href="#"
                              title="strip"
                            >
                              <i
                                title="strip"
                                class="icon fab fa-cc-stripe"
                                style="font-size: 24px"
                              ></i>
                            </a>
                          </nav>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </footer>
        
        

        <!-- JQUERY V3 -->
        <script src="{{ asset('assets/homepage/assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- BOOTSTRAP BUNDLE -->
        
        <script
          src="{{ asset('assets/homepage/assets/plugins/bootstrap/4.3.1/js/bootstrap.bundle.min.js')}}"
          defer
        ></script>
        <!-- JQUERY LAZY -->
        <script
          src="{{ asset('assets/homepage/assets/plugins/jquery.lazy/1.7.9/jquery.lazy.min.js')}}"
          defer
        ></script>
        <script
          src="{{ asset('assets/homepage/assets/plugins/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js')}}"
          defer
        ></script>
        <!-- Swiper JS -->
        <script src="{{ asset('assets/homepage/assets/plugins/swiper/swiper-bundle.min.js')}}"></script>
        <script src="{{ asset('assets/homepage/assets/plugins/slick/slick.min.js')}}"></script>
        <script src="{{ asset('assets/homepage/assets/js/app.js')}}?{{uniqid()}}" defer></script>
        <script src="{{ asset('assets/homepage/assets/js/custom.js')}}?{{uniqid()}}"></script>
      </div>
    </div>
    <!-- notification -->
    <div id="notification-box-top"></div>
    <div id="notification-box-bottom"></div>
    <!-- Quick view -->
    <div id="quick-view" class="modal fade quick-view" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <button
            type="button"
            class="close btn btn-link fas mz-modal-close"
            data-dismiss="modal"
          ></button>
          <div class="modal-body p-0"></div>
          <div class="loader-spinner"></div>
        </div>
      </div>
    </div>
    
    
    <!-- Back to top-->
    <a
      id="back-to-top"
      data-show="0"
      href="#"
      class="btn btn-primary shadow back-to-top"
      style="display: none"
      role="button"
      ><i class="fas fa-chevron-up"></i
    ></a>
   
    <nav class="mobile-bottom-nav">
    	<div class="mobile-bottom-nav__item mobile-bottom-nav__item--active">
    		<a href="/" class="mobile-bottom-nav__item-content">
    			<i class="fa fa-home"></i>
    			<span class="text">Home</span>
    		</a>		
    	</div>
    	<div class="mobile-bottom-nav__item">		
    		<a href="/cart" class="mobile-bottom-nav__item-content">
    			<i class="fas fa-cart-arrow-down"></i>
    			Cart
    		</a>
    	</div>
    	<div class="mobile-bottom-nav__item">
    		<a href="/login" class="mobile-bottom-nav__item-content">
    			<i class="fas fa-sign-in-alt"></i>
    			Login
    		</a>		
    	</div>
    	
    	<div class="mobile-bottom-nav__item">
    		<a href="/dashboard" class="mobile-bottom-nav__item-content">
    			<i class="fas fa-user"></i>
    			My Ebeano
    		</a>		
    	</div>
    </nav>
    
    
    <!-- dialog to choose market -->
    <div class="modal fade" id="displayMarkett" tabindex="-1" role="dialog" aria-labelledby="displayMarket" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <strong><center>Welcome to Ebeano Market</center></strong>
                    <center><small>Which market would you like to visit?</small></center>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    
    <script>
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
    
    $(".nav li").click(function() {
                if($(this).hasClass("active")){
                    $(this).addClass("active");
                }else{
                    $(".nav li active").removeClass("active");
                    $(this).addClass("active");
                }
    });
</script>

@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach

@if(Session::has('success') && !empty(Session::get('success')))
    <script>
        showFrontendAlert('success', "{{Session::get('success')}}");
    </script>
@endif
            
@if(Session::has('error') && !empty(Session::get('error')))
    <script>
        showFrontendAlert('danger', '{{Session::get('error')}}');
    </script>
@endif

<script>
    
    $(document).ready(function() {
        
        setTimeout(function(){ $('#displayMarket').modal('show') }, 2000);
        
        // mobile categories slider
        $(".mobile_new_category").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
              {
                breakpoint: 639,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3
                }
              }
            ]
        });
        // mobile services slider
        $("#mobile-top-menus").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
              {
                breakpoint: 639,
                settings: {
                  slidesToShow: 5,
                  slidesToScroll: 5
                }
              }
            ]
        });
    });

    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('{{ route('category.elements') }}', {_token: '{{ csrf_token()}}', id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });

    });

    $('#search').on('keyup', function(){
        search();
    });

    $('#search').on('focus', function(){
        search();
    });

    function search(){
        var search = $('#search').val();
        if(search.length > 0){
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('{{ route('search.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
                    $('.search-preloader').addClass('d-none');

                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }

    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data);
        });
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function addToWishList(id){
        @if (Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'user' || Auth::user()->user_type == 'seller'))
            $.post('{{ route('wishlists.store') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                if(data != 0){
                    $('#wishlist').html(data);
                    showFrontendAlert('success', 'Item has been added to wishlist');
                }
                else{
                    showFrontendAlert('warning', 'Something went wrong');
                }
            });
        @else
            showFrontendAlert('warning', 'Please login first');
        @endif
    }

    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }

    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });

    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '{{ route('products.variant_price') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div').removeClass('d-none');
                   $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                   $('#available-quantity').html(data.quantity);
                   $('.input-number').prop('max', data.quantity);
                   //console.log(data.quantity);
                   if(parseInt(data.quantity) < 1){
                       $('.buy-now').hide();
                       $('.add-to-cart').hide();
                   }
                   else{
                       $('.buy-now').show();
                       $('.add-to-cart').show();
                   }
               }
           });
        }
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });

        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }

        return false;
    }

    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   //$('#addToCart-modal-body').html(null);
                   //$('.c-preloader').hide();
                   //$('#modal-size').removeClass('modal-lg');
                   //$('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();

             $input.on('change', function(e) {
                 var fileName = '';

                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();

                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });

             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }

     

</script>
<script>
function openNav() {

  document.getElementById('myNav').style.display = "block";
   event.preventDefault();
    $(".hamburger-menu").toggleClass("open");
    if ($(".hamburger-menu").hasClass("open")) {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-0")
            .addClass("opacity-1");
        $(".side-menu").removeClass("closed").addClass("open");
        $("body").addClass("side-menu-open");
    } else {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-1")
            .addClass("opacity-0");
        $(".side-menu").removeClass("open").addClass("closed");
        $("body").removeClass("side-menu-open");
    }

}

function closeNav() {

  $(".side-menu-wrap,.side-menu-overlay")
        .removeClass("opacity-1")
        .addClass("opacity-0");
    $(".side-menu").removeClass("open").addClass("closed");
    if ($(".hamburger-menu").hasClass("open")) {
        $(".hamburger-menu").removeClass("open");
        $("body").removeClass("side-menu-open");
    }
}

$(window).on("load", function () {});

$(window)
    .scroll(function () {
        var scrollDistance = $(window).scrollTop();
        $(".sub-category-menu.active").each(function (i) {
            if ($(this).position().top + 120 <= scrollDistance) {
                $(".all-category-menu li.active").removeClass("active");
                $(".all-category-menu li").eq(i).addClass("active");
            }
        });

        var b = $(window).scrollTop();

        if (b > 120) {
            $(".logo-bar-area").addClass("sm-fixed-top");
        } else {
            $(".logo-bar-area").removeClass("sm-fixed-top");
        }
    })
    .scroll();

$(function () {
    $("#category-menu-icon, #category-sidebar")
        .on("mouseover", function (event) {
            $("#hover-category-menu").show();
            $("#category-menu-icon").addClass("active");
        })
        .on("mouseout", function (event) {
            $("#hover-category-menu").hide();
            $("#category-menu-icon").removeClass("active");
        });

    $(".nav-search-box a").on("click", function (e) {
        e.preventDefault();
        $(".search-box").addClass("show");
        $('.search-box input[type="text"]').focus();
    });
    $(".search-box-back button").on("click", function () {
        $(".search-box").removeClass("show");
    });
    $("#side-filter,.filter-close").on("click", function (e) {
        e.preventDefault();
        if ($(".side-filter").hasClass("open")) {
            $(".side-filter").removeClass("open");
        } else {
            $(".side-filter").addClass("open");
        }
    });
    
});
var heroBanner = new Swiper(".mainBanner", {
    slidesPerView: 1,
    spaceBetween: 30,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
},
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
  });
</script>
  </body>
</html>
