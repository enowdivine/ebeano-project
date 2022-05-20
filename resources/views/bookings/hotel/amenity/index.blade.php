@extends('layouts.booking')

@section('title', 'Amenities')

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
                <h2>Amenities
                    <a class="btn btn-tsk float-right" href="{{route('amenities.create')}}"><i class="fa fa-plus"></i>  Add Amenities</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($amenities as $amenity)
                    <tr>
                        <td>{{$amenity->name}}</td>
                        <td>{{$amenity->description}}</td>
                        <td><span class="badge {{$amenity->status?'badge-success':'badge-danger'}}">{{$amenity->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('amenities.edit',$amenity->id)}}" class="btn btn-tsk"><i class="la la-pencil"></i> Edit</a>
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
