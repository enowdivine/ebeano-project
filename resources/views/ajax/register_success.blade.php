@extends('layouts.seller')

@section('title', 'Become A Seller')

@section('link')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="{{ asset('assets/css/seller.css') }}" type="text/css" media="all">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<style>
    .ct-down {
        width: 100%;
        text-align: center;
    }

    .timer {
        text-align: center;
        margin: 0 auto;
        font-size: 60px;
        padding: 1px 0;
        color: #777;
        width: 160px;
        height: auto;
        border-radius: 50%;
        background-color: #f2f2f2;
    }

    #demo {

        top: 20px;
    }
</style>
@endsection

@section('content')

<div class="section px-3 m-2">
    <div class="row mb-4">
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
    <div class="ct-down">
        <div class="timer">
            <p id="demo"></p>
        </div>
        <p>Please wait...</p>
    </div>
</div>
@endsection

@section('script')
<script>
    // Set the date we're counting down to
    var countDownDate = 5;
    document.getElementById("demo").innerHTML = countDownDate;
    // Update the count down every 1 second
    var x = setInterval(function() {
        // If the count down is over, write some text 
        if (countDownDate > 0) {
            countDownDate = countDownDate - 1;
            document.getElementById("demo").innerHTML = countDownDate;
            if (countDownDate == 0) {
                location.href ='{{route('vendor.payment')}}';
            }
            
        } else {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "0";
            
        }
    }, 1000);
</script>
@endsection