@extends('layouts.estate')

@section('title', $page_title)

@section('content')
<link href="{{ asset('assets/estate/css/multi-select.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('assets/estate/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('assets/estate/css/themes/jquery.filer-dragdropbox-theme.css') }}" type="text/css" rel="stylesheet" />
<script src="{{ asset('assets/estate/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/estate/js/upload.js') }}"></script>
<script src="{{ asset('assets/estate/js/jquery.multi-select.js') }}"></script>

<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('estate/agent/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="card artisan-card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h3 class="text-center">Edit Property <i class="la la-pencil mr-3"> </i> </h3>
            </div>
            <div class="card-body">
                
        <form action="{{route('estate.edit.property.process')}}" name='addForm' enctype='multipart/form-data' method="POST">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input placeholder="Property Title"  value="<?php echo $property->title; ?>" type="text" required name="title" class="form-control">
                        <input  value="<?php echo $property->id; ?>" type="hidden"  name="id" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value=""> Select Category</option>
                            <?php foreach ($categories as $list) { ?>
                                <option <?php if ($property->category_id == $list->id) echo "selected"; ?> value="<?php echo $list->id; ?>"> <?php echo $list->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Agent</label>
                            <input   type="hidden"  name="agent_id" value="{{$agents->id}}" class="form-control">
                            <input   type="text" disabled value="{{$agents->name}}" name="" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-sm-9">
                    <div class="form-group">
                        <label>Address</label>
                        <input placeholder="Address"  value="<?php echo $property->address; ?>" id="address" type="text" required name="address" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>City</label>
                        <input placeholder="City" value="<?php echo $property->city; ?>" id="city" type="text"  name="city" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>State</label>
                        <input placeholder="State" value="<?php echo $property->state; ?>" id="state" type="text"  name="state" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Zip</label>
                        <input placeholder="Zip" value="<?php echo $property->zip; ?>" id="zip" type="text" required name="zip" class="form-control">
                    </div>
                </div>


                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Longitude </label>
                        <input placeholder="Longitude" value="<?php echo $property->longitude; ?>" id="longitude" type="text" required name="longitude" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Latitude </label>
                        <input placeholder="Latitude" value="<?php echo $property->latitude; ?>" id="latitude" type="text" required name="latitude" class="form-control">
                    </div>
                </div>
				
				<div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Property Type</label>
                        <select name="type" class="form-control"> 
							<option <?php if($property->type == "SALE")  echo "selected"; ?> value="SALE"> For Sale </option>
							<option <?php if($property->type == "RENT")  echo "selected"; ?> value="RENT"> For Rent </option>
							<option <?php if($property->type == "SHORTLET")  echo "selected"; ?> value="SHORTLET"> Shortlet </option>
							<option <?php if($property->type == "LAND")  echo "selected"; ?> value="LAND"> Land </option>
						</select>
                    </div>
                </div>
				
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input id="pac-input" class="controls_map" type="text" placeholder="Search Box">
                        <div id="myMap"></div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" value="<?php echo $property->price; ?>" placeholder="175,000" required  name="price" class="form-control">
                    </div>
                </div>

                <div class="col-md-2 col-sm-3">
                    <div class="form-group">
                        <label>Bedrooms</label>
                        <input type="number" placeholder="3" value="<?php echo $property->beds; ?>"  name="bedrooms" class="form-control">
                    </div>
                </div>

                <div class="col-md-2 col-sm-3">
                    <div class="form-group">
                        <label>Bathrooms</label>
                        <input type="number" placeholder="3" value="<?php echo $property->bath; ?>" name="bathrooms" class="form-control">
                    </div>
                </div>

                <div class="col-md-2 col-sm-3">
                    <div class="form-group">
                        <label>Size (sqfoot)</label>
                        <input type="number" placeholder="3" value="<?php echo $property->size; ?>" name="size" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Build Year</label>
                        <input type="number" placeholder="2005" max="<?php echo date("Y"); ?>" value="<?php echo $property->year; ?>" name="year" class="form-control">
                    </div>
                </div>


                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="area1" class="form-control" rows="5"> <?php echo $property->body; ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12">
                    <div class="form-group"><h3> Other Features </h3>  </div>
                    
                    <div class="form-group row">
                        <?php $feature_list = explode(",", $property->features); foreach ($features as $row) { ?>
                            <div class="col-md-3">
                                <input type="checkbox" <?php if (in_array($row->id, $feature_list)) echo "checked"; ?> value="{{$row->id}}" name="features[]">  {{$row->name}}                     
                            </div>
                        <?php } ?>
    
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12"> <h3> Related </h3>  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <select name="related[]" id='pre-selected-options' multiple='multiple'>
                            <?php $related_list = explode(",", $property->related);
                            foreach ($properties as $list) { ?>
                                <option  <?php if (in_array($list->id, $related_list)) echo "selected"; ?> value="<?php echo $list->id; ?>"> <?php echo $list->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12"> <h3> Images </h3>  </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group">
                        <label>Main Image</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" name="mainfile" accept=".png, .jpg, .jpeg"  >
                                <a href="<?php echo url("assets/estate/images/uploads/" . $property->user_id . "/" . $property->image_name); ?>"> View Previous Image </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group">
                        <label>Additional Supporting Images</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" name="file[]" accept=".png, .jpg, .jpeg"  id="filer_input2" multiple="multiple">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">

                    <div class="form-group">
						<?php foreach ($property_images as $list) { ?>
                            <div class="col-sm-3">
                                <a href="<?php echo url("admin/listing/image_delete/" . $list->id); ?>" title="Remove Image"> <i class="fa fa-times"> </i> </a>
                                <img class="img-responsive" src="<?php echo url("assets/estate/images/uploads/" . $property->id . "/" . $list->image_name); ?>">
                            </div>
						<?php } ?>
                    </div>
                </div>

                <div class="col-md-8 offset-md-2">
                    <input type="submit" class="btn btn-block btn-primary" value="Edit Record">
                </div>
            </div>
            </div>
            
        </form>
        </div>
    </div>
        

    </div>

</div>
<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'area1');
</script>

<style>
    #myMap {
        height: 250px;
        width: 100%;
    }
</style>
<script src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBRy4cuNgPMeS5sDUj8rZ8Ql4_BkMMf4TM"></script>

<script type="text/javascript">

$('#pre-selected-options').multiSelect();

var map;
var marker;
var myLatlng = new google.maps.LatLng(40.701218251717, -73.97360221848135);
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
function initialize() {
    var mapOptions = {
        zoom: 12,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    google.maps.event.addListener(searchBox, 'places_changed', function () {
        searchBox.set('map', null);


        var places = searchBox.getPlaces();

        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function (place) {

				marker.setPosition(place.geometry.location);
                google.maps.event.addListener(marker, 'map_changed', function () {
                    if (!this.getMap()) {
                        this.unbindAll();
                    }
                });
                bounds.extend(place.geometry.location);


            }(place));

        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(), 12));

    });


    marker = new google.maps.Marker({
        map: map,
        position: myLatlng,
        draggable: true
    });

    geocoder.geocode({'latLng': myLatlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                $('#latitude,#longitude').show();
                
               // $('#zip').val(results[0].address_components[7].long_name);
              
                //$('#city').val(results[0].address_components[3].long_name);
                //$('#state').val(results[0].address_components[5].long_name);
                $('#address').val(results[0].formatted_address);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
        }
    });

    google.maps.event.addListener(marker, 'dragend', function () {

        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    console.log(results[0].address_components);
                    //if (results[0].address_components[7].long_name != "") {
                      //  $('#zip').val(results[0].address_components[7].long_name);
                    //}
                    //$('#city').val(results[0].address_components[3].long_name);
                    //$('#state').val(results[0].address_components[5].long_name);
                    $('#address').val(results[0].formatted_address);
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    });

}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
@endsection