@extends('layouts.theme')

@section('title', 'Product Sales')
@section('link')
    <!-- Data table CSS -->
	<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
@php
//    $name = Str::of(Auth::user()->name)->explode(' ');
//    $user_name = $name[0];

   $user_id = Auth::user()->id;

   $seller_id = App\Seller::select('id')->where('user_id',$user_id);
   if (Auth::user()->user_type == 'admin'){
       $seller_id = $user_id;
   }
@endphp

    <div class="col-lg-3">

       @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Product Sales</h4>
            </div>
            <div class="card-body">
               
                <!-- Order history table -->
                <div class="mt-4 p-4">
                    <div>
                        <table class="table" id="sales_tab">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Order Code')}}</th>
                                    <th>{{__('Num. of Products')}}</th>
                                    <th>{{__('Customer')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Delivery Status')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @if ($orders != null && count($orders) > 0)
                                @foreach ($orders as $key => $order_id)
                                    @php
                                        $order = \App\Order::find($order_id->id);
                                    @endphp
                                    @if($order != null)
                                        <tr>
                                            <td>
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                <a href="#{{ $order->code }}" onclick="show_order_details({{ $order->id }})">{{ $order->code }}</a>
                                            </td>
                                            <td>
                                                {{ count($order->orderDetails->where('seller_id', Auth::user()->id)) }}
                                            </td>
                                            <td>
                                                @if ($order->user_id != null)
                                                    {{ $order->user->name }}
                                                @else
                                                    Guest ({{ $order->guest_id }})
                                                @endif
                                            </td>
                                            <td>
                                                {{ number_format($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price'),2) }}
                                            </td>
                                            <td>
                                                @php
                                                    $status = $order->orderDetails->first()->delivery_status;
                                                @endphp
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </td>
                                            <td>
                                                <span class="badge badge--2 mr-4">
                                                    @if ($order->orderDetails->where('seller_id', Auth::user()->id)->first()->payment_status == 'paid')
                                                        <i class="bg-green"></i> {{__('Paid')}}
                                                    @else
                                                        <i class="bg-red"></i> {{__('Unpaid')}}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                        <button onclick="show_order_details({{ $order->id }})" class="dropdown-item">{{__('Order Details')}}</button>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
@section('script')
<!-- Data table JavaScript -->
<script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script>
    /*DataTable Init*/
    "use strict";
    $(document).ready(function() {
        "use strict";
        $('#sales_tab').DataTable();
        $('#produ').DataTable({
            "lengthChange": false
        });
    });
</script>
@endsection