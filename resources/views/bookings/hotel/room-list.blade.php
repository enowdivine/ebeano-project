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
</style>
<section class="rooms-suites-area mt-4">
        <div class="container">
            <div class="row hero-search-breadcrumb mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                </div>
            </div>
        </div>

    </section>
    <section class="rooms-suites-area pt-4" style="margin-bottom:20px">
        <div class="container">
        <h4>Available Hotel Rooms</h4>
            <div class="row">
                @forelse($room_types as $room_type)
                <div class="col-sm-6 col-md-4 col-lg-3 mt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-inverse card-info">
                    <img class="card-img-top" src="{{asset('assets/booking/assets/backend/image/room_type_image_th/'.optional($room_type->featuredImage())->image)}}">
                    <div class="card-block">
                        <figure class="profile profile-inline">
                            <img src="{{asset('assets/booking/assets/backend/image/room_type_image_th/'.optional($room_type->featuredImage())->image)}}" alt="">
                        </figure>
                        <h4 class="card-title"><a href="{{route('room_details',$room_type->id)}}">{{$room_type->title}}</a></h4>
                        <div class="card-text">
                            {{ Str::limit($room_type->description,100) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>&#8358;{{ number_format($room_type->base_price) }} <i>/Night</i></strong>
                        <a href="{{route('room_details',$room_type->id).'?arrival='.$search['arrival'].'&departure='.$search['departure'].'&adults='.$search['adults'].'&children='.$search['children']}}" class="btn btn-primary float-right btn-sm">Book <i class="ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>
                @empty
                    <div class="col-lg-12 wow fadeInUp border p-md-5" data-wow-delay="0.4s">
                        <h1 class="text-warning text-center">No Room!</h1>
                    </div>
                @endforelse
                    @if ($room_types->lastPage() > 1)
                <div class="col-md-12 wow fadeInUp" data-wow-delay="1.5s">
                    <ul class="styled-pagination mt-30 centered">
                        <li class="next {{ ($room_types->currentPage() == 1) ? ' disabled' : '' }}" ><a href="{{($room_types->currentPage() == 1) ? '#' : $room_types->url(1)   }}"><span class="fa fa-angle-left"></span></a></li>
                        @for ($i = 1; $i <= $room_types->lastPage(); $i++)
                            <li>
                                <a class="{{ ($room_types->currentPage() == $i) ? ' active' : '' }}" href="{{ $room_types->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="prev {{ ($room_types->currentPage() == $room_types->lastPage()) ? ' disabled' : '' }}"><a href="{{($room_types->currentPage() == $room_types->lastPage())? '#' : $room_types->url($room_types->currentPage()+1)   }}"><span class="fa fa-angle-right"></span></a></li>
                    </ul>
                </div>
                    @endif

            </div>
        </div>
    </section><!--/Rooms and Suites Area-->

@endsection
@section('script')
    <script>
        // Date Picker
        $( function() {
            /* global setting */
            var datepickersOpt = {
                dateFormat: 'yy/mm/dd',
                minDate   : 0
            };

            $("#arrival").datepicker($.extend({
                onSelect: function() {
                    var minDate = $(this).datepicker('getDate');
                    minDate.setDate(minDate.getDate()+1);
                    $("#departure").datepicker( "option", "minDate", minDate);
                }
            },datepickersOpt));

            $("#departure").datepicker($.extend({
                onSelect: function() {
                    var maxDate = $(this).datepicker('getDate');
                    maxDate.setDate(maxDate.getDate()-1);
                    $("#arrival").datepicker( "option", "maxDate", maxDate);
                }
            },datepickersOpt));

        });
    </script>
@endsection