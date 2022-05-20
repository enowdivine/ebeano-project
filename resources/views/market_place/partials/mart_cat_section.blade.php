@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $martCat)
    @if ($martCat->category != null)
<div class="section" style="background:white">
    <div class="title-container py-2 px-3 my-3 border-bottom">
       <div class="title-info">
            <i class="iconfont la la-top"></i>
            <h3>{{ __($martCat->category->name) }}</h3>

        </div>
        <span class="view-more"><a href="{{ route('products.category', $martCat->category->slug) }}" class="btn eb-text-sm btn-sm btn-default ml-3">View More</a></span>
    </div>
    <div class="row px-2">
    
        @foreach (filter_eb_products(\App\Product::where('published', 1)->where('category_id', $martCat->category->id))->latest()->limit(12)->get() as $key => $product)
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
    </div>
    
</div>


    @endif
@endforeach