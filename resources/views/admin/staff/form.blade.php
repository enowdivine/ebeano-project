@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Staff</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li class="active"><span>Staff</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm-6">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        @if(Session::has('error'))
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
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Staff'):('Add Staff')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
               


                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        
                        <div class="form-wrap">
                        <form class="" action="{{isset($edit)?url('eb-admin/staff/update/'.$edit->id):('register-staff')}}" method="POST" >
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group mb-10">
                                    <label class="control-label mb-10" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{!empty($edit->user->name)?$edit->user->name:('')}}" id="name">
                                </div>
                                <div class="form-group mb-10">
                                    <label class="control-label mb-10" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{!empty($edit->user->email)?$edit->user->email:('')}}" id="email">
                                </div>
                                <div class="form-group mb-10">
                                    <label class="control-label mb-10" for="phone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" value="{{!empty($edit->user->phone)?$edit->user->phone:('')}}" id="phone">
                                </div>
                                <div class="form-group mb-10">
                                    <label class="control-label mb-10" for="pass">Password</label>
                                    <input type="password" name="password" class="form-control" value="{{!empty($edit->user->password)?'':('123456')}}" id="pass" placeholder="leave it blank for default">
                                </div>
                                <div class="form-group mb-20">
                                    <label class="control-label mb-10" for="role">Role</label>
                                    <div class="btn-group bootstrap-select dropup">
                                       
                                            <select class="selectpicker" name="role" id="role" data-style="btn-default btn-outline" tabindex="-98">
                                        @php
                                            $roles = App\Role::all();
                                        @endphp
                                       @foreach ($roles as $role)
                                    <option data-tokens="" value="{{$role->id}}" {{($edit->role_id ?? '' ==$role->id)?'selected':''}}>{{$role->name}}</option>
                                       @endforeach
                                    </select></div>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" name="add" class="btn btn-success btn-anim" value="{{isset($edit)?('update'):('add')}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
@endsection