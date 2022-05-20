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
                <h4 class="">Password Change</h4>
            </div>
            <form class="form-default" data-toggle="validator" action="{{ route('user.change_password') }}" role="form"
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
                                <label class="control-label">{{__('Current Password')}}</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('New Password')}}</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Confirm New Password')}}</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-default"  value="Change">

                    @endif
                </div>
            </form>
        </div>

    </div>

</div>
<script src="https://stormmarts.com/artisan/assets/admin/js/bootstrap-fileinput.js"></script>
<script src="https://stormmarts.com/artisan/assets/front/js/bootstrap-datepicker.min.js"></script>
@endsection