@extends('layouts.booking')

@section('title', 'Create Flight Partner')

@section('content')
<div class="row">
    @php
       $name = Str::of(Auth::user()->name)->explode(' ');
       $user_name = $name[0];
    @endphp
    <div class="col-lg-2">
    </div>
    
    <div class="col-lg-8">
    <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-header bg-white">
                <h2>Create Flight Partner
                    <a class="btn btn-tsk float-right" href="{{route('floor')}}"><i class="fa fa-list"></i> View Flight</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('flight.create-flight-post')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Track Number</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="number" placeholder="Number" value="{{old('number')}}" required>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control form-control-lg" rows="4" name="description" placeholder="Description">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4">
                        <label><strong>Upload Logo</strong> </label>
                        <input type="file" class="form-control form-control-lg" name="logo_image" >
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

<div class="col-lg-2">
    </div>
    
</div>
@endsection
