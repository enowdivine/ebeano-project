@extends('layouts.theme')

@section('title', $page_title)

@section('content')
<link href="https://stormmarts.com/artisan/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">

<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('eforms/registrar/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="card artisan-card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h3 class="text-center">Editing Institute <i class="la la-edit mr-3"> </i> </h3>
            </div>
            <div class="card-body">
                
        <form action="{{route('registrar.edit.institute', [$institute->slug])}}" name='addForm' enctype='multipart/form-data' method="POST">
            {{ csrf_field() }}
            
              <div class="form-group">
                <label for="title" class="sr-only"><strong>Institution Name :</strong></label>
                <input type="text" name="name" id="title" class="{{ $errors->has('title') ? 'form-control is-invalid' : 'form-control' }}" value="{{ $institute->name }}" placeholder="Institution Name" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="tagline" class="sr-only"><strong>Institution Tagline/Motto :</strong></label>
                <input type="text" name="institute_tagline" value="{{ $institute->institute_tagline }}" id="tagline" class="{{ $errors->has('tagline') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Tagline/Motto" required>
                @if ($errors->has('tagline'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('tagline') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="school_description" class="sr-only"><strong>Institution Description :</strong></label>
                <textarea name="school_description" placeholder="Type here..." id="area1" class="{{ $errors->has('description') ? 'form-control is-invalid' : 'form-control' }}" >{{ $institute->school_description }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="address" class="sr-only"><strong>Institution Address :</strong></label>
                <input type="text" name="address" id="address" value="{{ $institute->address }}" class="{{ $errors->has('address') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Address" required>
                @if ($errors->has('address'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="country" class="sr-only"><strong>Institution Country :</strong></label>
                <input type="text" name="country" value="{{ $institute->country }}" id="country" class="{{ $errors->has('country') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Country" required>
                @if ($errors->has('country'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
              </div>

                <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label class="col-md-12"><strong>Institution State :</strong></label>
                        <div class="col-md-12">
                            <select class="form-control" name="state" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($states as $state)
                                    <option value="{{$state->state_id}}" @if($institute->state == $state->state_id) selected @endif>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state'))
                                <span class="invalid-feedback error-color red">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label class="col-md-12"><strong>Institution Type :</strong></label>
                        <div class="col-md-12">
                            <select class="form-control" name="type" required>
                                <option value="" disabled>Select Type</option>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}" @if($institute->type ==$key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback error-color red">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website" class="sr-only"><strong>Website :</strong></label>
                        <input type="text" name="web" value="{{ $institute->web }}" id="website" class="{{ $errors->has('website') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Website" required>
                        @if ($errors->has('website'))
                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facebook" class="sr-only"><strong>Facebook :</strong></label>
                        <input type="text" name="fb" value="{{ $institute->fb }}" id="facebook" class="{{ $errors->has('facebook') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Facebook" required>
                        @if ($errors->has('facebook'))
                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="twitter" class="sr-only"><strong>Twitter :</strong></label>
                        <input type="text" name="twitter" value="{{ $institute->twitter }}" id="twitter" class="{{ $errors->has('twitter') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Institution Twitter" required>
                        @if ($errors->has('twitter'))
                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('twitter') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail"
                             style="width: 70px; height: 70px;"
                             data-trigger="fileinput">
                            <img style="width: 70px"
                                 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Institute Logo"
                                 alt="...">

                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"
                             style="max-width: 70px; max-height: 70px"></div>

                        <div class="img-input-div">
                            <span class="btn btn-primary btn-file" style="background-color:rgb(131, 13, 146);border-color:rgb(131, 13, 146);">
                                <span class="fileinput-new bold uppercase"><i
                                            class="fa fa-file-image-o"></i> Institute Logo </span>
                                <span class="fileinput-exists bold uppercase"><i
                                            class="fa fa-edit"></i> Change</span>
                                <input type="file" name="institute_logo"
                                       class="{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                       accept="image/*" >
                            </span>
                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                               data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                        </div>
                    </div>
                    <input type="hidden" name="old_file" value="{{ $institute->institute_logo }}">

                    @if ($errors->has('image'))
                        <span class="invalid-feedback error-color red">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-8 offset-md-2">
                    <br>
                    <input type="submit" class="btn btn-block btn-default" value="Edit Institute">
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
@endsection