@extends('layouts.theme')

@section('title', 'Dashboard')

@section('content')
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @if(Auth::user()->user_type == 'seller' || Auth::user()->user_type == 'admin')
        @include('inc.seller_nav')
    @elseif(Auth::user()->user_type == 'user')
        @include('inc.customer_nav')
    @endif

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Account Overview</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card rounded mb-4">
                            <div class="card-title d-flex mb-0 border-bottom p-2 justify-content-between">
                                <h5 class=" font-weight-light ">My Personal Details</h5>
                            <a href="{{route('user.edit_profile')}}" class="btn btn-sm btn-default"><i class="la link la-edit">Update Profile</i></a>
                            </div>
                            <div class="card-body">
                            <h6 class="m-0">{{Auth::user()->name}}</h6>
                            <p class="d-block">{{Auth::user()->email}}</p>
                            <p class="d-block">{{Auth::user()->address}}</p>
                            <p class="d-block">{{Auth::user()->state}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card wallet rounded mb-4">
                            <div class="card-title mb-0  border-bottom p-2 d-flex justify-content-between">
                                <h5 class=" font-weight-light">Wallet Balance</h5>
                                
                            </div>
                            <div class="card-body">
                                <div class="font-weight-bold text-center text-primary amt">
                                <span class="la la-wallet"></span>    ₦ {{number_format(Auth::user()->balance,2)}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class=" card rounded mb-4">
                            <div class="card-title mb-0 border-bottom p-2 d-flex justify-content-between">
                                <h5 class=" font-weight-light">Address</h5>
                                <button class="btn btn-sm"><i class="la link la-edit"></i></button>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>

</div>
@endsection