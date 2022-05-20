@extends('layouts.app')

@section('content')

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
				<li class="active"><span>View</span></li>
			</ol>
		</div>
		<!-- /Breadcrumb -->
	</div>

	<!-- /Title -->
    <!-- /Title -->

    <!-- Row -->
	<div class="row">
		<div class="col-sm-8">
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
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Jobs</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
</div>
    
@endsection