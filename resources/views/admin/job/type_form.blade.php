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
			<h5 class="txt-dark"> Artisan Job Type</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li><a href="{{url('eb-admin/artisans')}}">Artisan</a></li>
                <li><a href="{{url('eb-admin/jobs')}}">Job</a></li>
				<li class="active"><span>Type</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Type'):('Add Type')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($edit)?route('artisan_type.update',['id'=>encrypt($edit->id)]):route('artisan_type.store')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{!empty($edit->name)?$edit->name:('')}}">
                                </div>
    
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="desc">Description</label>
                                    <textarea id="desc" class="form-control" name="description" rows="5">{{!empty($edit->description)?$edit->description:('')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox checkbox-success checkbox-circle">
                                        <input id="checkbox-10" type="checkbox" name="featured" {{$edit->featured == 1?('checked'):('')}} value="1">
                                        <label for="checkbox-10">Featured</label>
                                    </div>
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