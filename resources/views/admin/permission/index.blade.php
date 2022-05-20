@extends('layouts.app')

@section('content')

<div class="container-fluid">
				
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Role Permissions</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="eb-admin">Dashboard</a></li>
            <li><a href="eb-admin/staff"><span>Role</span></a></li>
            <li class="active"><span>Permissions</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->

    <div class="row">

        <div class="col-sm-6">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{url('eb-admin/staff/permissions/create')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Role Permission</h6>
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
                                            <th>Code</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $permissions = App\Permissions::all();
                                            $i = 0;
                                        @endphp
                                       @foreach ($permissions as $permission)
                                       @php $i += 1 @endphp
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$permission->name}}</td>
                                       <td>{{$permission->code}}</td>
                                       <td><a href="{{url('eb-admin/staff/permissions/edit/'.$permission->id)}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> 
                                        <a href="{{url('eb-admin/staff/permissions/delete/'.$permission->id)}}" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
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