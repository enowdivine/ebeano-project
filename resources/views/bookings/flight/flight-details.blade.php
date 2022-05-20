@extends('layouts.booking')

@section('title', 'Flight Details')

@section('content')
<style>

.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}

.booking-form {
  
}

.booking-form input, .booking-form select {
    width: 100%;
    border: 1px solid #CCCCCC;
    height: 50px;
    border-radius: 4px;
    text-indent: 10px;
    margin-bottom: 20px;
    transition: .4s;
}

.booking-form input:focus, .booking-form select:focus {
    border: 1px solid #fb2f61;
}


.booking-form button {
    font-size: 16px;
    font-weight: 400;
    padding: 12px 36px;
    letter-spacing: .3px;
    border-radius: 4px;
    display: inline-block;
    color: #fff !important;
    cursor: pointer;
}

.booking-form button:hover {
    
}


.slider-wrapper {
  width: auto;
}

.slider-for__item img {
  width: 100%;
}

.slider-nav__item {
  
}

.slick-slide {
  margin-bottom: 30px;
}
.room-gallery .slick-track {
    display: inline-block;
}
.price-tag, .booking-form {
    padding: 30px 25px;
}
</style>
<!--Room Details Area-->
    <section class="room-details-area section-padding pb-60" style="margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="room-gallery card card-inverse card-info wow fadeInUp" data-wow-delay="0.3s">
                        <div class="slider-wrapper">
                            <div class="slider-for">
                                <div class="slider-for__item ex1" data-src="{{asset('assets/booking/assets/backend/image/flight/'.optional($flight->flight)->img)}}">
                                    <img src="{{asset('assets/booking/assets/backend/image/flight/'.optional($flight->flight)->img)}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="room-details-content card card-inverse card-info wow fadeInUp" data-wow-delay="0.4s" style="padding:20px">
                        <h2 class="cl-black"><a href="" class="cl-black">{{$flight->title}}</a></h2>
                       {{ $flight->description }}
                        <div class="row mb-40">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-40">
                                <ul>
                                    <li><i class="fa fa-check"></i> {{$flight->flight->name}}</li>
                                    <li><i class="fa fa-check"></i> Available seats: {{ Str::limit($flight->available_seats,100) }}</li>
                                    <li><i class="fa fa-check"></i> Trip: {{ Str::limit($flight->trip_type,100) }}</li>
                                    <li><i class="fa fa-clock"></i> Take-off: {{ date('d/M/Y H:i:s A', strtotime($flight->flight_takeoff)) }}</li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="page-sidebar">
                        <div class="bg-base price-tag pb-2 pt-3">
                           <h3 style="color:white">Price</h3>
                        </div>
                        <div class="border-base bg-light price-tag  mb-2">
                            <h4>{{ single_price($flight->price_per_seat) }}<span>/Seat</span></h4>
                        </div>
                        <div class="bg-base price-tag pb-2 pt-3">
                            <h3 class="mb-2" style="color:white">Booking</h3>
                        </div>
                        <div class="border-base booking-form  bg-light">

                            <form action="{{route('book.flight',$flight->id)}}" method="post" id="booking_form">@csrf
                                <input type="text" name="name" placeholder="Name*" value="{{old('name')}}" required >
                                <input type="email" name="email" placeholder="Email*" value="{{old('email')}}" required >
                                <input type="text" name="phone" placeholder="Phone number*" value="{{old('phone')}}" required >
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Travellers* <span class="text-info">( {{$flight->available_seats}}/seats )</span></small> </label>
                                        <input type="number" class="" name="travellers" id="travellers" value="{{old('travellers',request()->travellers?request()->travellers:1)}}" required placeholder="No of Travellers">
                                    </div>
                                </div>
                                @if(Auth::check())
                                <button class="bttn btn-fill btn-block mt-2" id="booking-btn" type="submit" >Booking</button>
                                @else
                                <button class="bttn btn-fill btn-block mt-2" id="booking-btn" onclick="BookNow()" >Booking</button>
                                @endif
                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section><!--/Listing Details Area-->

    <!--Similar Rooms-->
    <section class="similar-rooms" style="margin-bottom:20px;margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="cl-black mb-30">More Flights</h4>
                </div>
            </div>
            <div class="row">
                @foreach($related_flight as $flight_v)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="{{asset('assets/booking/assets/backend/image/flight/'.optional($flight_v->flight)->img)}}">
                    <div class="card-block">
                        <figure class="profile profile-inline">
                            <img src="{{asset('assets/booking/assets/backend/image/flight/'.optional($flight_v->flight)->img)}}" alt="">
                        </figure>
                        <h4 class="card-title"><a href="{{route('flight_details',$flight_v->id)}}">{{$flight_v->title}}</a></h4>
                        <div class="card-text">
                            <b>{{$flight_v->flight->name}}</b><br>
                            Available seats: {{ Str::limit($flight_v->available_seats,100) }}<br>
                            Trip: {{ Str::limit($flight_v->trip_type,100) }}<br>
                            <span class="text-success">Take-off: {{ date('d/M/Y H:i:s A', strtotime($flight_v->flight_takeoff)) }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>{{ single_price($flight_v->price_per_seat) }} <i>/Seat</i></strong>
                        <a href="{{route('flight_details',$flight_v->id).'?trip_from='.$search['trip_from'].'&trip_to='.$search['trip_to'].'&trip_type='.$search['trip_type']}}" class="btn btn-primary float-right btn-sm">Book <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>

                @endforeach
            </div>
        </div>
    </section><!--/Similar Rooms-->

<script>
    function BookNow(){
        showFrontendAlert('warning', 'Please login first');
        setTimeout(function(){ location.href='/login'; }, 2000);
    }
</script>
@endsection


