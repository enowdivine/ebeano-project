@extends('layouts.seller')

@section('title', 'Become A Seller')

@section('link')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="{{ asset('assets/css/seller.css') }}" type="text/css" media="all">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<style>
    .up-user {
        font-size: 0.8rem;
        min-width:150px ;
    }
</style>
@endsection

@section('content')
<div class="section px-3 m-2">

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 bg-white">
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
                  @php
                    if (isset($_GET["logged"] && $_GET["logged"] == true){
                        $data = App\User::where('id',Auth::user()->id)->get();
                    }
                  @endphp
                  @if(Auth::user())
                  <div class="up-user m-auto">
                      <div class="card shadow">
                          <div class="card-body">
                              <h5>Continue with your this Account</h5>
                              <a href="/vendors/quick/registration?logged=true" class="btn btn-sm btn-default">Continue</a>
                          </div>
                      </div>
                  </div>
                  @else
                <h2 id="heading">Sign Up For Ebeano Vendor Account</h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform" action="{{route('vendor.register_store')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="personal"><strong>Personal</strong></li>
                        <li id="business"><strong>Busines Information</strong></li>
                        <li id="payment"><strong>Bank Info</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                
                            </div>
                            <div class="form-wrap">
                                <div class="form-group">
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control required" name="name"
                                    id="exampleInputuname" placeholder="Full Name" value="{{ ($data['name']) ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" class="form-control required"
                                            id="exampleInputEmail" name="email" placeholder="Email address" value="{{$data['email'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="phone" type="tel" class="form-control required"
                                            name="phone" placeholder="+2348000000000" value="{{$data['phone'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control required" name="address"
                                            id="exampleInputAddress" placeholder="Address of residence" value="{{$data['address'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control required" name="city"
                                            id="exampleInputCity" placeholder="City" value="{{$data['city'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
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
                                        <select id="exampleCountry" class="form-control required"
                                            name="country">
                                            <option value=""> Select country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}" {{($country->code == 'NG')?'selected':''}}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_1"
                                            name="password"
                                            placeholder="Password" >
                                    </div>
                                </div>
                            </div>
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Business Information:</h2>
                                </div>
                            </div> 
                            <div class="form-wrap">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="businessName">Business name:</label>
                                    
                                        
                                        <input id="businessName" type="text" name="business_name"
                                            class="form-control required" value="{{$data['business_name'] ?? ''}}"/>
                                  

                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="businessDesc">Business Description:</label>
                                    <textarea id="businessDesc" type="text" name="business_desc"
                                        class="form-control required"> {{$data['business_desc'] ?? ''}} </textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10" for="vendorType">Vendor Account
                                        type</label>
                                    <select id="vendorType" class="form-control required"
                                        name="vendor_type">
                                        <option value="seller">Seller</option>
                                        <option value="artisan">Artisan</option>

                                    </select>
                                </div>

                                <div id="vendor_input">

                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10" for="addressDetail">Address:</label>
                                    <input id="addressDetail" type="text" name="business_address"
                                        class="form-control required"  value="{{$data['business_address'] ?? ''}}"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="businessCity">City:</label>
                                    <input id="businessCity" type="text" name="business_city"
                                        class="form-control required" value="{{$data['business_city'] ?? ''}}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="nearestPlace">Nearest Bus
                                        stop:</label>
                                    <input id="nearestPlace" type="text" name="nearest_bus_stop"
                                        class="form-control" value="{{$data['nearest_bus_stop'] ?? ''}}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="stateName">State:</label>
                                    <select id="stateName" class="form-control required" name="business_state">
                                        @foreach ($states as $state)
                                        <option value="{{$state->state_id}}" {{($data['state_id'] ?? '' == $state->state_id)?'selected':''}}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10" for="businessCountry">Country</label>
                                    <select id="businessCountry" class="form-control required"
                                        name="business_country">
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}" {{($country->code == 'NG')?'selected':''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10" for="referer">How Did You Hear About
                                        Ebeano Market</label>
                                    <select id="referer" class="form-control required" name="referer">
                                        <option value="flyer">Flyer</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="google">Google</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="marketer">Marketer</option>
                                        <option value="website-ads">Website ads</option>
                                        <option value="friend">From a friend</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10" for="refBy">You were reffered by:
                                    </label>
                                    <input id="refBy" type="text" name="ref_code"
                                        class="form-control required" placeholder="Enter Referral Code" value="{{$data['ref_code'] ?? ''}}"/>
                                </div>

                                

                            </div>
                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Bank Information</h2>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="bank">Bank:</label>
                                <select id="bank" name="bank_name" class="form-control required">
                                    @foreach ($banks as $bank)
                                    <option value="{{$bank->id}}" {{($data['bank_name'] ?? '' == $bank->id)?'selected':''}}>{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="accNo">Account Number:</label>
                                <input type="text" id="accNo" class="form-control required"
                                    name="bank_account_no" value="{{$data['bank_account_no'] ?? ''}}" />
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="accName">Account Name:</label>
                                <input type="text" id="accName" class="form-control  required"
                                    name="bank_account_name" value="{{$data['bank_account_name'] ?? ''}}" />
                            </div>
                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish</h2>
                                </div>
                                <div class="form-group">
                                    
                                    <h5 class="mx-3">You will be required to pay your registration fee before your account will be activated</h5>
                                    <div class="form-check mt-4">
                                        <input id="term_check" value="1" name="term-check " class="required"
                                            type="checkbox">
                                        <label for="term_check" class="form-check-label">By clicking Register, you accept <a
                                                href="{{url('terms')}}">our sellers terms and
                                                conditions.</a></label>
                                    </div>
                                </div>
                            </div>
                        </div><input type="submit" name="next" class="next action-button" value="Register" /><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                </form>
                @endif
            </div>
        </div>
    </div>
</div> {{--section end--}}
@endsection

@section('script')

<!-- Form Wizard JavaScript -->
<script src="https://ebeanomarket.com/assets/vendors/bower_components/jquery.steps/build/jquery.steps.min.js"></script>
<script src="https://ebeanomarket.com/assets/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){

var current_fs, next_fs, previous_fs,i,y, valid=true; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();
y = current_fs.find(".required");
x = $(".required").val();
// for (i = 0; i < y.length; i++) {
//     // If a field is empty...
//     if (x == "") {
//       // add an "invalid" class to the field:
//       y.addClass("invalid");
//       // and set the current valid status to false:
//       valid = false;
//     }
//   }
//   // If the valid status is true, mark the step as finished and valid:
//   if (!valid) {
//     return false;
//   }

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();


//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});

$('#vendorType').on('change', function() {
    loadSpecifiedInput();
	});
function loadSpecifiedInput(){
        var type = $('#vendorType').val();
        $.post('{{ route('vendor.load_input') }}', {_token:'{{ csrf_token() }}', vendor_type: type}, function(data){
            $('#vendor_input').html(data);
        });
    }

    </script>
@endsection