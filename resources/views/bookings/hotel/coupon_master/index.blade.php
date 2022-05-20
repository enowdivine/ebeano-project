@extends('layouts.booking')

@section('title', 'Coupon Master')

@section('content')
<div class="row">
    @php
       $name = Str::of(Auth::user()->name)->explode(' ');
       $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @include('bookings/partials/menuhome')
    </div>
    
    <div class="col-lg-9">
    <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-header bg-white">
                <h2>Coupon
                    <a class="btn btn-tsk float-right" href="{{route('coupon.create')}}"><i class="fa fa-plus"></i> Coupon Create</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($couponMasters as $key=>$couponMaster)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$couponMaster->offer_title}}</td>
                        <td>{{$couponMaster->code}}</td>
                        <td><span class="badge {{$couponMaster->status?'badge-success':'badge-danger'}}">{{$couponMaster->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('coupon.edit',$couponMaster->id)}}" class="btn btn-tsk"><i class="la la-pencil"></i> edit</a>

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
@endsection
