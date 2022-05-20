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
            <h2>Create Reservation
                <a class="btn btn-tsk float-right" href="{{route('flight.flight-available')}}"><i class="fa fa-list"></i> Available List</a>

            </h2>
        </div>
        
        <div class="card-body">
            <form action="{{route('flight.create-available-post')}}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label><strong>Trip Title</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Select Flight</strong> <small class="text-danger">*</small></label>
                    <select  class="form-control form-control-lg" name="flight" >
                        @foreach($flights as $flight)
                        <option value="{{$flight->id}}">{{$flight->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label><strong>Trip From</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="trip_from" placeholder="Trip From" value="{{old('trip_from')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Trip To</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="trip_to" placeholder="Trip To" value="{{old('trip_to')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Flight Take Off</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="takeoff" id="takeoff" value="{{old('takeoff', date('Y/m/d H:i:s A'))}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Trip Type</strong> <small class="text-danger">*</small></label>
                    <select  class="form-control form-control-lg" name="trip_type" required>
                        <option value="round">Round trip</option>
                        <option value="oneway">One-way trip</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Available Seats</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="available_seat" placeholder="Available Seats" value="{{old('available_seat')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Price Per Seat</strong> <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-lg" name="price_seat" placeholder="Price Per Seat" value="{{old('price_seat')}}" required>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-12">
                    <label><strong>Description</strong><small> (optional)</small> </label>
                    <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{old('description')}}</textarea>
                </div>
            </div>
            
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <hr/>
                        <button type="submit" class="btn btn-lg mt-4 btn-tsk btn-block"><i class="fa fa-save"></i> Create</button>
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