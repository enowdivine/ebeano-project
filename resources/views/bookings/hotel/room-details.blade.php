@extends('layouts.booking')

@section('title', 'Room Type')

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
                                @foreach($room_type->roomTypeImage as $roomTypeImage)
                                <div class="slider-for__item ex1" data-src="{{asset('assets/booking/assets/backend/image/room_type_image/'.$roomTypeImage->image)}}">
                                    <img src="{{asset('assets/booking/assets/backend/image/room_type_image/'.$roomTypeImage->image)}}" alt="" />
                                </div>
                                @endforeach
                            </div>

                            <div class="slider-nav">
                                @foreach($room_type->roomTypeImage as $roomTypeImage)
                                <div class="slider-nav__item">
                                    <img src="{{asset('assets/booking/assets/backend/image/room_type_image_th/'.$roomTypeImage->image)}}" alt=""/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="room-details-content card card-inverse card-info wow fadeInUp" data-wow-delay="0.4s" style="padding:20px">
                        <h2 class="cl-black"><a href="" class="cl-black">{{$room_type->title}}</a></h2>
                       {{ $room_type->description }}
                        <div class="row mb-40">
                            @foreach($room_type->amenity->chunk(ceil($room_type->amenity->count()/3)) as $chunk_item)
                            <div class="col-md-4 col-sm-12 col-xs-12 mb-40">
                                <ul>
                                    @foreach($chunk_item as $amenity)
                                    <li><i class="fa fa-check"></i>{{$amenity->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="page-sidebar">
                        <div class="bg-base price-tag pb-2 pt-3">
                           <h3 style="color:white">Price</h3>
                        </div>
                        <div class="border-base bg-light price-tag  mb-2">
                            <h4>&#8358;{{number_format($room_type->base_price,2)}}<span>/Night</span></h4>
                        </div>
                        <div class="bg-base price-tag pb-2 pt-3">
                            <h3 class="mb-2" style="color:white">Booking</h3>
                        </div>
                        <div class="border-base booking-form  bg-light">

                            <form action="{{route('booking',$room_type->id)}}" method="post" id="booking_form">@csrf
                                <input type="text" name="name" placeholder="Name*" value="{{old('name')}}" required >
                                <input type="email" name="email" placeholder="Email*" value="{{old('email')}}" required >
                                <input type="text" name="phone" placeholder="Phone number*" value="{{old('phone')}}" required >
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Adult* <span class="text-info">( {{$room_type->higher_capacity}}/room )</span></small> </label>
                                        <input type="number" class="" name="adult" id="adult_book" value="{{old('adult',request()->adults?request()->adults:1)}}" required placeholder="Adult">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Children <span class="text-info"> ( {{$room_type->kids_capacity}}/room)</span></small> </label>
                                        <input type="number" class="" name="children" id="children_book" value="{{old('children',request()->children?request()->children:1)}}" required placeholder="Children">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Arrival Date*</small></label>
                                        <input type="text" name="arrival" id="arrival_book" value="{{$search['arrival']}}" placeholder="Arrival Date*" autocomplete="off">
                                    </div>
                                    <div class="col-6">
                                        <label><small>Departure Date*</small></label>
                                        <input type="text" name="departure" id="departure_book" value="{{$search['departure']}}" placeholder="Departure Date*" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row mb-4">

                                    <div class="form-group col-md-6">
                                        <div class="row border-base ml-1 mr-1">
                                            <div class="col-md bg-base text-white  text-center ">Rooms</div>
                                            <div class="col-md bg-white text-center "><span id="room_text">1</span></div>
                                        </div>

                                        <input type="hidden" name="rooms" value="1" id="room_input">
                                        <input type="hidden" name="available" value="0" id="available">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row border-base ml-1 mr-1">
                                            <div class="col-md bg-base text-white  text-center ">Night</div>
                                            <div class="col-md text-center"><span id="night_text">1</span></div>
                                        </div>
                                        <input type="hidden" name="night" value="1" id="night_input">
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
    <section class="similar-rooms" style="margin-bottom:20px">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="cl-black mb-30">More Rooms</h4>
                </div>
            </div>
            <div class="row">
                @foreach($reletade_rooms as $room_type_v)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="{{asset('assets/booking/assets/backend/image/room_type_image_th/'.optional($room_type_v->featuredImage())->image)}}">
                    <div class="card-block">
                        <figure class="profile profile-inline">
                            <img src="{{asset('assets/booking/assets/backend/image/room_type_image_th/'.optional($room_type_v->featuredImage())->image)}}" alt="">
                        </figure>
                        <h4 class="card-title"><a href="{{route('room_details',$room_type_v->id)}}">{{$room_type_v->title}}</a></h4>
                        <div class="card-text">
                            {{ Str::limit($room_type_v->description,100) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>&#8358;{{ number_format($room_type_v->base_price) }} <i>/Night</i></strong>
                        <a href="{{route('room_details',$room_type_v->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children']}}" class="btn btn-primary float-right btn-sm">Book <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>

                @endforeach
            </div>
        </div>
    </section><!--/Similar Rooms-->


@endsection
@section('script')
    <script>
        function BookNow(){
            showFrontendAlert('warning', 'Please login first');
            setTimeout(function(){ location.href='/login'; }, 2000);
        }
    </script>
    <script>
        var number_of_room,total_night,available;
        // Date Picker
        $( function() {
             number_of_room = 1;
             total_night = 1;
             available = 0;
            function setData(){
                $('#room_text').text(number_of_room);
                $('#room_input').val(number_of_room);
                $('#night_text').text(total_night);
                $('#night_input').val(total_night);
                $('#available').val(available);
                if(available){
                    $('#booking-btn').removeClass('d-none');
                }else{
                    $('#booking-btn').addClass('d-none');
                }
            }

            /* global setting */
            var datepickersOpt = {
                dateFormat: 'yy/mm/dd',
                minDate   : 0
            };

            $("#arrival_book").datepicker($.extend({
                onSelect: function() {
                    var minDate = $(this).datepicker('getDate');
                    minDate.setDate(minDate.getDate()+1);
                    $("#departure_book").datepicker( "option", "minDate", minDate);
                    checkAvailable();
                }
            },datepickersOpt));

            $("#departure_book").datepicker($.extend({
                onSelect: function() {
                    var maxDate = $(this).datepicker('getDate');
                    maxDate.setDate(maxDate.getDate()-1);
                    $("#arrival_book").datepicker( "option", "maxDate", maxDate);
                    checkAvailable();
                }
            },datepickersOpt));
            $(document).on('keyup','#adult_book,#children_book',function () {
                checkAvailable();
                setData();
            });
           function checkAvailable() {
               var data ={
                   arrival:$("#arrival_book").datepicker('getDate'),
                   departure:$("#departure_book").datepicker('getDate'),
                   adult:$("#adult_book").val(),
                   children:$("#children_book").val()
               };
               
               $('#message_div').addClass('d-none');
               if(data.arrival !== null && data.departure !== null){
                   $.ajax({
                       url:'{{route('check_available_room',$room_type->id)}}',
                       method:'get',
                       global: false,
                       async:false,
                       data:{
                           arrival:moment(data.arrival,"YYYY-MM-DD").format("YYYY-MM-DD"),
                           departure:moment(data.departure,"YYYY-MM-DD").format("YYYY-MM-DD"),
                           adult:data.adult,
                           children:data.children
                       },
                       beforeSend:function(){
                            $("#booking-btn").html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Checking...');
                            $("#booking-btn").attr("disabled",true);
                       },
                       success:function (res) {
                           $("#booking-btn").html('Booking');
                            $("#booking-btn").attr("disabled",false);
                           number_of_room = res.data.number_of_room;
                           total_night = res.data.total_night;
                            available = res.data.available;
                           setData();
                       }
                    })
               }

           }
        });
    </script>
@endsection