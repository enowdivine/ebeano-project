@extends('layouts.artisan')

@section('title', $page_title)

@section('content')
<link href="https://stormmarts.com/artisan/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">
<link href="https://stormmarts.com/artisan/assets/front/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
    .artisan-card {
        border: 0;
        border-radius: 27.5px;
        box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
        overflow: hidden;
    }
    
    .artisan-card .card-body {
        padding: 6px 10px 10px;
    }
    
    .artisan-card-description {
        font-size: 25px;
        color: #000;
        font-weight: normal;
        margin-bottom: 23px;
    }

    .artisan-card .form-control {
        border: 1px solid #d5dae2;
        padding: 10px 20px;
        margin-bottom: 20px;
        min-height: 45px;
        font-size: 13px;
        line-height: 15;
        font-weight: normal;
    }

    .artisan-card .form-control::-webkit-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::-moz-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control:-ms-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::-ms-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::placeholder {
        color: #919aa3;
    }

    .artisan-card .artisan-btn {
        padding: 13px 20px 12px;
        background-color: #eb790f;
        border-radius: 4px;
        font-size: 17px;
        font-weight: bold;
        line-height: 20px;
        color: #fff;
        margin-bottom: 24px;
    }

    .artisan-card .artisan-btn:hover {
        border: 1px solid #eb790f;
        background-color: transparent;
        color: #000;
    }

</style>
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="card artisan-card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h3 class="text-center">Create new Job <i class="la la-plus-circle mr-3"> </i> </h3>
            </div>
            <div class="card-body">
                
        <form action="{{route('create-job-post')}}" name='editForm' enctype='multipart/form-data' method="POST">
            {{ csrf_field() }}

              <div class="row">
                <div class="col-sm-12">
                  @if(Session::has('success') && !empty(Session::get('success')))
                  <div class="alert alert-success">
                    {{Session::get('success')}}
                  </div>
                  @endif
            
                  @if(Session::has('error') && !empty(Session::get('error')))
                  <div class="alert alert-warning">
                    {{Session::get('error')}}
                  </div>
                  @endif
            
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                </div>
              </div>

              <div class="form-group">
                <label for="project_title" class="sr-only"><strong>Project Title :</strong></label>
                <input type="text" name="title" id="title" class="{{ $errors->has('title') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Project Title">
                @if ($errors->has('title'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="keywords" class="sr-only"><strong>Project Keywords :</strong></label>
                <input type="text" name="keywords" id="keywords" class="{{ $errors->has('keywords') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Project Keywords ...">
                @if ($errors->has('keywords'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('keywords') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="description" class="sr-only"><strong>Project Description :</strong></label>
                <textarea name="description" id="area1" class="{{ $errors->has('description') ? 'form-control is-invalid' : 'form-control' }}"> </textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="experience" class="sr-only"><strong>Experience :</strong></label>
                <input type="text" name="experience" id="experience" class="{{ $errors->has('experience') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Experience">
                @if ($errors->has('experience'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('experience') }}</strong>
                    </span>
                @endif
              </div>

                <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label class="col-md-12"><strong>Job Category :</strong></label>
                        <div class="col-md-12">
                            <select class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($category as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback error-color red">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-12 "><strong>Job Price
                                :</strong></label>
                        <div class="col-md-12">
                            <div class="input-group input-group-md">
                                <input type="text"
                                       class="{{ $errors->has('salary') ? 'form-control is-invalid' : 'form-control' }}"
                                       name="salary">
                            </div>

                            @if ($errors->has('salary'))
                                <span class="invalid-feedback error-color red">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-12 "><strong>Job Time
                                :</strong></label>
                        <div class="col-md-12">
                            <div class="input-group input-group-md date" id="date"
                                 data-provide="datepicker">
                                <input type="text" name="deadline" class="form-control" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail"
                             style="width: 200px; height: 150px;"
                             data-trigger="fileinput">
                            <img style="width: 200px"
                                 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                 alt="...">

                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"
                             style="max-width: 200px; max-height: 150px"></div>

                        <div class="img-input-div">
                                    <span class="btn btn-primary btn-file" style="background-color:rgb(131, 13, 146);border-color:rgb(131, 13, 146);">
                                        <span class="fileinput-new bold uppercase"><i
                                                    class="fa fa-file-image-o"></i> Select Thumbnail </span>
                                        <span class="fileinput-exists bold uppercase"><i
                                                    class="fa fa-edit"></i> Change</span>
                                        <input type="file" name="image"
                                               class="{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                               accept="image/*">
                                    </span>
                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                               data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                        </div>
                    </div>

                    @if ($errors->has('image'))
                        <span class="invalid-feedback error-color red">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12">
                    <br>
                    <input type="submit" class="btn btn-block artisan-btn mb-4" value="CREATE JOB">
                </div>
            </div>
        </form>
        </div>
    </div>
        

    </div>

</div>
<script src="https://stormmarts.com/artisan/assets/admin/js/bootstrap-fileinput.js"></script>
<script src="https://stormmarts.com/artisan/assets/front/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://stormmarts.com/artisan/assets/admin/js/nicEdit-latest.js"></script>
<script>
    // $('.datepicker').datepicker();
    var date = new Date();
    date.setDate(date.getDate());

    $('#date').datepicker({
        startDate: date
    });

</script>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        new nicEditor({fullPanel: true}).panelInstance('area1');
    });
</script>
@endsection