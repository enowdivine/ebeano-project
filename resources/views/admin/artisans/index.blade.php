@extends('layouts.app')

@section('content')

<div class="container-fluid">
				
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Manage artisan</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="eb-admin">Dashboard</a></li>
            <li class="active"><span>Artisan list</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->

    <div class="row">

        <div class="col-sm-12">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{route('artisan.add')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">artisan list</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="">
                                <table id="datable_g_1" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Verification status</th>
                                            <th>Approval</th>
                                            <th>Registered by</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $artisans = App\Artisan::all();
                                            
                                            if (Auth::user()->user_type == 'staff'){

                                                $artisans = App\artisan::where('registered_by', Auth::user()->id);
                                            }
                                            
                                            $i = 0;
                                        @endphp
                                       @foreach ($artisans as $key => $artisan)
                                       @php $i += 1 @endphp
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$artisan->user->name}}</td>
                                       <td>{{$artisan->user->email}}</td>
                                       <td>{{$artisan->user->phone}}</td>
                                       <td><span class="text-info">{{$artisan->verification_info}}</span></td>
                                       <td>
                                            @if($artisan->verification_status == 1)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <a href="{{route('artisan.approve',['id'=>encrypt($artisan->id)])}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Approve"> <i class="fa fa-check"></i> </a>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                if ($reg_by=App\User::where('id', $artisan->registered_by)){

                                                    if (!empty($reg_by->name)){
                                                        echo $reg_by->name;
                                                    }else {
                                                        echo "Admin";
                                                    }
                                                    
                                                }
                                            @endphp
                                        </td>
                                       <td>
                                        <div class="btn-group z-index-10">
											<div class="pull-left d-inline-block dropdown">
												<a href="#" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle " type="button"> <i class="zmdi zmdi-more-vert"></i></button>
												<ul role="menu" class="dropdown-menu dropdown-menu-right">
													<li>
														<a href="{{route('artisan.edit',['id'=>encrypt($artisan->id)])}}"><i class="zmdi zmdi-edit"></i><span>Edit</span></a>
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

@endsection