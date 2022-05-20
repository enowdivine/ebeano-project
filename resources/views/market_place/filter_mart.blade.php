@extends('layouts.theme')

@section('title', $detailedMart->name.' Market Place')
<style>
    .eb-mart-product {
        margin-right:5px;
        box-shadow: none;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .eb-mart-product:hover {
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
        border:1px solid rgb(131, 13, 146);
    }
    .eb-mart-box .all-mart {
        height: 49px;
        line-height: 49px;
        padding-left: 16px;
        font-size: 13px;
        background-color: rgb(131, 13, 146);
        color: #fff;
        box-sizing: border-box;
        border-radius: 8px 8px 0 0;
    }
</style>
@section('content')
    <div class="search-section mt-4 mb-0">
        <form action="{{route('mart.filter')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">State</span>
                    </div>
                    <select id="eb-states-get-marts" class="eb-select custom-select" name="state">
                        <option disabled>Select</option>
                        @foreach ($states as $state)
						<option value="{{$state->state_id}}">{{$state->name}}</option>
						@endforeach
                    </select>
                </div>
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mart</span>
                    </div>
                    <select id="eb-marts" class="eb-select custom-select" name="mart">
                        <option disabled>Select</option>
                    </select>
                </div>
                <div class="col-md">
                    <input type="submit" class="btn eb-text-sm btn-sm btn-default" value="Filter">
                    <a href="/all_markets" class="btn eb-text-sm btn-sm btn-default ml-3">< Go back</a>
                </div>
            </div>

        </form>

    </div>
    
    <div class="section" style="background:white">
    <div class="title-container py-2 px-3 my-3 border-bottom">
       <div class="title-info">
            <i class="iconfont la la-top"></i>
            <h2>{{ __($detailedMart->name) }}</h2>

        </div>
    </div>
    <div class="row px-2">
    
        @foreach ($products as $key => $product)
        <a href="{{ route('product', $product->slug) }}" target="_blank" class="product-detail"
                            title="{{ __($product->name) }}">
        <div class="col-sm-6 col-xs-6 col-md-2 col-lg-2 mb-2 col-12">
            <div class="product-container eb-mart-product">
                <div class="hg-product log_product" data-spm="3"
                    data-params=""
                    data-aplus-clk="x4_7fee6680"
                    data-spm-anchor-id=""
                    data-aplus-ae=""><a href="{{ route('product', $product->slug) }}" target="_blank" class="product-detail" title="{{ __($product->name) }}">
                        <div class="offer-image product-image">
                            <div class="inner-image-wrapper"><img
                                    src="{{ asset('storage/'.$product->featured_img) }}" alt="{{ __($product->name) }}">
                            </div>
                        </div>
                    </a>
                    <div class="offer-content-small" style="padding-left:0">
                        <a href="{{ route('product', $product->slug) }}" target="_blank" class="product-detail"
                            title="{{ __($product->name) }}">
                            <div class="offer-row product-subject">{{ __($product->name) }}</div>
                            <div class="offer-row product-price single-line">
                                @if(home_eb_base_price($product->id) != home_eb_discounted_price($product->id))
                                    <del class="old-product-price strong-400">{{ home_eb_base_price($product->id) }}</del>
                                            @endif
                                <span class="price strong-600">
                                    {{ home_eb_discounted_price($product->id) }}</span>
                                </span>
                            </div>
                            <div class="offer-row product-moq single-line">
                                <div class="product-rating d-flex align-items-center">
                                    {{ renderStarRating($product->rating) }}
                                </div>
                            </div>
                        </a><a href="" target="_blank" class="product-detail" title=""></a>
                        <div class="offer-ad">
                            <a title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" tabindex="0">
                                <i class="la la-heart-o"></i>
                            </a>
                            <a title="Add to Compare" onclick="addToCompare({{ $product->id }})" tabindex="0">
                                <i class="la la-refresh"></i>
                            </a>
                            <a title="Quick view" onclick="showAddToCartModal({{ $product->id }})" tabindex="0">
                                <i class="la la-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
        </a>
        
        {!! $products->links() !!}
    </div>
    
</div>
    
@endsection

@section('script')
<script>
$(document).ready(function(){
// select list of markets
    $('#eb-states-get-marts').on('change',function(e) {
    $('#eb-marts').html(null);
    $('#eb-marts').append($('<option>', {
		value: 0,
		text: 'select'
	}));
    $.post('{{ route('get-marts') }}', {_token:'{{ csrf_token() }}', state_id:e.target.value}, function(data){
            $.each(data.ebMarts, function(id, name){

                $('#eb-marts').append('<option value="'+id+'">'+name+'</option>');
            })
        });
    })
});
</script>
@endsection