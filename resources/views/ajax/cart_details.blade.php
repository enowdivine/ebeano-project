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
        @endif
    </div>

<script type="text/javascript">
    cartQuantityInitialize();
</script>
