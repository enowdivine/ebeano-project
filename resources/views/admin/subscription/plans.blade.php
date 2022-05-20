@extends('layouts.app')

@section('content')

<div class="container-fluid">
				
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Subscriptions</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="eb-admin">Dashboard</a></li>
            <li><a href="eb-admin/staff"><span>Subscription</span></a></li>
            <li class="active"><span>Plans</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->
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

    <div class="row">

        <div class="col-sm-9">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{route('sub.create_plan')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-9">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Subscription Plans/Packages</h6>
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
                                            <th>Price</th>
                                            <th>Code</th>
                                            <th>duration</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $active = false;
                                            $plans = App\SubscriptionPlan::all();
                                            $i = 0;
                                        @endphp
                                       @foreach ($plans as $plan)
                                       @php $i += 1 @endphp
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$plan->name ?? ''}}</td>
                                       <td>{{number_format($plan->price,2) ?? ''}}</td>
                                       <td>{{$plan->code ?? ''}}</td>
                                       <td>{{$plan->duration ?? ''}}</td>
                                       <td>
                                           
                                        <div class="btn-group z-index-10">
											<div class="pull-left d-inline-block dropdown">
												<a href="#" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle " type="button"> <i class="zmdi zmdi-more-vert"></i></a>
												<ul role="menu" class="dropdown-menu dropdown-menu-right">

													<li>
                                                        <a href="{{route('sub.edit_plan',['id'=>encrypt($plan->id)])}}"  data-toggle="tooltip" data-original-title="Edit"> <i class="zmdi zmdi-pencil text-warning"></i><span>Edit</span></a>
													</li>

													<li>
														<a href="#" onclick="confirm_modal('{{route('sub.delete_plan',['id'=>encrypt($plan['id'])])}}','Do You Want to Permanently Delete this Plan?')"><i class="zmdi zmdi-close"></i><span>Delete</span></a>
													</li>
													
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

<script>
    function confirm_modal(url,msg)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_msg').innerHTML= msg;
        document.getElementById('link').setAttribute('href' , url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <h4 class="modal-title" id="myModalLabel">{{__('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p class="font-weight-bold text-center" id="delete_msg"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                <a id="link" class="btn btn-danger btn-ok">{{__('Continue')}}</a>
            </div>
        </div>
    </div>
</div>
    
@endsection
