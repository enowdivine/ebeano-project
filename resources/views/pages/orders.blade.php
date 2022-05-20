@extends('layouts.theme')

@section('title', 'Dashboard')

@section('content')
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @if(Auth::user()->user_type == 'seller' || Auth::user()->user_type == 'admin')
        @include('inc.seller_nav')
    @elseif(Auth::user()->user_type == 'user')
        @include('inc.customer_nav')
    @endif

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Orders</h4>
            </div>
            <div class="card-body">
                @if (count($orders) > 0)
                            <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>{{__('Code')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Delivery Status')}}</th>
                                                <th>{{__('Payment Status')}}</th>
                                                <th>{{__('Options')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>
                                                        <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                                    </td>
                                                    <td>{{ date('d-m-Y', $order->date) }}</td>
                                                    <td>
                                                        {{ single_price($order->grand_total) }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $status = $order->orderDetails->first()->delivery_status;
                                                        @endphp
                                                        @if($order->delivery_viewed == 0)
                                                            <span class="ml-2" style="color:green"><strong>({{ __('Updated') }})</strong></span>
                                                        @else
                                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge badge--2 mr-4">
                                                            @if ($order->payment_status == 'paid')
                                                                <i class="bg-green"></i> {{__('Paid')}}
                                                            @else
                                                                <i class="bg-red"></i> {{__('Unpaid')}}
                                                            @endif
                                                            @if($order->payment_status_viewed == 0)<span class="ml-2" style="color:green"><strong>({{ __('Updated') }})</strong></span>@endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>

                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                                <button onclick="show_purchase_history_details({{ $order->id }})" class="dropdown-item">{{__('Order Details')}}</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                       <h6 class="text-center">No Orders Yet.</h6>
                            @endif
            </div>
        </div>

    </div>

</div>
@endsection