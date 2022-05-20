@extends('layouts.theme')

@section('title', 'Ebeano Market')

@section('content')
    <div class="banner-area">

        <div class="row position-relative mb-3">
            <div class="col-md-4 pr-0 col-lg-3 home-category position-static order-2 order-md-0 ">
                <div class="category-sidebar">
                    <div class="all-category d-none d-md-block">
                        <span><i class="la la-list"></i> Categories</span>

                    </div>
                    <ul class="categories d-none d-md-block no-scrollbar">
                        @php 
                            $categories = App\Category::where('featured',1)->get();

                        @endphp
                        @if(count($categories) > 0)

                            @foreach($categories as $category)
                                <li class="category-nav-element" data-id="{{ $category->id }}"><a href="{{route('products.by_category',['slug' => $category->slug])}}" class="cat-item"><img class="cat-image lazyloaded" src="{{ asset('storage/'.$category->icon) }}" alt="{{$category->name}}" width="30">{{Str::title($category->name)}}</a>
                                    @if(count($category->subcategory)>0)
                                        <div class="sub-cat-menu c-scrollbar">
                                            <div class="c-loading">
                                                <i class="fa fa-spin fa-spinner"></i>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>

                </div>

            </div>
            <div class="col-md-5 col-lg-7 home-banner-slider px-md-0 pl-md-3 mb-3 mb-md-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('assets/images/banners/slider1.jpg') }}"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('assets/images/banners/slider2.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('assets/images/banners/slider3.jpg') }}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 home-banner-right px-2">

                <div class="row no-gutters">
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/marketplace')}}">
                            <div class="card transition">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/marketplace.svg') }}" alt="Marketplace">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="">MarketPlace</h4>
                                    </div>
                                
                                </div>
                                
                            </div>
                        </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/artisans')}}">
                        <div class="card transition">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/artisan.svg') }}" alt="Artisans">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="">Artisans</h4>
                                </div>
                                
                            </div>
                            
                        </div>
                        </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/estate')}}">
                            <div class="card transition">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/real_estate.svg') }}" alt="Real Estate">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="">Real Estate</h4>
                                    </div>
                                
                                </div>
                            
                            </div>
                        </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/expressbills')}}">
                        <div class="card transition">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/utilities.svg') }}" alt="Utility">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="">Utility Bill</h4>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/category/automobile')}}">
                        <div class="card transition">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/automobile.svg') }}" alt="Automobile">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="">Automobile</h4>
                                </div>
                                
                            </div>
                            
                        </div>
                    </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/bookings')}}">
                        <div class="card transition">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/booking.svg') }}" alt="Booking">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="">Bookings</h4>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                    </div>
                    
                    <div class="col-4 col-sm-4 col-md-12 mb-2 px-2">
                        <a href="{{url('/eforms')}}">
                        <div class="card transition">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img class="d-block mx-auto" width="36" src="{{ asset('assets/images/services/real_estate.svg') }}" alt="Education">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="">Education</h4>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                    </div>
                </div>


            </div>
        </div>

    </div>
    @php
            $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->orderBy('created_at')->first();
        @endphp
        @if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)
    <div class="flashdeals-entry mt-1">
        
        <div class="title-container">
            <a href="#" class="hot-zone"></a>
            <div class="title-info">
                <i class="iconfont la la-flash"></i>
                <h3>Flash sales</h3>

            </div>
            <span class="view-more"><a href="{{ route('flash_deal', $flash_deal->slug) }}">view more</a></span>
        </div>
        <div class="product-container">
            <ul class="product-list  util-clearfix flex-horizontal flex-wrap">
                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                @php
                    $product = \App\Product::find($flash_deal_product->product_id)->limit(5);
                @endphp
                @if ($product != null && $product->published != 0 && $product->featured_img != null && $product->unit_price > 0 )
                <li class="product-item">
                    <a href="{{ route('product', $product->slug) }}">
                        <div class="item-box">
                            <div class="img-wrapper flex justify-center align-items-center">
                                <img class="eb-img" src="{{ asset('storage/'.$product->featured_img) }}">
                            </div>
                            <div class="pro-price">
                                <span class="current-price util-left">₦ {{ number_format($product->unit_price, 2)}}</span>
                                <span class="discount">{{ ($product->discount.'% off') ?? ''}}</span>
                            </div>
                            <div class="pro-remaining">
                                <span class="progress-box">
                                    <span class="progress-inner" style="width:29%;min-width:8px;"></span>
                                </span>
                                {{-- <div class="pro-claimed">1421 Sold</div> --}}
                            </div>
                        </div>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    
    @php
            $todays_deal = App\Product::where('published',1)->where('todays_deal',1)->orderBy('created_at','desc')->limit(6)->get();
    @endphp

    @if ($todays_deal != null)

    <div class="flashdeals-entry">
        
        <div class="title-container">
            <a href="{{route('products')}}" class="hot-zone"></a>
            <div class="title-info">
                <i class="iconfont la la-hot"></i>
                <h3>Todays Deal <span class="btn btn-sm btn-rounded btn-danger">HOT</span></h3>

            </div>
        <span class="view-more"><a href="#">view more</a></span>
        </div>
        <div class="product-container">
            <ul class="product-list  util-clearfix flex-horizontal flex-wrap">
                @foreach($todays_deal as $deal)
                @if($deal->featured_img != null && $deal->unit_price > 0)
                <li class="product-item">
                <a href="{{route('product', $deal->slug)}}">
                        <div class="item-box">
                            <div class="img-wrapper flex justify-center align-items-center">
                                <img class="eb-img lazy" src="{{asset('assets/images/loading.gif')}}" data-src="{{asset('storage/'.$deal->featured_img)}}">
                            </div>
                            <div class="pro-price">
                            <span class="current-price util-left">₦{{number_format($deal->unit_price,2)}}</span>
                                <span class="discount">{{($deal->discount==0.00)?'' : ('-'.number_format($deal->discount,0).'%')}}</span>
                            </div>
                            <div class="pro-remaining">
                                <span class="progress-box">
                                    <span class="progress-inner" style="width:29%;min-width:8px;"></span>
                                </span>
                                <div class="pro-claimed">{{$deal->name}}</div>
                            </div>
                        </div>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>

    </div>
    @endif

    <div class="banner-ad mt-2 mb-3">
        <div class="row">
            <div class="col-md-6 mt-2  banner-container">
                <div class="banner-img">
                    <img class="d-block  w-100" src="{{asset('assets/images/banners/banner-2.jpg')}}" alt="">
                </div>

            </div>
            <div class="col-md-6 mt-2  banner-container">
                <div class="banner-img">
                    <img class="d-block w-100" src="{{asset('assets/images/banners/banner-3.jpeg')}}" alt="">
                </div>

            </div>
        </div>
    </div>
    @php
            $featured_product = App\Product::where('published',1)->where('featured',1)->orderBy('created_at','desc')->limit(12)->get();
    @endphp

    @if ($featured_product != null)

    <div class="flashdeals-entry mb-3">
        
        <div class="title-container">
            <a href="#" class="hot-zone"></a>
            <div class="title-info">
                <h3>Featured <span class="la la-star text-warning"></span></h3>

            </div>
        <span class="view-more"><a href="{{route('products.featured')}}">view more</a></span>
        </div>
        <div class="product-container">
            <ul class="product-list  util-clearfix flex-horizontal flex-wrap">
                @foreach($featured_product as $featured)
                @if ($featured->featured_img != null && $featured->unit_price > 0)
                <li class="product-item">
                <a href="{{route('product', $featured->slug)}}">
                        <div class="item-box">
                            <div class="img-wrapper flex justify-center align-items-center">
                                <img class="eb-img lazy" src="{{asset('assets/images/loading.gif')}}" data-src="{{asset('storage/'.$featured->featured_img)}}">
                            </div>
                            <div class="pro-price">
                            <span class="current-price util-left">₦{{number_format($featured->unit_price, 2)}}</span>
                                <span class="discount">{{($featured->discount==0.00)?'' : ('-'.$featured->discount.'%')}}</span>
                            </div>
                            <div class="pro-remaining">
                                <span class="progress-box">
                                    <span class="progress-inner" style="width:29%;min-width:8px;"></span>
                                </span>
                                <div class="pro-claimed">{{$featured->name}}</div>
                            </div>
                        </div>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>

    </div>
    @endif
    
    @php 
        $categories = App\Category::all();

    @endphp
    
    @if(count($categories) > 0)
