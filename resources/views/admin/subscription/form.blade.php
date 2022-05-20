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
			<h5 class="txt-dark">Subscription Plan</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
				<li class="active"><span>Subscription Plan</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Subscription Plan'):('Add Subscription Plan')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($edit)?route('sub.update_plan', ['id'=>encrypt($edit->id)]):route('sub.store_plan')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name"  value="{{!empty($edit->name)?$edit->name:('')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="price">Price</label>
                                    <input id="price" type="text" class="form-control" name="price"  value="{{!empty($edit->price)?$edit->price:''}}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="price">Plan Code</label>
                                    <input id="code" type="text" class="form-control" name="code"  value="{{!empty($edit->code)?$edit->code:''}}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="duration">Duration (no of days)</label>
                                    <input id="duration" type="text" class="form-control" name="duration"  value="{{!empty($edit->duration)?$edit->duration:''}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="plan">Plan Category</label>                                   
                                      <select class="form-control" name="category" id="category">
                                          
                                        <option value="seller" {{(!empty($edit->category) && $edit->category == 'seller')?'selected':''}}>Seller</option>  
                                         
                                        <option value="artisan" {{(!empty($edit->category) && $edit->category == 'artisan')?'selected':''}}>Artisan</option>
                                        <option value="hotelier" {{(!empty($edit->category) && $edit->category == 'hotelier')?'selected':''}}>Hotelier</option>
                                        <option value="agent" {{(!empty($edit->category) && $edit->category == 'agent')?'selected':''}}>Agent</option>
                                        <option value="school" {{(!empty($edit->category) && $edit->category == 'school')?'selected':''}}>School</option>
                                      </select>
                                    
                                </div>
                                <h4>Extra Features</h4>
                                <div class="checkbox ml-20 mb-10">
                                    <input id="checkbox1" name="special_offers[]" type="checkbox" value="top-seller">
                                    <label for="checkbox1">Top Seller</label>
                                </div>
                                <div class="checkbox ml-20 mb-10">
                                    <input id="checkbox2" name="special_offers[]" type="checkbox" value="first-page">
                                    <label for="checkbox2">First Page</label>
                                </div>
                                <div class="checkbox ml-20 mb-10">
                                    <input id="checkbox1" name="special_offers[]" type="checkbox" value="product-management">
                                    <label for="checkbox1">We Manage Your Product</label>
                                </div>
                                
                                <input type="submit" name="save" class="btn btn-success btn-anim" value="{{isset($edit)?('Update'):('Add')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection