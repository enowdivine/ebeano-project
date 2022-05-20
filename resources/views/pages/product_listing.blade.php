@extends('layouts.theme')



@if(isset($subsubcategory_id))
@php
$meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
$meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
@endphp
@elseif (isset($subcategory_id))
@php
$meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
$meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
@endphp
@elseif (isset($category_id))
@php
$meta_title = \App\Category::find($category_id)->meta_title;
$meta_description = \App\Category::find($category_id)->meta_description;
@endphp
@elseif (isset($brand_id))
@php
$meta_title = \App\Brand::find($brand_id)->meta_title;
$meta_description = \App\Brand::find($brand_id)->meta_description;
@endphp
@else
@php
$meta_title = env('APP_NAME');
if (\App\SeoSetting::first() !=null){
    $meta_description = \App\SeoSetting::first()->description;
}
@endphp
@endif

@section('meta_title'){{ $meta_title ?? ''}}@stop
@section('meta_description'){{ $meta_description ?? '' }}@stop

@section('meta')

@if (($meta_title ?? '') != null || ($meta_description ?? '') != null)
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title ?? ''  }}">
<meta itemprop="description" content="{{ $meta_description ?? '' }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title ?? '' }}">
<meta name="twitter:description" content="{{ $meta_description ?? '' }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description ?? '' }}" />
@endif

@endsection
@if ($meta_title ?? '')
@section('title', $meta_title. ' - Ebeano Marrket')

@endif
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active"><a
                        href="{{ route('products') }}">{{ ('All products') }}</a>
                    </li>

                    @if(isset($category_id))
                    <li class="breadcrumb-item active">
                    {{ \App\Category::find($category_id)->name }}
                    </li>
                    @endif
                    @if(isset($subcategory_id))
                    <li class="breadcrumb-item breadcrumb-item"><a
                            href="{{ route('products.by_category', ['slug' => \App\SubCategory::find($subcategory_id)->category->slug]) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ \App\SubCategory::find($subcategory_id)->name }}
                    </li>
                    @endif
                    @if(isset($subsubcategory_id))
                    <li class="breadcrumb-item"><a
                            href="{{ route('products.by_category', ['slug' => \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug]) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<form class="" id="search_form" action="{{ route('search') }}" method="GET">
<div class="row py-2">
    
        <div class="col-lg-3 mb-3">
            <div class="sidebar">
                <article>
                    <h2 class="text-uppercase ">Category</h2>
                    <ul>
                        @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) &&
                        !isset($subsubcategory_id))
                        @foreach(\App\Category::all() as $category)
                        <li class=""><a
                                href="{{ route('products.by_category', ['slug' => $category->slug]) }}">{{ __($category->name) }}
                                ({{ count($category->products) }})</a></li>
                        @endforeach
                        @endif
                        @if(isset($category_id))
                        <li class="active"><a href="{{ route('products') }}">{{__('All Categories')}}</a>
                            <ul>
                                <li class="active">
                                    <a href="{{ route('products.category', ['slug' => \App\Category::find($category_id)->slug]) }}">{{ __(\App\Category::find($category_id)->name) }}</a>
                                    <ul>
                                        @foreach (\App\Category::find($category_id)->subcategory as $key2 => $subcategory)
                                        <li class="child"><a
                                        href="{{ route('products.subcategory', $subcategory->slug) }}">{{ __($subcategory->name) }}
                                        ({{ count($subcategory->products) }})</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        @endif
                        @if(isset($subcategory_id))
                        <li class="active"><a href="{{ route('products') }}">{{__('All Categories')}}</a></li>
                        <li class="active"><a
                                href="{{ route('products.by_category', ['slug' => \App\SubCategory::find($subcategory_id)->category->slug]) }}">{{ __(\App\SubCategory::find($subcategory_id)->category->name) }}</a>
                        </li>
                        <li class="child"><a
                                href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ __(\App\SubCategory::find($subcategory_id)->name) }}</a>
                        </li>
                        @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                        <li class="child"><a
                                href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}
                                ({{ count($subsubcategory->products) }})</a></li>
                        @endforeach
                        @endif
                        @if(isset($subsubcategory_id))
                        <li class="active"><a href="{{ route('products') }}">{{__('All Categories')}}</a></li>
                        <li class="active"><a
                                href="{{ route('products.by_category', ['slug' => \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug]) }}">{{ __(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</a>
                        </li>
                        <li class="active"><a
                                href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ __(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</a>
                        </li>
                        <li class="current"><a
                                href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}">{{ __(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a>
                        </li>
                        @endif
                    </ul>
                </article>
                <article class="border-top ">
                    <h2 class="text-uppercase ">Price</h2>
                    <!-- Range slider container -->
                    <div id="input-slider-range"
                        data-range-value-min="{{ \App\Product::query()->get()->min('unit_price') }}"
                        data-range-value-max="{{ \App\Product::query()->get()->max('unit_price') }}"></div>

                    <!-- Range slider values -->
                    <div class="row">
                        <div class="col-6">
                            <span class="range-slider-value value-low" @if (isset($min_price))
                                data-range-value-low="{{ $min_price }}" @elseif($products->min('unit_price') > 0)
                                data-range-value-low="{{ $products->min('unit_price') }}"
                                @else
                                data-range-value-low="0"
                                @endif
                                id="input-slider-range-value-low">
                        </div>

                        <div class="col-6 text-right">
                            <span class="range-slider-value value-high" @if (isset($max_price))
                                data-range-value-high="{{ $max_price }}" @elseif($products->max('unit_price') > 0)
                                data-range-value-high="{{ $products->max('unit_price') }}"
                                @else
                                data-range-value-high="0"
                                @endif
                                id="input-slider-range-value-high">
                        </div>
                    </div>
                </article>
                <article class="border-top">
                    <h2 class="text-uppercase">Colors</h2>
                    <div class="">
                        <!-- Filter by color -->
                        <ul class="list-inline checkbox-color checkbox-color-circle mb-0">
                            @foreach ($all_colors as $key => $color)
                            <li>
                                <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}"
                                    @if(isset($selected_color) && $selected_color==$color) checked @endif
                                    onchange="filter()">
                                <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip"
                                    data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
                @foreach ($attributes as $key => $attribute)
                @if (\App\Attribute::find($attribute['id']) != null)
                <article class="border-top">
                    <h2 class="text-uppercase">{{ \App\Attribute::find($attribute['id'])->name }}</h2>
                        <div class="">
                            @if(array_key_exists('values', $attribute))
                            @foreach ($attribute['values'] as $key => $value)
                            @php
                            $flag = false;
                            if(isset($selected_attributes)){
                            foreach ($selected_attributes as $key => $selected_attribute) {
                            if($selected_attribute['id'] == $attribute['id']){
                            if(in_array($value, $selected_attribute['values'])){
                            $flag = true;
                            break;
                            }
                            }
                            }
                            }
                            @endphp
                            <div class="checkbox">
                                <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}"
                                    name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                </article>
                @endif
                @endforeach
            </div>

        </div>
        <div class="col-lg-9 ">
            @isset($category_id)
            <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">
            @endisset
            @isset($featured)
            <input type="hidden" name="category" value="{{ $featured }}">
            @endisset
            @isset($subcategory_id)
            <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">
            @endisset
            @isset($subsubcategory_id)
            <input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">
            @endisset
            <div class="float-right">
                <div class="sort-by-box px-1">
                    <div class="form-group">
                        <select class="form-control custom-select custom-select-sm sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                            <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                            <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                            <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                            <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="search-content">
                <div class="search-title">
                    <h2 class="text-uppercase">
                        @if ($category_id)
                        {{ \App\Category::find($category_id)->name }}
                        @elseif($subcategory_id)
                        {{ \App\SubCategory::find($subcategory_id)->name }}
                        @elseif($subsubcategory_id)
                        @php $subsubcat = \App\SubSubCategory::find($subsubcategory_id) @endphp
                        {{ $subsubcat->name.' '.$subsubcat->subcategory->name }}
                        @else
                        {{isset($featured) ? ('Featured Products') : ('Shop Now')}}
                        @endif
                    </h2>
                
                </div>
                <div class="search-main row mx-auto py-2 ">
                    @foreach ($products as $key => $product)
                    @if ($product->unit_price != 0 && $product->featured_img != null)
                    <article class="product-card mb-2 col-6 col-md-3">
                        <a class="core" href="{{ route('product', $product->slug) }}">
                            <div class="product-img">
                                <img class="img lazyload" src="{{ asset('storage/'.$product->featured_img) }}"
                                    data-src="{{ asset('storage'.$product->featured_img) }}"
                                    alt="{{ __($product->name) }}" width="208" height="208">
                            </div>
                            <div class="info">
                                {{-- <div class="tag">Shipped from abroad</div> --}}
                                <h3 class="name">{{$product->name}}</h3>
                                <div class="price">₦ {{number_format($product->unit_price,2) }}</div>
                                <div class="price-discount">
                                    {{-- <div class="old">₦ 65,780</div>
                                        <div class="tag disc">64%</div> --}}
                                </div>
                            </div>
                        </a>
                        <footer class="ft">
                            <div class="ft-center" data-add-cart="" data-sku="ME782MP172ABANAFAMZ">
                                <button type="button" class="btn btn-sm btn-default" onclick="showAddToCartModal({{ $product->id }})" data-trigpopup="">Add To
                                    Cart</button>
                            </div>
                        </footer>
                    </article>
                    @endif
                    @endforeach
                </div>

            </div>
            {{-- <div class="list-pagination my-3">
                <ul class="page">
                    <li class="page__btn"><span class="material-icons">chevron_left</span></li>
                    <li class="page__numbers"> 1</li>
                    <li class="page__numbers active">2</li>
                    <li class="page__numbers">3</li>
                    <li class="page__numbers">4</li>
                    <li class="page__numbers">5</li>
                    <li class="page__numbers">6</li>
                    <li class="page__dots">...</li>
                    <li class="page__numbers"> 10</li>
                    <li class="page__btn"><span class="material-icons">chevron_right</span></li>
                    
                  </ul>
            </div> --}}

            {{ $products->onEachSide(1)->links() }}

        </div>
    
</div>
</form>
@endsection

@section('script')

<script>
function filter(){
     $('#search_form').submit();
}

function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
</script>
    
@endsection