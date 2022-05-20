@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Markets</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li><a href="{{route('market.index')}}">Markets</a></li>
                <li class="active"><span>{{isset($edit)?('Edit Market'):('Add Market')}}</span></li>
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
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Market'):('Add Market')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
               


                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        
                        <div class="form-wrap">
                        <form class="" action="{{isset($edit)?route('market.update',['id'=>encrypt($edit->id)]):route('market.store')}}" method="POST" enctype="multipart/form-data" >
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{!empty($edit->name)?$edit->name:('')}}" id="name">
                                </div>

    
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="desc">Description</label>
                                    <textarea id="desc" class="form-control" name="description" rows="5">{{!empty($edit->description)?$edit->description:('')}}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="address">Address</label>
                                    <input id="address" type="text" class="form-control" name="address" value="{{!empty($edit->address)?$edit->address:('')}}" >
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="city">City</label>
                                    <input id="city" type="text" class="form-control" name="city" value="{{!empty($edit->city)?$edit->city:('')}}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="nearestBusStop">Nearest Bus Stop</label>
                                    <input id="nearestBusStop" type="text" class="form-control" name="nearest_bus_stop" value="{{!empty($edit->nearest_bus_stop)?$edit->nearest_bus_stop:('')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label">{{__('Select your state')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="state" required>
                                        @foreach (\App\State::all() as $key => $state)
                                        <option value="{{ $state->state_id }}" @if ($state->state_id == ($edit->state_id ?? '')) selected
                                            @endif>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{__('Select your country')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="country" required>
                                        @foreach (\App\Country::all() as $key => $country)
                                        <option value="{{ $country->id }}" @if ($country->id == ($edit->country_id ?? ''))
                                            selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="workingHours">Working Hours</label>
                                    <input id="workinHours" type="text" class="form-control" name="working_hours" value="{{!empty($edit->working_hours)?$edit->working_hours:('')}}" placeholder="e.g: Monday - Friday, 7am - 5pm" required>
                                </div>
                                @if(isset($edit))
                                <div class="form-group">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" class="form-control" id="password_1" name="approved" value="1" {{$edit->approved == 1 ? 'checked' :('')}} >
                                        <label class="control-label mb-10" for="password_1">Approved</label>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group mb-0">
                                    <input type="submit" name="save" class="btn btn-success btn-anim" value="{{isset($edit)?('update'):('add')}}">
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