<style>
    .cat-header h3{
        font-size: 0.9rem;
    }
</style>    
        <div class="cat-header pt-2 font-weight-bold">
            <h3>Popular Categories</h3>
        </div>
        <div class="row">
            
        @foreach($categories as $category)
        @if ($category->desktop_image != null)
            <div class="col-4 col-md-2 home-category py-2" >
                
                <a href="{{route('products.by_category',['slug' => $category->slug])}}">
                    <div class="bg-white rounded pt-0">
                        <div class="row">
                        <div class="col-md-12">
                        <img class="img-fluid" src="{{ asset('storage/'.$category->desktop_image) }}"  alt="{{$category->name}}">
                        </div>
                        <div class="col-md-12 py-2">
                        <h4 class="text-center">{{Str::title($category->name)}}</h4>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        @endforeach
        </div>
    @endif
    
    @php
            $latest_product = App\Product::where('published',1)->where('featured_img','<>', null)->where('unit_price','>', 0)->orderBy('created_at','desc')->limit(18)->get();
    @endphp

    @if ($latest_product != null)

    <div class="flashdeals-entry bg-none">
        
        <div class="title-container">
            <a href="{{url('/search?sort_by=1')}}" class="hot-zone"></a>
            <div class="title-info">
                <i class="iconfont la la-top"></i>
                <h3>New Arrivals <span class="btn btn-sm btn-success small font-weight-bold py-0">new</span></h3>

            </div>
        <span class="view-more"><a href="{{url('/search?sort_by=1')}}">view more</a></span>
        </div>
        <div class="product-container bg-none">
            <ul class="product-list  util-clearfix flex-horizontal flex-wrap">
                @foreach($latest_product as $latest)
                
                <li class="product-item">
                <a href="{{route('product', $latest->slug)}}">
                        <div class="item-box">
                            <div class="img-wrapper flex justify-center align-items-center">
                                <img class="eb-img lazy" src="{{asset('assets/images/loading.gif')}}" data-src="{{asset('storage/'.$latest->featured_img)}}">
                            </div>
                            <div class="pro-price">
                            <span class="current-price util-left">₦{{number_format($latest->unit_price, 2)}}</span>
                                <span class="discount">{{($latest->discount==0.00)?'' : ('-'.$latest->discount.'%')}}</span>
                            </div>
                            <div class="pro-remaining">
                                <span class="progress-box">
                                    <span class="progress-inner" style="width:29%;min-width:8px;"></span>
                                </span>
                                <div class="pro-claimed">{{$latest->name}}</div>
                            </div>
                        </div>
                    </a>
                </li>
            
                @endforeach
            </ul>
        </div>

    </div>
    @endif

@endsection
