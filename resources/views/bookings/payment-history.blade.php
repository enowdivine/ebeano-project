@extends('layouts.booking')

@section('title', 'Payment History')

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
            <div class="card-header bg-white ">
                    <h5>Payment Log
                        @if($gateway !== null)
                        <small class="text-muted">( {{$gateway->name}} )</small>
                            @endif
                    </h5>
                </div>
                <div class="card-body p-0">

                    <table class="table table-sm table-striped  table-hover order-column">
                        <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                User
                            </th>
                            @if($gateway === null)
                            <th>
                                Method
                            </th>
                            @endif
                            <th>
                                Type
                            </th>
                            <th>
                                Trx
                            </th>
                            <th class="text-right">
                                Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>
                                    {{$log->created_at}}
                                </td>
                                <td>
                                    <a href="{{route('guests.view',$log->user->id)}}">{{$log->user->username}}</a>
                                </td>
                                @if($gateway === null)
                                <td>
                                    {{$log->gateway->name}}
                                </td>
                                @endif
                                <td>
                                    {{$log->type}}
                                </td>
                                <td>
                                    {{$log->trx}}
                                </td>
                                <td class="text-right">
                                   {{general_setting()->cur_sym}} {{number_format($log->amount)}}
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5">No Log yet.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $logs->links() }}
                    </div>
                </div>
        </div>

</div>
</div>
@endsection
