<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="col-lg-6">
                             <div class="product-img-view py-3">
                                <div id="p-img-slider" class="carousel slide" data-ride="carousel">
                                  
                                  <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img src="{{ asset('storage/'.$product->featured_img) }}" class="img-fluid show" alt="{{ucwords(strtolower($product->name))}}">
                                        </div>

                                        @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                                            @foreach (json_decode($product->photos) as $key => $photo)
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/'.$photo) }}" class="img-fluid hide" alt="{{ucwords(strtolower($product->name))}}">
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
                                            <img src="{{ asset('storage/'.$product->featured_img) }}"
                                                class="img-fluid rounded-sm "
                                                alt="{{ asset('storage/'.ucwords(strtolower($product->name))) }}">
                                        </label>
                                    </div>
                                    @php 
                                        $i = 0;
                                    @endphp
                                    @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                                    @foreach (json_decode($product->photos) as $key => $photo)
                                    @php 
                                        $i++;
                                    @endphp
                                    <div class="p-i-s">
                                        <label data-target="#p-img-slider" data-slide-to="{{$i}}" class="p-it-sel">
                                            <img src="{{ asset('storage/'.$photo) }}"
                                                class="img-fluid rounded-sm"
                                                alt="{{ asset('storage/'.ucwords(strtolower($product->name))) }}">
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
        </div>

        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                    {{ __($product->name) }}
                </h2>


                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong>
                                    {{ $product->unit_price }}
                                </strong>
                                <span class="piece">/{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                


                <hr>

                @php
                    $qty = 0;
                    if($product->variant_product){
                        foreach ($product->stocks as $key => $stock) {
                            $qty += $stock->qty;
                        }
                    }
                    else{
                        $qty = $product->current_stock;
                    }
                @endphp

                            <form action="" method="post" id="option-choice-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="product-p-section py-3">
                                <div class="product-info ">
                                    <div class="pb-2 border-bottom">
                                        <div class="product-title justify-content-between d-flex" itemprop="name">
                                            <h1 class="product-title-text ">{{ucwords(strtolower($product->name))}}</h1>
                                        </div>
                                        <div class="product-rating d-flex align-items-center">
                                            @for($i=1;$i<6;$i++)
                                            <span class="la la-star {{($i <= $product->rating)?'checked':''}}"></span>
                                            @endfor
                                           
                                            <!--<span class="la la-star"></span>-->
                                            <!--<span class="la la-star"></span>-->
                                            @php 
                                            $no_of_ratings = '(No rating available)';
                                                if ($product->rating > 0         ){
                                                    $ratings =count(\App\Review::where('product_id', $product->id)->where('status', 1)->get());
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
                                                Price: ₦{{ $product->unit_price }}
                                            </span>
                                        </div>

                                    </div>
                                    <div class="pb-2 mt-2 border-bottom">
                                        <div class="product-variation">
                                            
                                            <div class="p-var-top pb-3 d-flex justify-content-between">
                                                @if($product->variant_product)
                                                <span class="text-uppercase">Select Variation</span>
                                                {{-- <a href="#" class="font-weight-bold">Size guide</a> --}}
                                            </div>
                                            <div class="pb-2 p-var-qty">
                                                
                    
                                                    @foreach (json_decode($product->choice_options) as $key => $choice)
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
                                        
                                                    @if (count(json_decode($product->colors)) > 0)
                                                        <div class="row no-gutters">
                                                            <div class="col-2">
                                                                <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                                            </div>
                                                            <div class="col-10">
                                                                <ul class="list-inline checkbox-color mb-1">
                                                                    @foreach (json_decode($product->colors) as $key => $color)
                                                                        <li>
                                                                            <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                                            <label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
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
                                                   @if ($product->variant_product)
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
                                               @if (!$product->variant_product) 
                                                <span class="total_price">
                                                    
                                                </span>
                                                @endif
                                            <div class="p-action-btn d-flex">
                                                @if ($qty > 0)
                                                <button type="button" class="btn bg-sec mr-2" onclick="buyNow()">Buy Now</button>
                                                <button type="button" class="btn btn-default mr-2" onclick="addToCart()">Add to cart</button>
                                                <button type="button" class="btn btn-outline-secondary"  onclick="addToWishList({{ $product->id }})"><i class="la la-heart"></i></button>
                                                @endif

                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>
                            </form>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });
</script>
