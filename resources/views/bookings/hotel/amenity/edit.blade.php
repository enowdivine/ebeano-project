@extends('layouts.booking')

@section('title', 'Edit Amenities')

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
                <h2>Edit Amenities
                    <a class="btn btn-tsk float-right" href="{{route('amenities')}}"><i class="fa fa-list"></i> Amenities List</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('amenities.update',$amenity->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{$amenity->name}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">

                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{$amenity->description}}</textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$amenity->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <hr/>
                        <button type="submit" class="btn btn-lg mt-4 btn-tsk btn-block"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

</div>
</div>
@endsection
