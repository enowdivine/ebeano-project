@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Staff Roles</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
            <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li><a href="{{url('eb-admin/staff')}}"><span>Staff</span></a></li>
                <li class="active"><span>Roles</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Role'):('Add Role')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{isset($edit)?url('eb-admin/staff/roles/update/'.$edit->id):('save')}}" method="POST" >
                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="name">Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{!empty($edit->name)?$edit->name:('')}}" id="name">
                                </div>
                                <div class="mt-10">
                                <h6 class="panel-title txt-dark mb-20">Permission</h6>
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($permissions as $permission)
                                @php
                                    $check = '';
                                    $i++;
                                        if(isset($edit)){
                                            
                                            $array = json_decode($edit->permissions);
                                            if (in_array($permission->code,$array )) {
                                                $check = 'checked';
                                        
                                            }
                                        }
                                    
                                @endphp
                               
                                    <div class="checkbox ml-20 mb-10">
                                    <input id="checkbox{{$i}}" name="permissions[]" type="checkbox" value="{{$permission->code}}" {{$check}}>
                                        <label for="checkbox{{$i}}"> {{$permission->name}}</label>
                                    </div>
                                @endforeach
                                
                                <div class="form-group mt-20 mb-0">
                                    <input type="submit" name="add" class="btn btn-sm btn-success btn-anim" value="{{isset($edit)?('update'):('add')}}">
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