@extends('layouts.seller')

@section('title', 'Become A Seller')

@section('link')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="{{ asset('assets/css/seller.css') }}" type="text/css" media="all">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div class="section px-3">

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pb-0 mt-3 mb-3 bg-white">
                <div class="row">
                    <div class="col-sm-12">
                      @if(Session::has('success') && !empty(Session::get('success')))
                      <div class="alert alert-success">
                        {{Session::get('success')}}
                      </div>
                      @endif
                
                      @if(Session::has('error') && !empty(Session::get('error')))
                      <div class="alert alert-warning">
                        {!!Session::get('error')!!}
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
                <h4 id="heading">Generate Ebeano Marketer/Referal Code</h4>
                <p>Fill all fields to get your code. If you are a registered user enter the email address you registered with</p>
                
                <a href="{{route('show.refUsers')}}" class="btn btn-success py-3">Check Your Registration Report</a>
                
                <form id="msform" action="{{route('store.refCode')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <fieldset>
                        <div class="form-card">
                            
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
   
                            </div>
                        </div><input type="submit" name="submit" class="next action-button text-white" value="Get Code" />
                    </fieldset>
                </form>
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