@extends('layouts.theme')

@section('title', 'Dashboard')

@section('content')
<link href="https://stormmarts.com/artisan/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">
<link href="https://stormmarts.com/artisan/assets/front/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="row">
    @php
    $name = Str::of(Auth::user()->name)->explode(' ');
    $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @if(Auth::user()->user_type == 'seller' || Auth::user()->user_type == 'admin')
        @include('inc.seller_nav')
    @elseif(Auth::user()->user_type == 'user')
        @include('inc.customer_nav')
    @endif

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Profile Update</h4>
            </div>
            <form class="form-default" data-toggle="validator" action="{{ route('user.update_profile') }}" role="form"
                method="POST">
                @csrf
                <div class="card-body">
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
                    @if(Auth::check())
                    @php
                    $user = Auth::user();
                    @endphp

                    <input type="hidden" name="id" value="{{ encrypt($user->id)}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Email')}}</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Address')}}</label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Select your state')}}</label>
                                <select class="form-control selectpicker" data-live-search="true" name="state">
                                    @foreach (\App\State::all() as $key => $state)
                                    <option value="{{ $state->state_id }}" {{$state->state_id == $user->state_id ? 'selected':''}}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Select your country')}}</label>
                                <select class="form-control selectpicker" data-live-search="true" name="country">
                                    @foreach (\App\Country::all() as $key => $country)
                                    <option value="{{ $country->id }}"  {{($country->id == $user->country_id) ? 'selected' :'' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('City')}}</label>
                                <input type="text" class="form-control" value="{{ $user->city }}" name="city" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Phone')}}</label>
                                <input type="number" min="0" class="form-control" value="{{ $user->phone }}"
                                    name="phone" required>
                            </div>
                        </div>
                    </div>
                    
                    @if($user->user_type=='artisan')
                    <hr style="border-color:#eb790f">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Artisan Skill')}}</label>
                                <select class="form-control selectpicker" data-live-search="true" name="artisan_category">
                                    @foreach (\App\ArtisanCategory::all() as $key => $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $user->artisan->category_id)
                                        selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Bank Name')}}</label>
                                <select class="form-control selectpicker" data-live-search="true" name="bank_name">
                                    @foreach (\App\Bank::all() as $key => $bank)
                                    <option value="{{ $bank->id }}" @if ($bank->id == $user->artisan->bank_id)
                                        selected @endif>{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Bank Account Name')}}</label>
                                <input type="text" class="form-control" value="{{ $user->artisan->bank_acc_name }}"
                                    name="bank_acc_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Bank Account No')}}</label>
                                <input type="number" min="0" class="form-control" value="{{ $user->artisan->bank_acc_no }}"
                                    name="bank_acc_no" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Business Name')}}</label>
                                <input type="text" class="form-control" value="{{ $user->artisan->company_tagline }}"
                                    name="business_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Business Address')}}</label>
                                <input type="text" class="form-control" value="{{ $user->artisan->company_description }}"
                                    name="business_desc" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Facebook')}}</label>
                                <input type="hidden" class="form-control" value="{{ $user->artisan->fb }}"
                                    name="facebook" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Twitter')}}</label>
                                <input type="hidden" class="form-control" value="{{ $user->artisan->twitter }}"
                                    name="twitter" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Linked In')}}</label>
                                <input type="hidden" class="form-control" value="{{ $user->artisan->linkedin }}"
                                    name="linkedin" required>
                            </div>
                        </div>
                        
                    <div class="col-md-6">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail"
                                 style="width: 200px; height: 150px;"
                                 data-trigger="fileinput">
                                
                                @if($user->artisan->image == null)
                                    <img style="width: 200px"
                                         src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                         alt="...">
                                @else
    
                                    <img style="width: 200px"
                                         src="{{asset('assets/artisan/images/user/'.$user->artisan->image)}}"
                                         alt="...">
                                @endif
    
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
                    </div>
                    </div>
                    @endif

                    <input type="submit" class="btn btn-default"  value="Update">

                    @endif
                </div>
            </form>
        </div>
      @if(Auth::user()->user_type == 'seller')

        @include('seller.update_info')

        @endif
    </div>

</div>
<script src="https://stormmarts.com/artisan/assets/admin/js/bootstrap-fileinput.js"></script>
<script src="https://stormmarts.com/artisan/assets/front/js/bootstrap-datepicker.min.js"></script>
@endsection