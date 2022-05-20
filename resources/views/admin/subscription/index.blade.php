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
            <li><a href="/eb-admin">Dashboard</a></li>
            <li><a href="{{route('subscribers')}}"><span>Subscription</span></a></li>
            <li class="active"><span>Subscribers</span></li>
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

        <div class="col-sm-12">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{route('sub.subscribe')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Subscribed Vendors</h6>
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
                                            <th>Email</th>
                                            <th>type</th>
                                            <th>plan</th>
                                            <th>duration (No. of days)</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $active = false;
                                            $subscriptions = App\Subscription::all();
                                            $i = 0;
                                        @endphp
                                       @foreach ($subscriptions as $subscription)
                                       @php $i += 1 @endphp
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$subscription['user']['name']?? ''}}</td>
                                       <td>{{$subscription['user']['email']?? ''}}</td>
                                       <td>{{$subscription['user']['user_type'] ?? ''}}</td>
                                       <td>{{$subscription['subscription_plan']['name'] ?? ''}}</td>
                                       <td>{{$subscription['subscription_plan']['duration'] ?? ''}}</td>
                                       <td>{{date('d-m-Y',$subscription['expiration']-(90*24*60*60)) ?? ''}}</td>
                                       <td>{{date('d-m-Y',$subscription['expiration']) ?? ''}}</td>
                                       <td>
                                           @if ($subscription['active'] == 0)
                                           
                                                <span class="text-warning">Not Active</span>
                                           @else
                                           <span class="text-success">Active</span>
                                               @php
                                                $active = true;
                                               @endphp
                                           @endif
                                       </td>
                                       <td>
                                           
                                        <div class="btn-group z-index-10">
											<div class="pull-left d-inline-block dropdown">
												<a href="#" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle " type="button"> <i class="zmdi zmdi-more-vert"></i></a>
												<ul role="menu" class="dropdown-menu dropdown-menu-right">
												    @if (!$active)
                                                    <li>
                                                       <a href="#" onclick="confirm_modal('{{route('sub.activate',['id'=>encrypt($subscription['id'])])}}','Do You Want to Activate this Subscription?')" class="mr-25" data-toggle="tooltip" data-original-title="Activate"> <i class="fa fa-tick text-success m-r-10"></i><span>Activate</span></a>
                                                    </li>
                                                     @else
													<li>
                                                        <a href="#" onclick="confirm_modal('{{route('sub.cancel',['id'=>encrypt($subscription['id'])])}}','Do You Want to Cancel this Subscription?')" data-toggle="tooltip" data-original-title="Cancel"> <i class="zmdi zmdi-power-off text-danger"></i><span>Cancel</span></a>
													</li>
													@endif

													<li>
														<a href="#" onclick="confirm_modal('{{route('sub.delete',['id'=>encrypt($subscription['id'])])}}','Do You Want to Permanently Delete this Subscription?')"><i class="zmdi zmdi-close"></i><span>Delete</span></a>
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
