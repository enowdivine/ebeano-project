@extends('layouts.booking')

@section('title', 'Room')

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
                <h2>Create Room
                    <a class="btn btn-tsk float-right" href="{{route('room.create')}}"><i class="fa fa-plus"></i> Add Room</a>

                </h2>
            </div>
            <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th width="150px">Room Number</th>
                        <th>Room Type</th>
                        <th>Floor Number</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $key=>$room)
                        <tr>
                            <td class="text-center">{{$room->number}}</td>
                           <td>{{$room->type->title}}</td>
                            <td>{{$room->floor->number}}</td>
                            <td><span class="badge {{$room->status?'badge-success':'badge-danger'}}">{{$room->status?'Active':'Inactive'}}</span></td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('room.edit',$room->id)}}" class="btn btn-tsk"><i class="la la-pencil"></i> edit</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            </div>
            <div class="pagination-center">
                {{ $rooms->links() }}
            </div>
        </div>

</div>
</div>
@endsection
