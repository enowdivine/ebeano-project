@extends('layouts.booking')

@section('title', 'Create Tax')

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
                <h2>Create Tax
                    <a class="btn btn-tsk float-right" href="{{route('tax')}}"><i class="fa fa-list"></i> Tax List</a>

                </h2>
            </div>
            <div class="card-body">
                <form action="{{route('tax.store')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Name</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Code</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="code" placeholder="Code" value="{{old('number')}}" required>
                    </div>
                </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label><strong>Type</strong> <small class="text-danger">*</small></label>
                            <select type="text" class="form-control form-control-lg" name="type" >
                                <option value="PERCENTAGE">Percentage</option>
                                <option value="FIXED">Fixed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong>Rate</strong> <small class="text-danger">*</small></label>
                            <input type="text" class="form-control form-control-lg" name="rate" placeholder="0.00" value="{{old('number')}}" required>
                        </div>
                    </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" checked type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status" >
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
