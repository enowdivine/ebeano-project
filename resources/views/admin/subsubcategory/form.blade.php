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
			<h5 class="txt-dark">Sub Sub-categories</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
				<li class="active"><span>Sub Sub-categories</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Sub-Sub-category'):('Add Sub-Sub-category')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($edit)?route('subsubcategory.update', ['id'=>$edit->id]):route('subsubcategory.add')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{!empty($edit->name)?$edit->name:''}}" >
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="sub_category">Sub Category</label>                                   
                                      <select class="form-control" name="subcategory" id="sub_category">
                                          @foreach ($subcategories as $subcategory)
                                      <option value="{{$subcategory->id}}" {{(!empty($edit->subcategory_id) && $edit->subcategory_id == $subcategory->id)?'selected':''}}>{{$subcategory->name}}</option>  
                                          @endforeach
                                        
                                      </select>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="metaTitle">Meta title</label>
                                    <input id="metaTitle" type="text" class="form-control" name="meta_title" value="{{!empty($edit->meta_title)?$edit->meta_title:('')}}">
                                </div>
    
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="desc">Description</label>
                                    <textarea id="desc" class="form-control" name="description" rows="5">{{!empty($edit->meta_description)?$edit->meta_description:('')}}</textarea>
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