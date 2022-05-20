@extends('layouts.theme')

@section('title', 'Dashboard')

@section('content')
<div class="row">
@php
//    $name = Str::of(Auth::user()->name)->explode(' ');
//    $user_name = $name[0];

   $user_id = Auth::user()->id;

   $seller = App\Seller::where('user_id',$user_id)->first();
   
   $seller_id = $seller->id;
   
   $store = App\Store::where('seller_id',$seller_id)->first();
   if (Auth::user()->user_type == 'admin'){
       $seller_id = $user_id;
   }
@endphp
@php
    $earning = 0.00;

    $withdrawals = App\SellerWithdrawRequest::where('approved',1)
        ->where('user_id',$user_id)
        ->sum('amount');
    $last_withdrawal = App\SellerWithdrawRequest::select('amount')
        ->where('approved',1)
        ->where('user_id',$user_id)
        ->max('id');
    $balance = Auth::user()->balance;
   
    $total_sales = App\Product::where('user_id',$user_id)->sum('num_of_sale');
    $today = date("Y-m-d");
    $today_sales =  0.00;

@endphp
    <div class="col-lg-3">

       @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Account Overview</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded mb-4">
                            
                            <div class="card-body">
                                <label class="control-label font-weight-bold mb-10 text-left" for="weight">My store</label>
                                <div class="input-group">
                                    <input id="storeLink" class="form-control" name="store_link" value="https://ebeanomarket.com/stores/visit/{{$store->slug}}" readonly>
                                    <div class="input-group-append">
                                      <!--<span class="input-group-text">@example.com</span>-->
                                      <button class="input-group-text btn btn-default" onclick="copyLink()">Copy</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card rounded mb-4">
                            <div class="card-title d-flex mb-0 border-bottom p-2 justify-content-between">
                                <h5 class=" font-weight-light ">Personal Details</h5>
                                <a href="{{route('user.edit_profile')}}" class="btn btn-sm btn-default"><i class="la link la-edit">Update Info</i></a>
                            </div>
                            <div class="card-body">
                            <h6 class="m-0">{{(Auth::user()->name)}}</h6>
                               <span class="d-block">{{(Auth::user()->email) }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card wallet rounded mb-4">
                            <div class="card-title mb-0  border-bottom p-2 d-flex justify-content-between">
                                <h5 class=" font-weight-light">Earning</h5>
                                <a href="" class="btn btn-sm"><i class="la link la-eye"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="font-weight-bold text-center mb-2 amt">
                                <span class="">Total Earning:</span><span class="text-primary"> ₦ {{number_format($earning,2)}}<span>
                                </div>
                                <div class="font-weight-bold text-center mb-2 amt">
                                    <span class="">Total withdrawn:</span> <span class="text-warning"> ₦ {{number_format($withdrawals,2)}}<span>
                                </div>
                                <div class="font-weight-bold text-center mb-2 amt">
                                    <span class="">Last Withdrawal:</span><span class="text-info"> ₦ {{number_format($last_withdrawal,2)}}<span>
                                </div>
                                <div class="font-weight-bold text-center amt">
                                    <span class="">Balance:</span><span class="text-success"> ₦ {{number_format($balance,2)}}<span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class=" card rounded mb-4">
                            <div class="card-title mb-0 border-bottom p-2 d-flex justify-content-between">
                                <h5 class=" font-weight-light">Total sales</h5>
                                <a href="{{route('seller.sales')}}" class="btn btn-sm"><i class="la link la-eye"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="font-weight-bold text-center amt">
                                    <span class="">{{$total_sales}}<span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class=" card rounded mb-4">
                            <div class="card-title mb-0 border-bottom p-2 d-flex justify-content-between">
                                <h5 class=" font-weight-light">Todays sale</h5>
                                <a href="" class="btn btn-sm"><i class="la link la-eye"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="font-weight-bold text-center amt">
                                    <span class="">{{$today_sales}}<span>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('script')
<script>
    function copyLink() {
  /* Get the text field */
  var copyText = document.getElementById("storeLink");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
@endsection