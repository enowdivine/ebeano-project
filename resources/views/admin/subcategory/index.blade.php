@extends('layouts.app')

@section('content')

<div class="container-fluid">
				
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Sub-Category</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="eb-admin">Dashboard</a></li>

            <li class="active"><span>Sub-Categories</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
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

    <div class="row">

        <div class="col-sm-8">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{url('eb-admin/subcategories/create')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Sub-Categories</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_g_1" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subcategories = App\SubCategory::all();
                                            $i = 0;
                                        @endphp
                                       @foreach ($subcategories as $key => $subcategory)
                                       @php $i += 1 @endphp
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$subcategory->name ?? ''}}</td>
                                       <td>{{$subcategory['category']['name'] ?? ''}} </td>
                                       <td><a href="{{url('eb-admin/subcategories/edit/'.encrypt($subcategory->id))}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> 
                                        <a href="{{url('eb-admin/subcategories/delete/'.encrypt($subcategory->id))}}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
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