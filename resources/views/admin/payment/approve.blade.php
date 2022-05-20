@extends('layouts.app')

@section('content')
@php
	if (session()->get('data')){
            $edit = session()->get('data');
        }
@endphp

<div class="container-fluid">

	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Payments</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
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
			<div class="alert alert-info">
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
    <!-- /Row -->

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{('Verify And Approve Payment')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('payment.verify')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="ref">Transaction Reference Code(enter email for cash payment)</label>
                                    <input id="ref" type="text" class="form-control" name="reference" value="{{!empty($edit->reference)?$edit->reference:''}}" >
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="pay_m">Payment Method</label>                                   
                                      <select class="form-control" name="payment_method" id="pay_m" onchange="cashDetails()">
                                        
                                        <option value="paystack" {{(!empty($edit->payment_method) && $edit->payment_method == 'paystack') ? 'selected' : ''}}>Paystack</option>  
                                        <option value="interswitch" {{(!empty($edit->payment_method) && $edit->payment_method == 'interswitch')?'selected':''}}>Interswitch</option>
                                        <option value="cash" {{(!empty($edit->payment_method) && $edit->payment_method == 'cash')?'selected':''}}>Cash</option>
                                        
                                      </select>
                                    
                                </div>
                                <div id= "cash-details" class="d-none">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="amt">Amount</label>
                                        <input id="amt" type="text" class="form-control" name="amount" value="{{!empty($edit->amount)?$edit->amount:''}}" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="pay_info">Payment Details (you can input your name, amount,etc)</label>
                                        <textarea id="pay_info" class="form-control" name="payment_info">{{!empty($edit->payment_info)?$edit->payment_info:''}}</textarea>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="pay_m">Payment Type</label>                                   
                                      <select class="form-control" name="payment_type" id="pay_m">
                                        
                                        <option value="sub_payment" {{(!empty($edit->payment_type) && $edit->payment_type == 'sub_payment')?'selected':''}}>Subscription</option>  
                                        <option value="wallet_payment" {{(!empty($edit->payment_type) && $edit->payment_type == 'wallet_payment')?'selected':''}}>Wallet Top Up</option>   
                                        <option value="order_payment" {{(!empty($edit->payment_type) && $edit->payment_type == 'order_payment')?'selected':''}}>Order</option>
                                        <option value="job_payment" {{(!empty($edit->payment_type) && $edit->payment_type == 'job_payment')?'selected':''}}>Artisan Job</option>
                                      </select>
                                    
                                </div>
                                
                                <input type="submit" name="save" class="btn btn-success btn-anim" value="Verify and Approve">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    @section('script')
    
    <script>
        function cashDetails(){
            pay_m = $("#pay_m").val();
            if (pay_m == 'cash'){
                $("#cash-details").toggleClass("d-none")
            }
        }
    </script>
    @endsection