@extends('layouts.booking')

@section('title', 'Reservations')

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
    
    <div class="card" style="margin-top:20px">
        <div class="card-header bg-white float-right">
            <h2>Reservation

                <a class="btn btn-tsk float-md-right" href="{{route('reservation.create')}}"><i class="fa fa-plus"></i> Add Reservation</a>
                <div class="btn-group float-md-right mr-2">
                    <a class="btn btn-outline-secondary {{active_menu([route('booking.dashboard')],'active')}}" href="{{route('booking.dashboard')}}">All</a>
                    <a class="btn btn-outline-secondary {{active_menu([route('booking.dashboard','online')],'active')}}" href="{{route('booking.dashboard','online')}}">Online</a>
                    <a class="btn btn-outline-secondary {{active_menu([route('booking.dashboard','offline')],'active')}}" href="{{route('booking.dashboard','offline')}}">Offline</a>
                </div>
            </h2>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-sm table-condensed mb-0">
                <thead class="bg-tsk-o-1">
                <tr>

                    <th>Reservation Number</th>
                    <th>Reservation Date</th>
                    <th>Guest</th>
                    <th>Room Type</th>
                    <th>Check in</th>
                    <th>Check out</th>
                    <th>Booking Type</th>
                    <th class="text-center">Payment Status</th>
                    <th class="text-center">Reservation Status</th>
                    <th class="text-right" style="width: 50px">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reservations as $key=>$reservation)
                <tr>

                    <td>{{$reservation->uid}}</td>
                    <td>{{$reservation->date}}</td>
                    <td><a href="{{route('guests.view',$reservation->guest->id)}}">{{$reservation->guest->username}}</a></td>
                    <td>{{$reservation->roomType->title}}</td>
                    <td>{{$reservation->check_in}}</td>
                    <td>{{$reservation->check_out}}</td>
                    <td>{{$reservation->online?'Online':'Offline'}}</td>
                    <td class="text-center"><span class="badge badge-{{$reservation->paymentStatus()['color']}}">{{$reservation->paymentStatus()['status']}}</span></td>
                    <td class="text-center"><span class="badge badge-{{$reservation->statusClass()}}">{{$reservation->status === 'ONLINE_PENDING'?'PENDING':$reservation->status}}</span></td>
                    <td class="text-right">
                        <div class="btn-group btn-group-sm">
                            <a href="{{route('reservation.view',$reservation->id)}}" class="btn btn-tsk"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </td>
                </tr>
                    @empty

                    <tr>
                        <td colspan="10">No Reservation</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-center ml-2">
                {{$reservations->links()}}
            </div>
        </div>
    </div>
    
</div>
</div>
@endsection

