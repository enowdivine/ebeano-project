@extends('layouts.theme')

{{-- @section('title', 'Single Product') --}}

@section('title'){{ (ucwords(strtolower($detailedProduct->meta_title ?? $detailedProduct->name))).' | Ebeano Market' }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ ucwords(strtolower($detailedProduct->meta_title)) }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset('storage/'.$detailedProduct->featured_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ ucwords(strtolower($detailedProduct->meta_title)) }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset('storage/'.$detailedProduct->featured_img) }}">
    <meta name="twitter:data1" content="{{ $detailedProduct->unit_price }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ ucwords(strtolower($detailedProduct->meta_title)) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ asset('storage/'.$detailedProduct->featured_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ $detailedProduct->unit_price}}" />
@endsection

@section('content')
    <script>
        $(document).ready(function() {
            $(".p-it-sel").click(function() {
                $(".p-it-sel.active").removeClass("active");
                $(this).addClass("active");
            });
        });

    </script>
    {{-- breadcrumb --}}
   @php
    $qty = 0;
    if($detailedProduct->variant_product){
        foreach ($detailedProduct->stocks as $key => $stock) {
            $qty += $stock->qty;
        }
    }
    else{
        $qty = $detailedProduct->current_stock;
    }
    @endphp 

    <div class="section mt-2 mt-md-0">
        <ul class="d-none d-md-flex my-md-2 p-md-1 breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            
            @if(isset($detailedProduct->category_id))
            <li class="breadcrumb-item">
                <a href="{{ route('products.by_category', \App\Category::find($detailedProduct->category_id)->slug) }}">{{ ucwords(\App\Category::find($detailedProduct->category_id)->name)}}</a>
            </li>
            @else
            <li class="breadcrumb-item"><a href="{{route('products')}}">All products</a></li> 
            @endif
            @if(isset($detailedProduct->subcategory_id))
            <li class="breadcrumb-item">
                <a href="{{ route('products.subcategory', \App\SubCategory::find($detailedProduct->subcategory_id)->slug) }}">{{ ucwords(strtolower(\App\SubCategory::find($detailedProduct->subcategory_id)->name)) }}</a>
            </li>
            @endif
            @if(isset($subsubcategory_id))
            <li class="breadcrumb-item">
                <a href="{{ route('products.category', \App\SubSubCategory::find($detailedProduct->subsubcategory_id)->slug) }}">{{ ucwords(\App\SubSubCategory::find($detailedProduct->subsubcategory_id)->name) }}</a>
            </li>
            @endif
            <li class="breadcrumb-item active">{{ucwords(strtolower($detailedProduct->name))}}</li>
        </ul>
        <div class="row">
            <div class="px-2 col-md-9">
            {{-- product preview section --}}
                <div class="card rounded-lg shadow-sm border-0 px-3 mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-img-view py-3">
                                <div id="p-img-slider" class="carousel slide" data-ride="carousel">

                                  <!-- Indicators -->
                                  <!--<ul class="carousel-indicators">-->
                                  <!--  <li data-target="#demo" data-slide-to="0" class="active"></li>-->
                                  <!--  <li data-target="#demo" data-slide-to="1"></li>-->
                                  <!--  <li data-target="#demo" data-slide-to="2"></li>-->
                                  <!--</ul>-->
                                  
                                  <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img src="{{ asset('storage/'.$detailedProduct->featured_img) }}" class="img-fluid show" alt="{{ucwords(strtolower($detailedProduct->name))}}">
                                        </div>

                                        @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                            @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/'.$photo) }}" class="img-fluid hide" alt="{{ucwords(strtolower($detailedProduct->name))}}">
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- Left and right controls -->
                                      <a class="carousel-control-prev" href="#p-img-slider" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                      </a>
                                      <a class="carousel-control-next" href="#p-img-slider" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                      </a>
                                </div>
                            </div>
                            <div class="product-img-select position-relative border-bottom pb-2 mb-3">
                                <div class="user-select-none smooth-scroll scr-sn-type-x-m ">
                                    
                                    <div class="p-i-s">
                                        <label data-target="#p-img-slider" data-slide-to="0" class="p-it-sel active">
                                            <img src="{{ asset('storage/'.$detailedProduct->featured_img) }}"
                                                class="img-fluid rounded-sm "
                                                alt="{{ asset('storage/'.ucwords(strtolower($detailedProduct->name))) }}">
                                        </label>
                                    </div>
                                    @php 
                                        $i = 0;
                                    @endphp
                                    @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                    @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                    @php 
                                        $i++;
                                    @endphp
                                    <div class="p-i-s">
                                        <label data-target="#p-img-slider" data-slide-to="{{$i}}" class="p-it-sel">
                                            <img src="{{ asset('storage/'.$photo) }}"
                                                class="img-fluid rounded-sm"
                                                alt="{{ asset('storage/'.ucwords(strtolower($detailedProduct->name))) }}">
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div class="col-md-7">
                            <form action="" method="post" id="option-choice-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                            <div class="product-p-section py-3">
                                <div class="product-info ">
                                    <div class="pb-2 border-bottom">
                                        <div class="product-title justify-content-between d-flex" itemprop="name">
                                            <h1 class="product-title-text ">{{ucwords(strtolower($detailedProduct->name))}}</h1>
                                        </div>
                                        <div class="product-rating d-flex align-items-center">
                                            @for($i=1;$i<6;$i++)
                                            <span class="la la-star {{($i <= $detailedProduct->rating)?'checked':''}}"></span>
                                            @endfor
                                           
                                            <!--<span class="la la-star"></span>-->
                                            <!--<span class="la la-star"></span>-->
                                            @php 
                                            $no_of_ratings = '(No rating available)';
                                                if ($detailedProduct->rating > 0         ){
                                                    $ratings =count(\App\Review::where('product_id', $detailedProduct->id)->where('status', 1)->get());
                                                    $no_of_ratings = $ratings.' rating';
                                                    if($ratings > 1){
                                                     $no_of_ratings = $ratings.' ratings';   
                                                    }
                                                }
                                            @endphp
                                            <a class="pl-2 text-secondary">{{$no_of_ratings}}</a>
                                        </div>
                                    </div>
                                    <div class="pb-2 mt-2 border-bottom">
                                        <div class="product-price">
                                            <span>
                                                Price: ₦{{ $detailedProduct->unit_price }}
                                            </span>
                                        </div>

                                    </div>
                                    <div class="pb-2 mt-2 border-bottom">
                                        <div class="product-variation">
                                            
                                            <div class="p-var-top pb-3 d-flex justify-content-between">
                                                @if($detailedProduct->variant_product)
                                                <span class="text-uppercase">Select Variation</span>
                                                {{-- <a href="#" class="font-weight-bold">Size guide</a> --}}
                                            </div>
                                            <div class="pb-2 p-var-qty">
                                                
                    
                                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                            @if(count($choice->values)>0)
                                                    <div class="row no-gutters">
                                                        <div class="col-2">
                                                            <div class="product-description-label mt-2 ">{{ (App\Attribute::find($choice->attribute_id)->name) ?? '' }}:</div>
                                                        </div>
                                                        <div class="col-10">
                                                            <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                                                @foreach ($choice->values as $key => $value)
                                                                    <li>
                                                                        <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                                        <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                        
                                                    @if (count(json_decode($detailedProduct->colors)) > 0)
                                                        <div class="row no-gutters">
                                                            <div class="col-2">
                                                                <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                                            </div>
                                                            <div class="col-10">
                                                                <ul class="list-inline checkbox-color mb-1">
                                                                    @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                                        <li>
                                                                            <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                                            <label style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                    
                                                        <hr>
                                                    @endif
                                                @endif
                                                <div class="product-quantity d-flex align-items-center">
                                                    
                                                    <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" id="minus">
                                                                <i class="la la-minus"></i>
                                                            </button>
                                                        </span>
                                                        <input type="number" id="qty" name="quantity" class="form-control rounded-lg input-number text-center" placeholder="1" value="1" min="1" max="{{$qty}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-number" type="button" data-type="plus" data-field="quantity" id="plus">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    
                                                @if ($qty > 0)
                                                    <div class="avialable-amount">(<span id="available-quantity">{{$qty}}</span> available)</div>
                                                @else
                                                    <div class="avialable-amount">(out of stock)</div>
                                                @endif
                                                </div>
                                            </div>
                                                   @if ($detailedProduct->variant_product)
                                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                                <div class="col-2">
                                                    <div class="product-description-label">{{__('Total Price')}}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="product-price">
                                                        <strong id="chosen_price">

                                                        </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                           @endif
                                            <div class="product-price my-2">
                                               @if (!$detailedProduct->variant_product) 
                                                <span class="total_price">
                                                    
                                                </span>
                                                @endif
                                            <div class="p-action-btn d-flex">
                                                @if ($qty > 0)
                                                <button type="button" class="btn bg-sec mr-2" onclick="buyNow()">Buy Now</button>
                                                <button type="button" class="btn btn-default mr-2" onclick="addToCart()">Add to cart</button>
                                                <button type="button" class="btn btn-outline-secondary"  onclick="addToWishList({{ $detailedProduct->id }})"><i class="la la-heart"></i></button>
                                                @endif

                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="p-share pb-2 mt-2">
                                        <span class="text-uppercase mb-2">Share product</span>
                                        <div class="mt-3 pb-2 social-link">
                                            <a href="#"><i class="la la-facebook"></i></a>
                                            <a href="#"><i class="la la-twitter"></i></a>
                                            <a href="#"><i class="la la-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>

                </div>
                {{-- product details section --}}
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">Product details</span>

                    </div>
                    <div class="card-body">
                        <?php echo $detailedProduct->description; ?>
                    </div>

                </div>
                {{-- specifiation section --}}
                <div class="p-spec card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">Specification</span>

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-key-feat card rounded-lg mb-3">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <span class="text-uppercase">Key features</span>
                
                                    </div>
                                    <div class="card-body">
                                        <?php echo $detailedProduct->features; ?>
                                    </div>
                
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="p-key-feat card rounded-lg mb-3">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <span class="text-uppercase">Specifications</span>
                
                                    </div>
                                    <div class="card-body">
                                        <?php echo $detailedProduct->specification; ?>
                                    </div>
                
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                {{-- reviews section --}}
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">Customers reviews</span>

                    </div>
                    <div class="card-body">
                        <div class="fluid-paragraph">
                                @foreach ($detailedProduct->reviews as $key => $review)
                                    <div class="block block-comment mb-4 border-bottom">
                                        <div class="block-image">
                                            <img width="40" height="40" src="{{ asset('assets/images/profile-icon.jpg') }}" data-src="{{ asset($review->user->avatar_original) }}" class="rounded-circle lazyload">
                                        </div>
                                        <div class="block-body">
                                            <div class="block-body-inner">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <h3 class="heading heading-6">
                                                            <a href="javascript:;">{{ $review->user->name }}</a>
                                                        </h3>
                                                        <span class="comment-date">
                                                            {{ date('d-m-Y', strtotime($review->created_at)) }}
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="rating text-right clearfix d-block">
                                                            <span class="product-rating star-rating-sm float-right">
                                                                @for ($i=0; $i < $review->rating; $i++)
                                                                    <i class="la la-star checked"></i>
                                                                @endfor
                                                                @for ($i=0; $i < 5-$review->rating; $i++)
                                                                    <i class="la la-star"></i>
                                                                @endfor
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="comment-text">
                                                    {{ $review->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if(count($detailedProduct->reviews) <= 0)
                                    <div class="text-center mb-4 pb-2 border-bottom">
                                        {{ __('There is no review(s) for this product yet.') }}
                                    </div>
                                @endif

                                @if(Auth::check())
                                    @php
                                        $commentable = false;
                                    @endphp
                                    @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                        @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                            @php
                                                $commentable = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($commentable)
                                        <div class="leave-review">
                                            <div class="section-title section-title--style-1">
                                                <h3 class="section-title-inner heading-6 font-weight-bold text-uppercase">
                                                    {{__('Write a review')}}
                                                </h3>
                                            </div>
                                            <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $detailedProduct->id ?? '' }}">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="text-uppercase c-gray-light">{{__('Your name')}}</label>
                                                            <input type="text" name="name" value="{{ Auth::user()->name ?? ''}}" class="form-control" disabled required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="text-uppercase c-gray-light">{{__('Email')}}</label>
                                                            <input type="text" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-control" required disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="c-rating mt-1 mb-1 clearfix">
                                                            <input type="radio" id="star5" name="rating" value="5" required/>
                                                            <label class="la la-star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                            <input type="radio" id="star4" name="rating" value="4" required/>
                                                            <label class="la la-star" for="star4" title="Great" aria-hidden="true"></label>
                                                            <input type="radio" id="star3" name="rating" value="3" required/>
                                                            <label class="la la-star" for="star3" title="Very good" aria-hidden="true"></label>
                                                            <input type="radio" id="star2" name="rating" value="2" required/>
                                                            <label class="la la-star" for="star2" title="Good" aria-hidden="true"></label>
                                                            <input type="radio" id="star1" name="rating" value="1" required/>
                                                            <label class="la la-star" for="star1" title="Bad" aria-hidden="true"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" rows="4" name="comment" placeholder="{{__('Your review')}}" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-default mt-4">
                                                        {{__('Send review')}}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>
                    </div>

                </div>

            </div>
            </div>
            {{-- preview sidebar --}}
            <div class="px-2 col-md-3">
                <div class="sticky-top">
                <div class="p-key-feat card border-0 rounded-lg mb-3">
                    <div class="card-header bg-white border-bottom py-2">
                        <span class="text-uppercase font-weight-bold">Delivery & Returns</span>

                    </div>
                    <div class="card-body">

                    </div>

                </div>
                <div class="p-key-feat card border-0 rounded-lg mb-3">
                    <div class="card-header bg-white border-bottom py-2">
                        <span class="text-uppercase font-weight-bold">Seller's Information</span>

                    </div>
                    <div class="card-body">
                        <div class="seller-info-box mb-3">
                        <div class="sold-by position-relative">
                            @if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->seller->verification_status == 1)
                                <div class="position-absolute medal-badge">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">
                                        <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                        60,116.6 124.1,116.6 "/>
                                    </svg>
                                </div>
                            @endif
                            <div class="title">{{__('Sold By')}}</div>
                            @if($detailedProduct->added_by == 'seller')
                                <a href="{{ route('store.visit', $detailedProduct->user->seller->store->slug ?? '') }}" class="name d-block">{{ $detailedProduct->user->seller->store->name ?? ''}}
                                @if ($detailedProduct->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                                </a>
                                <div class="location">{{ $detailedProduct->user->seller->store->address ?? '' }}</div>
                            @else
                                {{ env('APP_NAME') }}
                            @endif
                            @php
                                $total = 0;
                                $rating = 0;
                                foreach ($detailedProduct->user->product as $key => $seller_product) {
                                    $total += $seller_product->reviews->count();
                                    $rating += $seller_product->reviews->sum('rating');
                                }
                            @endphp

                            <div class="rating text-center d-block">
                                <span class="product-rating star-rating-sm d-block">
                                    @if ($total > 0)
                                        @php 
                                        $avg_rating = $rating/$total; 
                                        @endphp
                                    @else
                                        @php 
                                        $avg_rating = 0; 
                                        @endphp
                                    @endif
                                    @for($i=1;$i<6;$i++)
                                            <span class="la la-star {{($i <= $avg_rating)?'checked':''}}"></span>
                                    @endfor
                                </span>
                                <span class="rating-count d-block ml-0">({{ $total }} {{__('customer reviews')}})</span>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            @if($detailedProduct->added_by == 'seller')
                                <div class="col">
                                    <a href="{{ route('store.visit', $detailedProduct->user->seller->store->slug ?? '') }}" class="d-block store-btn">{{__('Visit Store')}}</a>
                                </div>
                                <div class="col">
                                    
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>

                </div>
                <div class="p-key-feat card border-0 rounded-lg mb-3">
                    <div class="card-header bg-white border-bottom py-2">
                        <span class="text-uppercase font-weight-bold">Recommended</span>

                    </div>
                    <div class="card-body">

                    </div>

                </div>
            </div>
            </div>
            <div class="px-2 col-md-12">
                                @php 
                $relatedProducts = \App\Product::where('subsubcategory_id', $detailedProduct->subsubcategory_id)->orWhere('subcategory_id', $detailedProduct->subcategory_id)->orWhere('category_id', $detailedProduct->category_id)->orWhere('user_id','$detailedProduct->user_id')->where('id', '!=', $detailedProduct->id)->limit(12)->get();
                @endphp
                @if(count($relatedProducts) > 0)
                {{-- related product section --}}
                <div class="flashdeals-entry">
                    <div class="title-container">
                        <a href="#" class="hot-zone"></a>
                        <div class="title-info">
                            <h3>Related products</h3>
            
                        </div>
                        <span class="view-more">view more</span>
                    </div>
                    <div class="product-container">
                        <ul class="product-list  util-clearfix flex-horizontal flex-wrap">
                            @foreach($relatedProducts as $relatedProduct)
                            <li class="product-item">
                                <a href="{{route('product', $relatedProduct->slug)}}">
                                    <div class="item-box">
                                        <div class="img-wrapper flex justify-center align-items-center">
                                            <img class="img-fluid" src="{{asset('storage/'.$relatedProduct->featured_img)}}">
                                        </div>
                                        <div class="pro-price">
                                        <span class="current-price util-left">₦{{number_format($relatedProduct->unit_price,2)}}</span>
                                            <span class="discount">{{($relatedProduct->discount==0.00)?'' : ('-'.$relatedProduct->discount.'%')}}</span>
                                        </div>
                                        <div class="pro-remaining">
                                            <span class="progress-box">
                                                <span class="progress-inner" style="width:29%;min-width:8px;"></span>
                                            </span>
                                            <div class="pro-claimed">{{$relatedProduct->name}}</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
            
                </div>
                @endif
            </div>
        </div>

    </div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
    var x = $('#qty');
    var qty = {{$qty}};
    $("#plus").click(function(){ 
        if (x.val() < qty){
        x.val( +x.val() + 1 );
        }
        get_total();
    });

    $("#minus").click(function(){ 
        if (x.val()>1){
        x.val( +x.val() - 1 );
        }
        get_total();
    });

    x.on('change', function(){
        if (x.val() <= qty){
            get_total();
        }
    });

    function get_total(){
        total = x.val() * {{$detailedProduct->unit_price}};
        output = total.toLocaleString('en-US');
        $('.total_price').html("Total: ₦"+output);
    }

    });
</script>
@endsection