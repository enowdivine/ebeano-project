@extends('layouts.theme')

@section('title', 'Update Shipping Info')

@section('content')
<div class="row">
    @php
    $name = Str::of(Auth::user()->name)->explode(' ');
    $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @include('inc.customer_nav')

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Orders</h4>
            </div>
            <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}"
                role="form" method="POST">
                @csrf
                <div class="card-body">
                    @if(Auth::check())
                    @php
                    $user = Auth::user();
                    @endphp
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
                                    required>
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
                                <select class="form-control selectpicker" data-live-search="true" name="country">
                                    @foreach (\App\State::all() as $key => $state)
                                    <option value="{{ $state->name }}" @if ($state->id == $user->state_id) selected
                                        @endif>{{ $state->name }}</option>
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
                                    <option value="{{ $country->name }}" @if ($country->id == $user->country_id)
                                        selected @endif>{{ $country->name }}</option>
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
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Postal code')}}</label>
                                <input type="number" min="0" class="form-control" value="{{ $user->postal_code }}"
                                    name="postal_code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">{{__('Phone')}}</label>
                                <input type="number" min="0" class="form-control" value="{{ $user->phone }}"
                                    name="phone" required>
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{__('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{__('Address')}}</label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="{{__('Address')}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{__('Select your country')}}</label>
                                    <select class="form-control custome-control" data-live-search="true" name="country">
                                        @foreach (\App\Country::all() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label class="control-label">{{__('City')}}</label>
                                    <input type="text" class="form-control" placeholder="{{__('City')}}" name="city"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label class="control-label">{{__('Postal code')}}</label>
                                    <input type="number" min="0" class="form-control"
                                        placeholder="{{__('Postal code')}}" name="postal_code" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label class="control-label">{{__('Phone')}}</label>
                                    <input type="number" min="0" class="form-control" placeholder="{{__('Phone')}}"
                                        name="phone" required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="checkout_type" value="guest">
                    </div>
                    @endif
                </div>
            </form>
        </div>

    </div>

</div>
@endsection