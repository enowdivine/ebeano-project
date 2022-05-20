@extends('layouts.app')

@section('content')
@php
	if (session()->get('data')){
            $data = session()->get('data');
        }
@endphp
<div class="container-fluid">

	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Subscribe A User</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
				<li class="active"><span>Subscribe A User</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($upgrade)?('Ugrade User Subscription'):('Add Subscription To User')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($upgrade)?route('sub.upgrade', ['id'=>encrypt($upgrade->id)]):route('sub.store')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="name">User Email</label>
                                    <input id="email" type="email" class="form-control" name="user"  value="{{!empty($upgrade->user)?$upgrade->user:('')}}">
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="plan">Subscription Plan</label>                                   
                                      <select class="form-control" name="plan" id="plan">
                                          @php 
                                            $plans = App\SubscriptionPlan::all();
                                          @endphp
                                          @foreach ($plans as $plan)
                                      <option value="{{$plan->id}}" {{(!empty($upgrade->plan_id) && $upgrade->plan_id == $plan->id)?'selected':''}}>{{$plan->name.' ('.$plan->price.' - '.$plan->duration.' days)'}}</option>  
                                          @endforeach
                                        
                                      </select>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="date">Subscription Date</label>
                                    <input id="date" type="date" class="form-control" name="sub_date">
                                </div>
     
                                
                                <input type="submit" name="save" class="btn btn-success btn-anim" value="{{isset($upgrade)?('Upgrade'):('Add')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection