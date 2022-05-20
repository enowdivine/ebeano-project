@extends('layouts.estate')

@section('title'){{ (ucwords(strtolower($property->title ?? $property->title))).' | Ebeano Market' }}@stop

@section('meta_description'){{ strip_tags($property->meta_desc) }}@stop

@section('meta_keywords'){{ $property->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ ucwords(strtolower($property->title)) }}">
    <meta itemprop="description" content="{{ strip_tags($property->meta_desc) }}">
    <meta itemprop="image" content="{{ asset('assets/estate/images/uploads/' .  $property->image_name) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@ebeano_market">
    <meta name="twitter:title" content="{{ ucwords(strtolower($property->title)) }}">
    <meta name="twitter:description" content="{{ $property->meta_desc }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset('assets/estate/images/uploads/' .  $property->image_name) }}">
    <meta name="twitter:data1" content="{{ $property->price }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ ucwords(strtolower($property->title)) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('estate.show', $property->slug) }}" />
    <meta property="og:image" content="{{ asset('assets/estate/images/uploads/' .  $property->image_name) }}" />
    <meta property="og:description" content="{{ $property->body }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ $property->price }}" />
@endsection

@section('content')
    <script>
        $(document).ready(function() {
            $(".p-it-sel").click(function() {
                $(".p-it-sel.active").removeClass("active");
                $(this).addClass("active");
            });
        });

    </script>
    <style>
        .carousel-item {
            min-height: 0px;
        }
    
    .text-sec {
        color: rgb(128 13 144);
        font-size: 16px;
    }
    
    @media (min-width: 768px){
        .mobile-details {
            display:none;
        }
    }
    
    
    .action-link ul {
        padding: 0;
        list-style: none;
    }
    
    .action-link li {
        border-color: #f7961c;
    }
    
    .action-link li {
        background-color: #fff;
        margin: 0 6px 11px 0;
        display: inline-block;
        font-size:11px;
        border-radius: 4px;
        color: #f7961c;
        padding: 5px 15px;
        border: 1px solid #f7961c;
        transition: all 0.2s;
    }
    
    .action-link li a {
        color: #f7961c;
        display: block;
        padding: 5px 15px;
        text-decoration: none;
    }

    </style>
    {{-- breadcrumb --}}

    <div class="section mt-2 mt-md-0">
        <ul class="d-none d-md-flex my-md-2 p-md-1 breadcrumb">
            <li class="breadcrumb-item"><a href="/estate">Home</a></li>
            
            @if(isset($property->category->name))
            <li class="breadcrumb-item">
                <a href="{{ route('estate.filter', $property->category->id) }}">{{ ucwords($property->category->name)}}</a>
            </li>
            @else
            <li class="breadcrumb-item"><a href="">All Properties</a></li> 
            @endif
        
            <li class="breadcrumb-item active">{{ucwords(strtolower($property->title))}}</li>
        </ul>
        <div class="row">
            <div class="px-2 col-md-9">
            {{-- product preview section --}}
                <div class="card rounded-lg shadow-sm border-0 px-3 mb-4">
                    <div class="d-flex mt-3 mb-3 justify-content-between">
                        <div class="product-img-view">
                            <div id="p-img-slider" class="carousel slide" data-ride="carousel">

                              <!-- Indicators -->
                              
                              <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img src="{{ asset('assets/estate/images/uploads/' .  $property->image_name) }}" class="img-fluid show" alt="{{ucwords(strtolower($property->name))}}">
                                    </div>

                                    @if(is_array($property_photos) && count($property_photos) > 0)
                                        	@foreach($property_photos as $photo) 
                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/estate/images/uploads/'.$photo) }}" class="img-fluid hide" alt="{{ucwords(strtolower($property->name))}}">
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- Left and right controls -->
                                  <a class="carousel-control-prev" href="#p-img-slider" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                  </a>
                                  <a class="carousel-control-next" href="#p-img-slider" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                  </a>
                            </div>
                            
                            
                        </div>
                        
                        <div class="mx-3 pb-2 description d-none d-md-block">
                            <h4><?php echo $property->title; ?></h4>
                            <ul class="info_details">                          
                                <li><h2 style="color: #468847;"> {{ format_price($property->price) }} </h2></li>
                                <li><i class="fa fa-search"></i> Category<span><?php echo get_estate_category($property->category_id); ?></span></li>
                                <li><i class="fa fa-building"></i> Area<span><?php echo $property->area; ?> sqt2</span></li>
                                <li><i class="fa fa-bed"></i> Beds<span><?php echo $property->beds; ?></span></li>
                                <li><i class="fa fa-bath"></i> Bathrooms<span><?php echo $property->bath; ?></span></li>
                                <li><i class="fa fa-map"></i> Location<span><?php echo $property->city; ?>, <?php echo $property->state; ?></span></li>
								<li><small><?php echo $property->address; ?></small></li>
                                
                            </ul>
                        </div>
                            
                    </div>
                             
                             
                </div>
                
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4 mobile-details">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase"><?php echo $property->title; ?></span>

                    </div>
                    <div class="card-body">
                        <ul class="info_details">                          
                            <li><h2 style="color: #468847;"> {{ format_price($property->price) }} </h2></li>
                            <li><i class="fa fa-search"></i> Category<span><?php echo get_estate_category($property->category_id); ?></span></li>
                            <li><i class="fa fa-building"></i> Area<span><?php echo $property->area; ?> sqt2</span></li>
                            <li><i class="fa fa-bed"></i> Beds<span><?php echo $property->beds; ?></span></li>
                            <li><i class="fa fa-bath"></i> Bathrooms<span><?php echo $property->bath; ?></span></li>
                            <li><i class="fa fa-map"></i> Location<span><?php echo $property->city; ?>, <?php echo $property->state; ?></span></li>
							<li><small><?php echo $property->address; ?></small></li>
                            
                        </ul>
                    </div>

                </div>
                
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">Description</span>

                    </div>
                    <div class="card-body">
                        {!! $property->body !!}
                    </div>

                </div>
                
                {{-- product details section --}}
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">Location</span>

                    </div>
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>

                </div>
                
            </div>
                
            {{-- preview sidebar --}}
            @php
            $photo = url("assets/images/uploads/" . $property->agent_id . "/profile.jpg");
                if (!@getimagesize($photo)) {
                    $photo = url("assets/estate/avatars/profile-pic.jpg");
                }
            @endphp
            <div class="px-2 col-md-3 mb-3">
                <div class="sticky-top">
                
                    <div class="p-key-feat card border-0 rounded-lg mb-3">
                        <div class="card-header bg-white border-bottom py-2">
                            <span class="text-uppercase font-weight-bold">Agent</span>
                        </div>
                        <div class="card-body action-link">
                            <center><img height="80" width="80" src="{{ $photo }}" class="rounded-circle" alt="Image"></center>
                            <h4 class="text-center">{{ $property->agent->name }}</h4>
                            <div class="justify-content-between d-flex" align="center">
                                <a href="mailto:{{ $property->agent->email }}"><i class="fa fa-envelope"></i> SEND MSG</a>
                                <a href="tel:{{ $property->agent->phone }}"><i class="fa fa-phone"></i> CALL ME</a>
                            </div>
                            
                            
                        </div>
    
                    </div>
                    
                    <div class="p-key-feat card border-0 rounded-lg mb-3">
                        <div class="card-header bg-white border-bottom py-2">
                            <span class="text-uppercase font-weight-bold">General Features</span>
                        </div>
                        <div class="card-body action-link">
                            <div class="d-flex justify-content-between">
                            <?php $property_features = explode(",", $property->features); $i=0;
    						    foreach ($features as $list) : 
    							    if($i%4 == 0) { 
    						?>
                                <ul class="general_info">
								<?php } ?>
                           
										<li><i class="fa fa-check"></i> {{$list->name}}</li>
									                  
                               <?php if($i%4 == 4) { ?>
							   </ul>
                                
    							   <?php } ?>
    								  
    							<?php   $i++; endforeach; ?>
    							
    							</div>
    						</div>
												
                        </div>
    
                    </div>
                
                </div>
            </div>
            
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Title-->
                        <div class="titles">
                            <h1>Related Properties</h1>
                        </div>
                        <!-- End Title-->

                        <!-- Carousel Properties -->
                        <div id="Carousel" class="carousel slide">
                        
							<div class="carousel-inner">
							    
					      <?php if (!empty($property->related)) {
                            $property_related = explode(",", $property->related);
    
                            for ($i = 0; $i < count($property_related); $i++) {
                                $rel_prop = get_estate_property($property_related[$i]);
                    			if(!empty($rel_prop)) { 
                                ?>
                            
                            <!-- Item Property-->
                            <div class="item" style="margin-bottom:30px">
                                <img src="{{ asset('assets/estate/images/uploads/' .  $rel_prop->image_name) }}" class="img-fluid" alt="{{$rel_prop->title}}">
                            	<a href="{{ route('estate.show', $rel_prop->slug) }}"><h5>{{$rel_prop->title}}</h5></a>
                            </div><!--.item-->
							
			                <?php } } } ?>

                            </div><!--.carousel-inner-->
                              
                              
                            </div><!--.Carousel-->
                
                        </div>
                        <!-- End Carousel Properties -->
                    </div>
                    <!-- End Content Carousel Properties -->
                </div><br>
                
        </div>
        
    </div>
 
@endsection

@section('script')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBRy4cuNgPMeS5sDUj8rZ8Ql4_BkMMf4TM&language=en" 
type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Carousel').carousel({
            interval: 5000
        })
    });
var locations = [
    ['<?php echo $property->title; ?>', <?php echo $property->latitude; ?>, <?php echo $property->longitude; ?>]
];

var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: new google.maps.LatLng(<?php echo $property->latitude; ?>, <?php echo $property->longitude; ?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

var infowindow = new google.maps.InfoWindow();

var marker, i;

for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
    });

    google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
        }
    })(marker, i));
}
</script>
<script>
    //showFrontendAlert('warning', 'Please choose all the options');
</script>
@endsection