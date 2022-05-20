@extends('layouts.app')

@section('content')
@php
	if (session()->get('data')){
            $data = session()->get('data');
        }
@endphp
<div class="container-fluid">

	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Manage artisans</h5>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{url('eb-admin')}}">Dashboard</a></li>
				<li class="active"><span>artisans</span></li>
			</ol>
		</div>
		<!-- /Breadcrumb -->
	</div>

	<!-- /Title -->
	<!-- Row -->
	<div class="row">
		<div class="col-sm-6">
			@if(Session::has('success') && !empty(Session::get('success')))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif

			@if(Session::has('error') && !empty(Session::get('error')))
			<div class="alert alert-info">
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
	<!-- /Row -->

	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Register artisan</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<form id="example-advanced-form" action="{{route('artisan.add')}}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<h3><span class="number"><i class="icon-user-following txt-black"></i></span><span
									class="head-font capitalize-font">Personal Info</span></h3>
							<fieldset>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-wrap">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon "><i class="icon-user"></i></div>
													<input type="text" class="form-control required" name="name"
												id="exampleInputuname" placeholder="Full Name" value="{{ ($data['name']) ?? ''}}">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-envelope-open"></i>
													</div>
													<input type="email" class="form-control required"
														id="exampleInputEmail" name="email" placeholder="Email address" value="{{$data['email'] ?? ''}}">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-phone"></i></div>
													<input id="phone" type="tel" class="form-control required"
														name="phone" placeholder="+2348000000000" value="{{$data['phone'] ?? ''}}">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-location-pin"></i>
													</div>
													<input type="text" class="form-control required" name="address"
														id="exampleInputAddress" placeholder="Address of residence" value="{{$data['address'] ?? ''}}">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-tag"></i></div>
													<input type="text" class="form-control required" name="city"
														id="exampleInputCity" placeholder="City" value="{{$data['city'] ?? ''}}">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-location-pin"></i>
													</div>
													<select id="exampleState" class="form-control required"
														name="state">
														<option value=""> Select state</option>
														@foreach ($states as $state)
														<option value="{{$state->state_id}}" {{($data['state'] ?? '' == $state->state_id)?'selected':''}}>{{$state->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-location-pin"></i>
													</div>
													<select id="exampleCountry" class="form-control required"
														name="country">
														<option value=""> Select country</option>
														@foreach ($countries as $country)
														<option value="{{$country->id}}" {{($data['country'] ?? '' == $country->id)?'selected':''}}>{{$country->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-group mb-0">
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-lock"></i></div>
													<input type="password" class="form-control" id="password_1"
														name="password"
														placeholder="Password (Leave it blank for default)" >
												</div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>

							<h3><span class="number"><i class="icon-bag txt-black"></i></span><span
									class="head-font capitalize-font">Work Information</span></h3>
							<fieldset>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-wrap">
											<div class="form-group">
												<label class="control-label mb-10" for="storeName">:</label>
												<div class="input-group">
													<div class="input-group-addon d-sm-none">{{ url('/').'/' }}</div>
													<input id="storeName" type="text" name="store_name"
														class="form-control required" value="{{$data['store_name'] ?? ''}}"/>
												</div>

											</div>
											<div class="form-group">
												<label class="control-label mb-10" for="storeDesc">Description:</label>
												<input id="storeDesc" type="text" name="store_desc"
													class="form-control required" value="{{$data['store_desc'] ?? ''}}" />
											</div>
											
											<div class="form-group">
												<label class="control-label mb-10" for="stateName">State:</label>
												<select id="stateName" class="form-control required" name="store_state">
													@foreach ($states as $state)
													<option value="{{$state->state_id}}" {{($data['state_id'] ?? '' == $state->state_id)?'selected':''}}>{{$state->name}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label class="control-label mb-10" for="storeCountry">Country</label>
												<select id="storeCountry" class="form-control required"
													name="store_country">
													@foreach ($countries as $country)
													<option value="{{$country->id}}" {{($data['store_country'] ?? '' == $country->id)?'selected':''}}>{{$country->name}}</option>
													@endforeach
												</select>
											</div>


											<div class="form-group">
												<label class="control-label mb-10" for="referer">How Did You Hear About
													Ebeano Market</label>
												<select id="referer" class="form-control required" name="referer">
													<option value="fy">Flyer</option>
													<option value="fb">Facebook</option>
													<option value="tw">Twitter</option>
													<option value="gg">Google</option>
													<option value="in">Instagram</option>
													<option value="wa">Website ads</option>
													<option value="ff">From a friend</option>
												</select>
											</div>

											<div class="form-group">
												<label class="control-label mb-10" for="refBy">You were reffered by:
												</label>
												<input id="refBy" type="text" name="ref_code"
													class="form-control required" placeholder="Enter Referral Code" value="{{$data['ref_code'] ?? ''}}"/>
											</div>

											<div class="form-group mb-0">
												<div class="checkbox checkbox-success">
													<input id="term_check" value="1" name="term-check" class="required"
														type="checkbox">
													<label for="term_check">By click continue you accept <a
															href="{{url('terms')}}">our artisans terms and
															conditions.</a></label>
												</div>
											</div>

										</div>
									</div>
								</div>
							</fieldset>

							<h3><span class="number"><i class=" icon-arrows txt-black"></i></span><span
									class="head-font capitalize-font">Complete registration</span></h3>
							<fieldset>
								<div class="row">
									<div class="col-sm-8">
										<p> Click on the register button to complete artisan registration</p>
									</div>
									<div class="col-sm-4">

										<input type="submit" class="btn btn-success btn-anim" name="regiseter"
											value="Register" />
									</div>
								</div>

							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->
</div>
@endsection