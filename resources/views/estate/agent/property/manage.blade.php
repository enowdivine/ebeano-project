@extends('layouts.estate')

@section('title', $page_title)

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
                <h3 class="text-center">Manage Properties <i class="la la-home mr-3"> </i> </h3>
            </div>
            <div class="card-body">
                
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($properties) > 0)
                            @foreach($properties as $k=>$row)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td><img class="img-responsive" width="100px" src="<?php echo url("/assets/estate/images/uploads/" . $row->user_id . "/" . $row->image_name); ?>" alt="" /></td>
                                    <td><a target="_blank" href="{{ route('estate.show', $row->slug) }}" ><?php echo $row->title; ?></a> <br>
            
                                        <small><?php echo $row->city; ?>, <?php echo $row->state; ?>, <?php echo $row->zip; ?></small>
                                    </td>
                                    <td>{{ format_price($row->price) }} <small> {{ $row->type }}</small> </td>
                                    <td>
                                        Bathrooms : <?php echo $row->bath; ?> <br>
                                        Bedrooms : <?php echo $row->beds; ?> <br>
                                        Year : <?php echo $row->year; ?> <br>
                                    </td>
                                    <td> {{get_estate_category($row->category_id)}} </td>
                                    <td>
                                        @if($row->verified)
                                            <span class="label label-success me-1">Verified</span>
                                        @else
                                            <span class="label label-danger me-1">Unverified</span>
                                        @endif
                                    </td>
                                    <td> 
                                        <a data-id="1" class="btn-sm btn btn-primary" href="{{ route('estate.edit.property', $row->id) }}" > <i class="fa fa-edit"> </i> </a>
                                        <a target="_blank"  class="btn-sm btn btn-primary" href="{{ route('estate.show', $row->slug) }}" > <i class="fa fa-eye "> </i> </a> 
                                        <a href="{{ route('estate.delete.property', $row->id) }}"  class="btn-sm btn btn-danger" > <i class="fa fa-times "> </i> </a>  
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
        </div>
        
        <div class="pagination-wrapper py-4">
            <ul class="pagination justify-content-end">
                {!! $properties->links()!!}
            </ul>
        </div>
        
    </div>
    
</div>
@endsection