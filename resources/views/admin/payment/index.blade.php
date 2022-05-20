`@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Payments</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="eb-admin">Dashboard</a></li>

                <li class="active"><span>Payments</span></li>
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
                        <h6 class="panel-title txt-dark">All Payments</h6>
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
                                            <th>Reference</th>
                                            <th>Payment type</th>
                                            <th>Paid by</th>
                                            <th>Email</th>
                                            <th>Amount</th>
                                            <th>Payment method</th>
                                            <th>Payment status</th>
                                            <th>Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $payments = App\Payment::all();
                                        $i = 0;
                                        @endphp
                                        @foreach ($payments as $payment)
                                        @php 
                                        
                                        $i += 1;
                                        $user = App\User::where('id',$payment->user_id)->first();
                                        
                                        @endphp
                                        @if ($user != null)
                                        <tr>

                                            <td>{{$i}}</td>
                                            <td>{{$payment->txn_code}}</td>
                                            <td>{{$payment->payment_type}}</td>
                                            <td>
                                                
                                                {{$user->name}}
                                            </td>
                                            <td>
                                               
                                                {{$user->email}}
                                            
                                            </td>
                                            <td>{{$payment->amount}}</td>
                                            <td>{{$payment->payment_method}}</td>
                                            <td>
                                                <?php
                                                    $payment_details = '';
                                                    if ($payment->payment_details != null){
                                                    $payment_details = json_decode($payment->payment_details);
                                                    }
                                                ?>
                                                @if ($payment->approved == 1)
                                                <span class="text-success">{{__('Approved')}}</span>
                                                @elseif ($payment_details != '')
                                                <span class="text-danger">{{__('Failed')}}</span>
                                                @else
                                                <span class="text-warning">{{__('Pending')}}</span>
                                                @endif
                                            </td>
                                            <td>{{date('d/m/Y',strtotime($payment->created_at))}}</td>
                                            <td>
                                                <div class="btn-group z-index-10">
                                                    <div class="pull-left d-inline-block dropdown">
                                                        <a href="#" aria-expanded="false" data-toggle="dropdown"
                                                            class="dropdown-toggle " type="button"> <i
                                                                class="zmdi zmdi-more-vert"></i></button>
                                                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a
                                                                        href="{{route('payment.show',['id'=>$payment->id])}}"><i
                                                                            class="zmdi zmdi-eye"></i><span>View</span></a>
                                                                </li>
                                                                @if ($payment->approved == 0)
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#approval{{$i}}"><i class="zmdi zmdi-check "></i><span>Approve</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#deactivate" data-toggle="modal" data-target="#cancelOrder{{$i}}"><i class="zmdi zmdi-close"></i><span>Cancel</span></a>
                                                                </li>
                                                                {{-- Approval modal --}}

                                                                <div class="modal fade" id="approval{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header border-bottom-0">

                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h2>Are you sure you want to approve this payment?</h2>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('payment.approve',['id'=>encrypt($payment->txn_code)])}}" class="btn btn-warning">Yes, Approve</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- Cancel modal --}}
                                                                <div class="modal fade" id="cancelOrder{{$i}}" tabindex="-1" role="dialog" aria-labelledby="cancelOrderLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header border-bottom-0">

                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h2>Are you sure you want to cancel this payment?</h2>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('payment.cancel',['id'=>encrypt($payment->id)])}}" class="btn btn-warning">Yes, Cancel Payment</a>
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
                                        @endif
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