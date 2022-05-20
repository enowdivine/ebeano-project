 
@if (Session::get('cart') != null)
<div class="card shadow-sm border-0 sticky-top">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>Summary</span>
                </h3>
            </div>

            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{__('Items')}}</span>
            </div>
        </div>
    </div>

    <div class="card-body">

        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="product-name">{{__('Product')}}</th>
                    <th class="product-total text-right">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $shipping = 0;
                    
                    if (Session::get('cart') != null){
                        $cart = Session::get('cart');
                        
                    }
                    if (Session::get('shipping') != 0){
                            $shipping = Session::get('shipping');
                    } 
                @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                    $product = \App\Product::find($cartItem['id']);
                    $subtotal += $cartItem['price']*$cartItem['quantity'];

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
                    @php
                        $total = $subtotal+$shipping;
                        if(Session::has('coupon_discount')){
                            $total -= Session::get('coupon_discount');
                        }
                    @endphp
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $product_name_with_choice." (".($cartItem['weight'])."kg) " }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ number_format($cartItem['price']*$cartItem['quantity'],2) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tbody>
                @if ($shipping > 0)
                    <tr class="cart_item">
                        <td class="product-name">
                            <strong class="product-quantity">{{ __('Shipping Cost')}}</strong>
                        </td>
                        <td class="product-total text-right"> 
                            <span class="pl-4">{{ number_format($shipping,2) }}</span>
                        </td>
                    </tr>
                @elseif (Session::has('shipping') && $shipping == 0)
                    <tr class="cart_item">
                        <td class="product-total " > 
                            <span >{{__("Sorry! Shipping to this location is coming soon.")}}</span>
                        </td>
                        <td></td>
                    </tr>
                @else
                    <tr class="cart_item">
                        <td class="product-total" > 
                            <span >{{__("Please select shipping location")}}</span>
                        </td>
                        <td></td>
                    </tr> 
                     
                @endif
            </tbody>

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ number_format($subtotal,2) }}</span>
                    </td>
                </tr>

                

                <tr class="cart-shipping">
                    <th>{{__('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ number_format($shipping,2) }}</span>
                    </td>
                </tr>

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ number_format(Session::get('coupon_discount'),2) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ number_format($total,2) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

    @if ($shipping > 0) 
    <hr class="mb-4">
    <button class="btn btn-default btn-lg btn-block" type="submit">{{isset($saved) ? 'Pay': 'Save and Continue'}} <span id="spinner" class="d-none"><img src="{{asset('assets/images/pulse2.gif')}}"></span></button>
    @endif        
    </div>
</div>
@endif
