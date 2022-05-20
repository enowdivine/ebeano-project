@extends('layouts.app')

@section('content')
@php
$data = App\Seller::find($id)
@endphp
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Sellers</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li><a href="{{url('eb-admin/sellers')}}">Seller</a></li>
                <li class="active"><span>Edit</span></li>
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

    <!-- Row -->
    <div class="row">
        <div class="col-sm-6">
            <form action="{{route('seller.update.info', ['id' => $data->id])}}" method="POST">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Seller Information</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-user"></i></div>
                                    <input type="text" class="form-control required" name="name" id="exampleInputuname"
                                        placeholder="Full Name" value="{{ ($data->user->name) ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-envelope-open"></i>
                                    </div>
                                    <input type="email" class="form-control required" id="exampleInputEmail"
                                        name="email" placeholder="Email address" value="{{$data->user->email ?? ''}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-phone"></i></div>
                                    <input id="phone" type="tel" class="form-control required" name="phone"
                                        placeholder="+2348000000000" value="{{$data->user->phone ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-location-pin"></i>
                                    </div>
                                    <input type="text" class="form-control required" name="address"
                                        id="exampleInputAddress" placeholder="Address of residence"
                                        value="{{$data->user->address ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-tag"></i></div>
                                    <input type="text" class="form-control required" name="city" id="exampleInputCity"
                                        placeholder="City" value="{{$data->user->city ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-location-pin"></i>
                                    </div>
                                    <select id="exampleState" class="form-control required" name="state">
                                        <option value=""> Select state</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state->state_id}}"
                                            {{($data->user->state_id == $state->state_id)?'selected':''}}>
                                            {{$state->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-location-pin"></i>
                                    </div>
                                    <select id="exampleCountry" class="form-control required" name="country">
                                        <option value=""> Select country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}"
                                            {{($data->user->country_id == $country->id)?'selected':''}}>
                                            {{$country->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" class="form-control" id="password_1" name="pwd_reset" value="1">
                                    <label class="control-label mb-10" for="password_1">Reset Password</label>
                                </div>
                            </div>

                        <input type="submit" class="btn btn-sm btn-success btn-anim" name="regiseter" value="Update" />
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-6">
            <form action="{{route('seller.update.bank',['id' => $data->id])}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Bank Details</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label mb-10" for="bank">Bank:</label>
                            <select id="bank" name="bank_name" class="form-control required">
                                @foreach ($banks as $bank)
                                <option value="{{$bank->id}}" {{($data->bank_name == $bank->id)?'selected':''}}>
                                    {{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="accNo">Account Number:</label>
                            <input type="text" id="accNo" class="form-control required" name="bank_account_no"
                                value="{{$data->bank_acc_no ?? '' }}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="accName">Account Name:</label>
                            <input type="text" id="accName" class="form-control  required" name="bank_account_name"
                                value="{{$data->bank_acc_name ?? '' }}" />
                        </div>
                        <input type="submit" class="btn btn-sm btn-success btn-anim" name="regiseter" value="Update" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Row -->
</div>

@endsection