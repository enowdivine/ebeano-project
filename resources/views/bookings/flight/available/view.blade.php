@extends('layouts.booking')

@section('title', 'Recently Booked')

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
                <h2>Recently Booked

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>#</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{__('Flight Partner')}}</th>
                        <th>{{__('Flight From')}}</th>
                        <th>{{__('Flight To')}}</th>
                        <th>{{__('Trip Type')}}</th>
                        <th>{{__('Booked Seat')}}</th>
                        <th>{{__('Track ID')}}</th>
                        <th>{{__('Guest Details')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('Payment Method')}}</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($flights) > 0)
                        @foreach ($flights as $key => $flight)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($flight->created_at)) }}</td>
                                <td>{{ $flight->flight->name }}</td>
                                <td>{{ $flight->flight_available->from }}</td>
                                <td>{{ $flight->flight_available->to }}</td>
                                <td>{{ $flight->flight_available->trip_type }}</td>
                                <td>{{ $flight->booked_seat }}</td>
                                <td>{{ $flight->booking_id }}</td>
                                <td>{{ $flight->guest_details }}</td>
                                <td>{{ single_price($flight->price) }}</td>
                                <td>Wallet</td>
                                <td>
                                    @if($flight->status == 0)
                                        <span class="badge badge-warning">pending</span>
                                    @else
                                        <span class="badge badge-success">success</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('flight.flight-booked-view',$flight->id)}}" class="btn btn-outline-tsk"><i class="fa fa-book"></i> </a>
        
        
                                     </div>
        
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center pt-5 h4" colspan="100%">
                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                            <span class="d-block">{{ __('No history found.') }}</span>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="pagination-center">
                {{ $flights->links() }}
            </div>
        </div>

</div>
</div>
@endsection
