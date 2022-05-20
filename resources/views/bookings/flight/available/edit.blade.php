@extends('layouts.booking')

@section('title', 'Reservations')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/booking/assets/backend/css/custom_page.css')}}">
@endsection
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
            <h2>Edit
                <a class="btn btn-tsk float-right" href="{{route('flight.flight-available')}}"><i class="fa fa-list"></i> Available List</a>

            </h2>
        </div>
        
        <div class="card-body">
            <form action="{{route('flight.flight-available-edit',$flight->id)}}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label><strong>Trip Title</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{$flight->title}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Select Flight</strong> <small class="text-danger">*</small></label>
                    <select  class="form-control form-control-lg" name="flight" >
                        @foreach($flights as $flightt)
                        <option value="{{$flightt->id}}" @if($flightt->id== $flight->flight_id) selected @endif>{{$flightt->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label><strong>Trip From</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="trip_from" placeholder="Trip From" value="{{$flight->from}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Trip To</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="trip_to" placeholder="Trip To" value="{{$flight->to}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Flight Take Off</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="takeoff" id="takeoff" value="{{$flight->flight_takeoff}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Trip Type</strong> <small class="text-danger">*</small></label>
                    <select  class="form-control form-control-lg" name="trip_type" required>
                        <option value="round" @if($flight->trip_type =='round') selected @endif>Round trip</option>
                        <option value="oneway" @if($flight->trip_type =='oneway') selected @endif>One-way trip</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Available Seats</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="available_seat" placeholder="Available Seats" value="{{$flight->available_seats}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Price Per Seat</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="price_seat" placeholder="Price Per Seat" value="{{$flight->price_per_seat}}" required>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-12">
                    <label><strong>Description</strong><small> (optional)</small> </label>
                    <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{$flight->content}}</textarea>
                </div>
            </div>
            
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <hr/>
                        <button type="submit" class="btn btn-lg mt-4 btn-tsk btn-block"><i class="fa fa-edit"></i> Edit</button>
                    </div>
                </div>
            </form>
        </div>
            
        </div>
    </div>

</div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#takeoff').datetimepicker({
                uiLibrary: 'bootstrap4',
                //format: 'yyyy/mm/dd',
                footer: true, modal: true
            });
        });
    </script>
@endsection