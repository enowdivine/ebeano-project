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
			<h5 class="txt-dark">Shipping</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
				<li class="active"><span>Shipping Rates</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Shipping Rate'):('Add Shipping Rate')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($edit)?route('shipping.update',['id'=>$edit->id]):route('shipping.add')}}" method="POST" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="name">Rate (NGN)</label>
                                    <input id="rate" type="text" class="form-control" name="rate" value="{{!empty($edit->rate)?$edit->rate:('')}}">
                                </div>
    

                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="zone"> Zone </label>
                                  <select class="form-control" name="zone" id="zone">
                                    
                                    <option value="1" {{(!empty($edit->zone) && $edit->zone == 1)?'selected':''}}>Zone 1</option>  
                                    <option value="2" {{(!empty($edit->zone) && $edit->zone == 2)?'selected':''}}>Zone 2</option>   
                                    <option value="3" {{(!empty($edit->zone) && $edit->zone == 3)?'selected':''}}>Zone 3</option>
                                    <option value="4" {{(!empty($edit->zone) && $edit->zone == 4)?'selected':''}}>Zone 4</option>
                                  </select>
                                </div>
    
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="min-weight">Min. Weight (kg)</label>
                                    <input id="min-weight" class="form-control" name="min_weight" value="{{!empty($edit->min_weight)?$edit->min_weight:('')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="max-weight">Max. Weight (kg)</label>
                                    <input id="max-weight" class="form-control" name="max_weight" value="{{!empty($edit->max_weight)?$edit->max_weight:('')}}">
                                </div>
                                
                                <input type="submit" name="save" class="btn btn-success btn-anim" value="{{isset($edit)?('update'):('add')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection