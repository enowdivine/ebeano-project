@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Orders</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="eb-admin">Dashboard</a></li>

                <li class="active"><span>Orders</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->

    <!-- Row -->
	<div class="row">
		<div class="col-sm-6">
			@if(Session::has('success') && !empty(Session::get('success')))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif

			@if(Session::has('error') && !empty(Session::get('error')))
			<div class="alert alert-warning">
				{{Session::get('error')}}
			</div>
			@endif

			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		</div>
	</div>

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">All Orders</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_g_1" class="table table-hover display  pb-30">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order number</th>
                                            <th>No. of Products</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>
                                                Delivery status
                                            </th>
                                            <th>Payment method</th>
                                            <th>Payment status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $orders = App\Order::all();
                                        $i = 0;
                                        @endphp
                                        @foreach ($orders as $order)
                                        @php $i += 1 @endphp
                                        <tr>

                                            <td>{{$i}}</td>
                                            <td>{{$order->code}}</td>
                                            <td>{{count($order->order_details->id)}}</td>
                                            <td>
                                                @if ($order->user_id != null)
                                                {{$order->user->name}}
                                                @endif
                                            </td>
                                            <td>{{$order->grand_total}}</td>
                                            <td>{{$order->delivery_status}}</td>
                                            <td>{{$order->payment_method}}</td>
                                            <td>{{$order->payment_status}}</td>
                                            <td>
                                                <div class="btn-group z-index-10">
                                                    <div class="pull-left d-inline-block dropdown">
                                                        <a href="#" aria-expanded="false" data-toggle="dropdown"
                                                            class="dropdown-toggle " type="button"> <i
                                                                class="zmdi zmdi-more-vert"></i></button>
                                                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a
                                                                        href="{{route('orders.show',['id'=>$order->id])}}"><i
                                                                            class="zmdi zmdi-eye"></i><span>View</span></a>
                                                                </li>
                                                                @if ($order->payment_status == 'unpaid')
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#approval"><i class="zmdi zmdi-check "></i><span>Approve</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#deactivate" data-toggle="modal" data-target="#cancelOrder"><i class="zmdi zmdi-close"></i><span>Cancel</span></a>
                                                                </li>
                                                                {{-- Approval modal --}}

                                                                <div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header border-bottom-0">

                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h2>Are you sure you want to approve this order?</h2>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('orders.approve',['id'=>encrypt($order->id)])}}" class="btn btn-warning">Yes, Approve</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- Cancel modal --}}
                                                                <div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="cancelOrderLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header border-bottom-0">

                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h2>Are you sure you want to approve this order?</h2>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('orders.cancel',['id'=>encrypt($order->id)])}}" class="btn btn-warning">Yes, Cancel Order</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </ul>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>

@endsection