@extends('layouts.theme')

@section('title', 'Ebeano Express Bills Payment')
<link rel="stylesheet" href="{{ asset('assets/css/ebeano-express.css') }}" type="text/css" media="all">
    
@section('content')

@section('links')
<!-- custom -->
    <link
      href="{{ asset('assets/homepage/assets/css/custom.css') }}"
      type="text/css"
      rel="stylesheet"
      media="all"
    />
@endsection
<style>
    .md-form { position: relative; }
    i.prefix { position: absolute; top: 10px; left: 50px; }
    table{
        font-size:12px;
        font-family:arial;
    }
    .input-group {
        margin-bottom: 2px;
    }
</style>
    <div class="section" style="padding-top:25px">
        <h2 class="text-center">Instant Bill Payments Available!</h2>
    </div>
    <div class="section justify-content-center" style="padding-top:20px">

        <div class="order-0 order-md-0 col-lg-6 order-lg-1 col-sm-12 ml-lg-5">
            <div _ngcontent-c6="" class="row"><!---->
                <div _ngcontent-c6="" class="col-lg-3 col-md-3 col-6 text-center m-b-20 rf-item ng-star-inserted mb-5">
                    <div _ngcontent-c6="" class="quick-link-wrapper d-flex justify-content-center">
                        <div _ngcontent-c6="" class="feature wow fadeInRight animated animated" style="visibility: visible; animation-name: fadeInRight; position: relative;"><!---->
                            <span _ngcontent-c6="" class="badge badge-success feature-label ng-star-inserted">AUTOMATED</span>
                            <div _ngcontent-c6="" class="rf-icon">
                                <div _ngcontent-c6="" class="oval-bg">
                                   <a href="" data-toggle="modal" data-target="#BuyAirtime">
                                    <img _ngcontent-c6="" src="{{ asset('assets/images/buy_airtime.svg') }}" class="d-none d-md-inline-flex  ">
                                    <img _ngcontent-c6="" src="{{ asset('assets/images/buy_airtime.svg') }}" class="d-md-none  ">
                                   </a>
                                </div>
                            </div>
                            <div _ngcontent-c6="" class="rf-desc mt-3 mb-1 text-truncate text-center"> <a href="" data-toggle="modal" data-target="#BuyAirtime" style="color: #212529;">Buy Airtime</a> </div>
                        </div>
                    </div>
                </div>
                <div _ngcontent-c6="" class="col-lg-3 col-md-3 col-6 text-center m-b-20 rf-item ng-star-inserted mb-5">
                    <div _ngcontent-c6="" class="quick-link-wrapper d-flex justify-content-center">
                        <div _ngcontent-c6="" class="feature wow fadeInRight animated animated" style="visibility: visible; animation-name: fadeInRight; position: relative;"><!---->
                            <span _ngcontent-c6="" class="badge badge-success feature-label ng-star-inserted">AUTOMATED</span>
                            <div _ngcontent-c6="" class="rf-icon">
                                <div _ngcontent-c6="" class="oval-bg">
                                   <a href="" data-toggle="modal" data-target="#BuyData">
                                    <img _ngcontent-c6="" src="{{ asset('assets/images/buy_data.svg') }}" class="d-none d-md-inline-flex ">
                                    <img _ngcontent-c6="" src="{{ asset('assets/images/buy_data.svg') }}" class="d-md-none  ">
                                   </a>
                                </div>
                            </div>
                            <div _ngcontent-c6="" class="rf-desc mt-3 mb-1 text-truncate text-center"> <a href="" data-toggle="modal" data-target="#BuyData" style="color: #212529;">Buy Data</a> </div>
                        </div>
                    </div>
                </div>
                <div _ngcontent-c6="" class="col-lg-3 col-md-3 col-6 text-center m-b-20 rf-item ng-star-inserted mb-5">
                    <div _ngcontent-c6="" class="quick-link-wrapper d-flex justify-content-center">
                        <div _ngcontent-c6="" class="feature wow fadeInRight animated animated" style="visibility: visible; animation-name: fadeInRight; position: relative;"><!---->
                            <span _ngcontent-c6="" class="badge badge-success feature-label ng-star-inserted">AUTOMATED</span>
                            <div _ngcontent-c6="" class="rf-icon">
                                <div _ngcontent-c6="" class="oval-bg">
                                    <a href="" data-toggle="modal" data-target="#BuyPower">
                                        <img _ngcontent-c6="" src="{{ asset('assets/images/buy_electricity.svg') }}" class="d-none d-md-inline-flex ">
                                        <img _ngcontent-c6="" src="{{ asset('assets/images/buy_electricity.svg') }}" class="d-md-none ">
                                    </a>
                                </div>
                            </div>
                            <div _ngcontent-c6="" class="rf-desc mt-3 mb-1 text-truncate text-center"> <a href="" data-toggle="modal" data-target="#BuyPower" style="color: #212529;">Buy Electricity</a> </div>
                        </div>
                    </div>
                </div>
                <div _ngcontent-c6="" class="col-lg-3 col-md-3 col-6 text-center m-b-20 rf-item ng-star-inserted mb-5">
                    <div _ngcontent-c6="" class="quick-link-wrapper d-flex justify-content-center">
                        <div _ngcontent-c6="" class="feature wow fadeInRight animated animated" style="visibility: visible; animation-name: fadeInRight; position: relative;"><!---->
                            <span _ngcontent-c6="" class="badge badge-success feature-label ng-star-inserted">AUTOMATED</span>
                            <div _ngcontent-c6="" class="rf-icon">
                                <div _ngcontent-c6="" class="oval-bg">
                                    <a href="" data-toggle="modal" data-target="#BuyCable">
                                        <img _ngcontent-c6="" src="{{ asset('assets/images/pay_cable.svg') }}" class="d-none d-md-inline-flex  ">
                                        <img _ngcontent-c6="" src="{{ asset('assets/images/pay_cable.svg') }}" class="d-md-none  ">
                                    </a>
                                </div>
                            </div>
                            <div _ngcontent-c6="" class="rf-desc mt-3 mb-1 text-truncate text-center"> <a href="" data-toggle="modal" data-target="#BuyCable" style="color: #212529;">Cable TV</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--modals-->
<div class="modal fade" id="BuyAirtime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Buy Instant Airtime</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
          
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
          <input type="number" id="airtime_phone" placeholder="Enter Phone No" class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
          <select id="airtime_network" name="findBillingService" class="form-control validate">
              <option value="">--Choose network--</option>
                @if($api=='epin')
                    @foreach($mobilebill as $value)
                      <option value="{{$value}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @elseif($api=='sub9ja')
                    @foreach($mobilebill as $value)
                      <option value="{{$value}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @else
                    @foreach($mobilebill as $key => $value)
                      <option value="{{$value->billerid}}" data-name="{{$value->billername}}">{{$value->billername}}</option>
                    @endforeach
                @endif
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-bolt"></i></span>
            </div>
          <select id="payment_service" name="findPaymentService" class="form-control validate">
              <option>--Choose Items--</option>
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">&#8358;</span>
            </div>
          <input type="number" id="airtime_amount" placeholder="Enter Amount" class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
          <input type="text" id="airtime_email" placeholder="Email Address" class="form-control validate">
          <input type="hidden" id="airtime_token" value="{{$airtime_token}}">
          <input type="hidden" id="billingService">
          <input type="hidden" id="paymentService">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="btn" class="btn btn-default" data-toggle="modal" data-target="#BuyAirtimeSummary" onclick="ProceedAirtimeSummary()" data-dismiss="modal">Proceed <i class="la la-send"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="BuyData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Buy Instant Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
          <input type="number" id="data_phone" placeholder="Enter Phone No" class="form-control validate">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
          <select id="data_network" name="findBillingServiceData" class="form-control validate">
              <option>--Choose network--</option>
                @if($api=='epin')
                    @foreach($databill as $value)
                      <option value="{{$value}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @elseif($api=='sub9ja')
                    @foreach($databill as $value)
                      <option value="{{$value}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @else
                    @foreach($databill as $key => $value)
                      <option value="{{$value->billerid}}" data-name="{{$value->billername}}">{{$value->billername}}</option>
                    @endforeach
                @endif
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-bolt"></i></span>
            </div>
          <select id="data_package" name="findPaymentServiceData" class="form-control validate">
              <option>--Waiting for network--</option>
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
          <input type="text" id="data_email" placeholder="Email Address" class="form-control validate">
          <input type="hidden" id="data_token" value="{{$data_token}}">
          <input type="hidden" id="billingServiceData">
          <input type="hidden" id="paymentServiceData">
          <input type="hidden" id="data_amount">
          <input type="hidden" id="data_packageName">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="btn" class="btn btn-default" data-toggle="modal" data-target="#BuyDataSummary" onclick="ProceedDataSummary()" data-dismiss="modal">Proceed <i class="la la-send"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="BuyCable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Buy Cable TV</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tv"></i></span>
            </div>
          <input type="number" id="cable_smartcard" placeholder="Enter Smartcard No" class="form-control validate">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
            </div>
          <select id="cable_brand" name="findBillingServiceCable" class="form-control validate">
              <option value="">--Choose brand--</option>
                @if($api=='epin')
                    @foreach($cablebill as $key => $value)
                      <option value="{{$key}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @elseif($api=='sub9ja')
                    @foreach($cablebill as $key => $value)
                      <option value="{{$key}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @else
                    @foreach($cablebill as $key => $value)
                       <option data-name="{{$value->billername}}" value="{{$value->billerid}}">{{$value->billername}}</option>
                    @endforeach
                @endif
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-bolt"></i></span>
            </div>
          <select id="cable_package" name="findPaymentServiceCable" class="form-control validate">
              <option>--Choose plan--</option>
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
          <input type="text" id="cable_customer" placeholder="Customer Name" readonly class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
          <input type="number" id="cable_phone" placeholder="Enter Phone" class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
          <input type="text" id="cable_email" placeholder="Email Address" class="form-control validate">
          <input type="hidden" id="cable_token" value="{{$cable_token}}">
          <input type="hidden" id="billingServiceCable">
          <input type="hidden" id="paymentServiceCable">
          <input type="hidden" id="cable_amount">
          <input type="hidden" id="cable_packageName">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="btnCable" class="btn btn-default" data-toggle="modal" data-target="#BuyCableSummary" onclick="ProceedCableSummary()" data-dismiss="modal">Proceed <i class="la la-send"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="BuyPower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Buy Instant Electricity</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
          
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="la la-lightbulb"></i></span>
            </div>
          <input type="number" id="meter_no" placeholder="Enter Meter No" class="form-control validate">
        </div>

        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
            </div>
          <select id="meter_name" name="findBillingServiceMeter" class="form-control validate">
              <option value="">--Choose distribution--</option>
                @if($api=='epin')
                    @foreach($powerbill as $key => $value)
                      <option value="{{$key}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @elseif($api=='sub9ja')
                    @foreach($powerbill as $key => $value)
                      <option value="{{$key}}" data-name="{{$value}}">{{$value}}</option>
                    @endforeach
                @else
                  @foreach($powerbill as $key => $value)
                      <option data-name="{{$value->billername}}" value="{{$value->billerid}}">{{$value->billername}}</option>
                  @endforeach
                @endif
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-bolt"></i></span>
            </div>
          <select id="meter_package" name="findPaymentServiceMeter" class="form-control validate">
              <option>--Choose plan--</option>
          </select>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">&#8358;</span>
            </div>
          <input type="number" id="meter_amount" placeholder="Enter Amount" class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
          <input type="text" id="meter_customer" placeholder="Customer Name" readonly class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
          <input type="number" id="meter_phone" placeholder="Enter Phone" class="form-control validate">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
          <input type="text" id="meter_email" placeholder="Email Address" class="form-control validate">
          <input type="hidden" id="meter_token" value="{{$power_token}}">
          <input type="hidden" id="billingServiceMeter">
          <input type="hidden" id="paymentServiceMeter">
          <input type="hidden" id="meter_packageName">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="btnMeter" class="btn btn-default" data-toggle="modal" data-target="#BuyMeterSummary" onclick="ProceedMeterSummary()" data-dismiss="modal">Proceed <i class="la la-send"></i></button>
      </div>
    </div>
  </div>
</div>

<!--Transactions Summary -->

<!--for Airtime-->
<div class="modal fade" id="BuyAirtimeSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Transaction Summary</h4>
      </div>
      
      <form id="airtime-payment">
      <div class="modal-body mx-3">
           <div class="table-responsive">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Network</th>
                      <td><span id="summary_network"></span></td>
                    </tr>
                    <tr>
                      <th>Transaction ID</th>
                      <td><span id="summary_token"></span></td>
                    </tr>
                    <tr>
                      <th>Phone Number</th>
                      <td><span id="summary_phone"></span></td>
                    </tr>
                    <tr>
                      <th>Amount (₦)</th>
                      <td><span id="summary_amount"></span></td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td><span id="summary_email"></span></td>
                    </tr>
                    <tr>
                      <th>Payment method</th>
                      <td>
                        <select id="payoption" class="form-control"
                          >
                          <option value="" disabled="disabled">Choose your option</option
                          ><option value="1">Pay with Card</option
                          ><option value="4" disabled>Pay with Wallet</option>
                        </select
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          
      </div>
      <div class="modal-footer d-flex">
        <button class="btn btn-default" data-toggle="modal" data-target="#BuyAirtime" data-dismiss="modal">&laquo; Back</button>
        <button type="submit" class="btn btn-default pull-right" id="payAirtime">Pay</button>
      </div>
      
      </form>
      
    </div>
  </div>
</div>

<!--for Databundle-->
<div class="modal fade" id="BuyDataSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Transaction Summary</h4>
      </div>
      
      <form id="data-payment">
      <div class="modal-body mx-3">
           <div class="table-responsive">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Network</th>
                      <td><span id="summary_data_package"></span></td>
                    </tr>
                    <tr>
                      <th>Databundle</th>
                      <td><span id="summary_data_packageName"></span></td>
                    </tr>
                    <tr>
                      <th>Transaction ID</th>
                      <td><span id="summary_data_token"></span></td>
                    </tr>
                    <tr>
                      <th>Phone Number</th>
                      <td><span id="summary_data_phone"></span></td>
                    </tr>
                    <tr>
                      <th>Amount (₦)</th>
                      <td><span id="summary_data_amount"></span></td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td><span id="summary_data_email"></span></td>
                    </tr>
                    <tr>
                      <th>Payment method</th>
                      <td>
                        <select id="data_payoption" class="form-control"
                          >
                          <option value="" disabled="disabled">Choose your option</option
                          ><option value="1">Pay with Card</option
                          ><option value="4" disabled>Pay with Wallet</option>
                        </select
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          
      </div>
      <div class="modal-footer d-flex">
        <button class="btn btn-default" data-toggle="modal" data-target="#BuyData" data-dismiss="modal">&laquo; Back</button>
        <button type="submit" class="btn btn-default pull-right" id="payData">Pay</button>
      </div>
      
      </form>
      
    </div>
  </div>
</div>

<!--for Cable TV-->
<div class="modal fade" id="BuyCableSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Transaction Summary</h4>
      </div>
      
      <form id="cable-payment">
      <div class="modal-body mx-3">
           <div class="table-responsive">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Decoder Brand</th>
                      <td><span id="summary_cable_package"></span></td>
                    </tr>
                    <tr>
                      <th>Decoder Package</th>
                      <td><span id="summary_cable_packageName"></span></td>
                    </tr>
                    <tr>
                      <th>SmartCard Number</th>
                      <td><span id="summary_cable_smartcard"></span></td>
                    </tr>
                    <tr>
                      <th>Transaction ID</th>
                      <td><span id="summary_cable_token"></span></td>
                    </tr>
                    <tr>
                      <th>Customer Phone</th>
                      <td><span id="summary_cable_phone"></span></td>
                    </tr>
                    <tr>
                      <th>Customer Name</th>
                      <td><span id="summary_cable_customer"></span></td>
                    </tr>
                    <tr>
                      <th>Amount (₦) <b>(+ N100 Processing fee)</b></th>
                      <td><span id="summary_cable_amount"></span></td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td><span id="summary_cable_email"></span></td>
                    </tr>
                    <tr>
                      <th>Payment method</th>
                      <td>
                        <select id="cable_payoption" class="form-control"
                          >
                          <option value="" disabled="disabled">Choose your option</option
                          ><option value="1">Pay with Card</option
                          ><option value="4" disabled>Pay with Wallet</option>
                        </select
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          
      </div>
      <div class="modal-footer d-flex">
        <button class="btn btn-default" data-toggle="modal" data-target="#BuyCable" data-dismiss="modal">&laquo; Back</button>
        <button type="submit" class="btn btn-default pull-right" id="payCable">Pay</button>
      </div>
      
      </form>
      
    </div>
  </div>
</div>


<!--for Meter -->
<div class="modal fade" id="BuyMeterSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Transaction Summary</h4>
      </div>
      
      <form id="meter-payment">
      <div class="modal-body mx-3">
           <div class="table-responsive">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Meter Name</th>
                      <td><span id="summary_meter_package"></span></td>
                    </tr>
                    <tr>
                      <th>Meter Type</th>
                      <td><span id="summary_meter_packageName"></span></td>
                    </tr>
                    <tr>
                      <th>Meter Number</th>
                      <td><span id="summary_meter_no"></span></td>
                    </tr>
                    <tr>
                      <th>Transaction ID</th>
                      <td><span id="summary_meter_token"></span></td>
                    </tr>
                    <tr>
                      <th>Customer Phone</th>
                      <td><span id="summary_meter_phone"></span></td>
                    </tr>
                    <tr>
                      <th>Customer Name</th>
                      <td><span id="summary_meter_customer"></span></td>
                    </tr>
                    <tr>
                      <th>Amount (₦)</th>
                      <td><span id="summary_meter_amount"></span></td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td><span id="summary_meter_email"></span></td>
                    </tr>
                    <tr>
                      <th>Payment method</th>
                      <td>
                        <select id="meter_payoption" class="form-control"
                          >
                          <option value="" disabled="disabled">Choose your option</option
                          ><option value="1">Pay with Card</option
                          ><option value="4" disabled>Pay with Wallet</option>
                        </select
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          
      </div>
      <div class="modal-footer d-flex">
        <button class="btn btn-default" data-toggle="modal" data-target="#BuyMeter" data-dismiss="modal">&laquo; Back</button>
        <button type="submit" class="btn btn-default pull-right" id="payMeter">Pay</button>
      </div>
      
      </form>
      
    </div>
  </div>
</div>

@endsection
 
 
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        $(document).ready(function(){
            
            $('select[name=findBillingService]').change(function(){
              $('#billingService').val($(this).children('option:selected').data('name'));
            });
            $('select[name=findPaymentService]').change(function(){
              $('#paymentService').val($(this).children('option:selected').data('name'));
            });
            
            $('select[name=findBillingServiceData]').change(function(){
              $('#billingServiceData').val($(this).children('option:selected').data('name'));
            });
            $('select[name=findPaymentServiceData]').change(function(){
              $('#paymentServiceData').val($(this).children('option:selected').data('name'));
              $('#data_amount').val($(this).children('option:selected').data('amount'));
              $('#data_packageName').val($(this).children('option:selected').data('item'));
            });
            
            $('select[name=findBillingServiceCable]').change(function(){
              $('#billingServiceCable').val($(this).children('option:selected').data('name'));
            });
            $('select[name=findPaymentServiceCable]').change(function(){
              $('#paymentServiceCable').val($(this).children('option:selected').data('name'));
              $('#cable_amount').val($(this).children('option:selected').data('amount'));
              $('#cable_packageName').val($(this).children('option:selected').data('item'));
            });
            
            $('select[name=findBillingServiceMeter]').change(function(){
              $('#billingServiceMeter').val($(this).children('option:selected').data('name'));
            });
            $('select[name=findPaymentServiceMeter]').change(function(){
              $('#paymentServiceMeter').val($(this).children('option:selected').data('name'));
              $('#meter_packageName').val($(this).children('option:selected').data('item'));
            });
            
            // select list of services
            $('#airtime_network').on('change',function(e) {
                $('#btn').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Fetching...')
                $('#btn').prop('disabled', true)
                $.post('{{ route('get-services') }}', {_token:'{{ csrf_token() }}', type:'html', service:'airtime', billerid:e.target.value}, function(data){
                    $('#payment_service').html(data)
                    $('#btn').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                });
            })
            
            // data
            $('#data_network').on('change',function(e) {
                $('#btn').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Fetching...')
                $('#btn').prop('disabled', true)
                $.post('{{ route('get-services') }}', {_token:'{{ csrf_token() }}', type:'html', service:'data', billerid:e.target.value}, function(data){
                    $('#data_package').html(data)
                    $('#btn').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                });
            })
            
            // cable
            $('#cable_brand').on('change',function(e) {
                $('#btnCable').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Fetching plans...')
                $('#btnCable').prop('disabled', true)
                $.post('{{ route('get-services') }}', {_token:'{{ csrf_token() }}', type:'html', service:'cable', billerid:e.target.value}, function(data){
                    $('#cable_package').html(data)
                    $('#btnCable').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                });
            })
            // verify customer
            $('#cable_package').on('change',function(e) {
                $('#btnCable').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Verifying...')
                $('#btnCable').prop('disabled', true)
                $.post('{{ route('validate-customer') }}', {_token:'{{ csrf_token() }}', type:'html', service:'cable', customer_id:$('#cable_smartcard').val(), package:$('#cable_brand').val()}, function(data){
                    if(data.status=='success'){
                        $('#cable_customer').val(data.customer)
                        $('#btnCable').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                    }else{
                        $('#cable_customer').val(data.customer)
                        $('#btnCable').prop('disabled', true).html('Proceed <i class="la la-send"></i>')
                    }
                    
                });
            })
            
            // meter
            $('#meter_name').on('change',function(e) {
                $('#btnMeter').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Fetching plans...')
                $('#btnMeter').prop('disabled', true)
                $.post('{{ route('get-services') }}', {_token:'{{ csrf_token() }}', type:'html', service:'meter', billerid:e.target.value}, function(data){
                    console.log(data)
                    $('#meter_package').html(data)
                    $('#btnMeter').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                });
            })
            // verify customer
            $('#meter_package').on('change',function(e) {
                $('#btnMeter').html('<i class="spinner-grow spinner-grow-sm" role="status"></i> Verifying...')
                $('#btnMeter').prop('disabled', true)
                $.post('{{ route('validate-customer') }}', {_token:'{{ csrf_token() }}', type:'html', service:'meter', customer_id:$('#meter_no').val(), meter_name:$('#meter_name').val(), package:e.target.value}, function(data){
                    
                    if(data.status =='success') {
                        $('#meter_customer').val(data.customer)
                        $('#btnMeter').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                    }
                    $('#meter_customer').val(data.customer)
                    $('#btnMeter').prop('disabled', false).html('Proceed <i class="la la-send"></i>')
                    
                });
            })
            
        });
        
        
        $("form#airtime-payment").submit(function(e){
          e.preventDefault();
           
          var transaction = {
              customer_phone: $('#airtime_phone').val(),
              amount: $('#airtime_amount').val(),
              billerCode: $('#airtime_network').val(),
              customer_email: $('#airtime_email').val(),
              token: $('#airtime_token').val(),
              service: $('#billingService').val(),
              payment_service: $('#paymentService').val(),
              payment_method: $('#payoption').val(),
              action: 'airtime_payment'
          };
            
          let data = {
              email: transaction.customer_email,
              phone: transaction.customer_phone,
              amount: transaction.amount,
              token: transaction.token,
              billerCode: transaction.billerCode,
              service: transaction.service,
              payment_service: transaction.payment_service,
              btn: 'payAirtime',
              transaction: transaction
          }
        
            if(transaction.payment_method == 1){
                //   invoke paystack
                  PaystackPayment(data) 
            }
    
    	});
    	
    	$("form#data-payment").submit(function(e){
          e.preventDefault();
           
          var transaction = {
              data_phone: $('#data_phone').val(),
              data_package: $('#data_package').val(),
              data_packageName: $('#data_packageName').val(),
              amount: $('#data_amount').val(),
              billerCode: $('#data_network').val(),
              customer_email: $('#data_email').val(),
              token: $('#data_token').val(),
              service: $('#billingServiceData').val(),
              payment_service: $('#paymentServiceData').val(),
              payment_method: $('#data_payoption').val(),
              action: 'data_payment'
          };
            
          let data = {
              email: transaction.customer_email,
              phone: transaction.customer_phone,
              amount: transaction.amount,
              token: transaction.token,
              billerCode: transaction.billerCode,
              service: transaction.service,
              payment_service: transaction.payment_service,
              btn: 'payData',
              transaction: transaction
          }
        
            if(transaction.payment_method == 1){
                //   invoke paystack
                  PaystackPayment(data) 
            }
    
    	});
    	
    	$("form#cable-payment").submit(function(e){
          e.preventDefault();
           
          var transaction = {
              cable_phone: $('#cable_phone').val(),
              cable_smartcard: $('#cable_smartcard').val(),
              cable_package: $('#cable_package').val(),
              cable_packageName: $('#cable_packageName').val(),
              cable_customer: $('#cable_customer').val(),
              amount: $('#cable_amount').val(),
              billerCode: $('#cable_brand').val(),
              customer_email: $('#cable_email').val(),
              token: $('#cable_token').val(),
              service: $('#billingServiceCable').val(),
              payment_service: $('#paymentServiceCable').val(),
              payment_method: $('#cable_payoption').val(),
              action: 'cable_payment'
          };
          
          // add charges
          charges = 100;
          let data = {
              email: transaction.customer_email,
              phone: transaction.customer_phone,
              amount: parseInt(transaction.amount) + parseInt(charges),
              token: transaction.token,
              billerCode: transaction.billerCode,
              service: transaction.service,
              payment_service: transaction.payment_service,
              btn: 'payCable',
              transaction: transaction
          }
        
            if(transaction.payment_method == 1){
                //   invoke paystack
                  PaystackPayment(data) 
            }
    
    	});
    	
    	
    	$("form#meter-payment").submit(function(e){
          e.preventDefault();
           
          var transaction = {
              meter_phone: $('#meter_phone').val(),
              meter_no: $('#meter_no').val(),
              meter_package: $('#meter_package').val(),
              meter_packageName: $('#meter_packageName').val(),
              meter_customer: $('#meter_customer').val(),
              amount: $('#meter_amount').val(),
              billerCode: $('#meter_name').val(),
              customer_email: $('#meter_email').val(),
              token: $('#meter_token').val(),
              service: $('#billingServiceMeter').val(),
              payment_service: $('#paymentServiceMeter').val(),
              payment_method: $('#meter_payoption').val(),
              action: 'meter_payment'
          };
            
          let data = {
              email: transaction.customer_email,
              phone: transaction.customer_phone,
              amount: transaction.amount,
              token: transaction.token,
              billerCode: transaction.billerCode,
              service: transaction.service,
              payment_service: transaction.payment_service,
              btn: 'payMeter',
              transaction: transaction
          }
        
            if(transaction.payment_method == 1){
                //   invoke paystack
                  PaystackPayment(data) 
            }
    
    	});
    </script>
    
    <script>
    
        function SendPurchaseRequest(data = {}) {
            var form = document.createElement("form");
            var element1 = document.createElement("input"); 
            var element2 = document.createElement("input");
            var element3 = document.createElement("input");
            var element4 = document.createElement("input");
            var element5 = document.createElement("input");
            
            form.method = "POST";
            form.action = "{{ route('send-purchase-request') }}";   
        
            element1.value=data.paystack_ref_code;
            element1.name="ref_code";
            form.appendChild(element1);  
        
            element2.value=data.amount;
            element2.name="amount_paid";
            form.appendChild(element2);
            
            element3.value=JSON.stringify(data.transaction);
            element3.name="data";
            form.appendChild(element3);
            
            element4.value="{{ csrf_token() }}";
            element4.name="_token";
            form.appendChild(element4);
            
            element5.value=data.transaction.action;
            element5.name="action";
            form.appendChild(element5);
        
            document.body.appendChild(form);
            form.submit();
        
        }
        
        function RequiredField(value) {
            if(value =='') {
                return "<span class='text-danger'>* Required</span>";
            }else{
                return "<span class='text-success'>"+value+"</span>";
            }
        }
        
        function ProceedAirtimeSummary()
        {
            let validate = false
            let network = $('#airtime_network').val()
            let phone = $('#airtime_phone').val()
            let amount = $('#airtime_amount').val()
            let email = $('#airtime_email').val()
            let token = $('#airtime_token').val()
            let service = $('#billingService').val()
            let payment_service = $('#paymentService').val()
            
            // check
            if(network =="" || phone=="" || amount =="" || email =="" || token=="" || service =="" || payment_service ==""){
                $('#summary_network').html(RequiredField(service))
                $('#summary_phone').html(RequiredField(phone))
                $('#summary_amount').html(RequiredField(amount))
                $('#summary_email').html(RequiredField(email))
                $('#summary_token').html(RequiredField(token))
                
            }else{
                validate = true
                $('#summary_network').html(RequiredField(service))
                $('#summary_phone').html(RequiredField(phone))
                $('#summary_amount').html(RequiredField(amount))
                $('#summary_email').html(RequiredField(email))
                $('#summary_token').html(RequiredField(token))
                
            }
            
            if(validate == false) {
                $('#payAirtime').prop('disabled', true)
            }else{
                $('#payAirtime').prop('disabled', false)
            }
        }
        
        function ProceedDataSummary()
        {
            let validate = false
            let data_phone = $('#data_phone').val()
            let data_package = $('#data_package').val()
            let data_packageName = $('#data_packageName').val()
            let amount = $('#data_amount').val()
            let customer_email = $('#data_email').val()
            let token = $('#data_token').val()
            let service = $('#billingServiceData').val()
            let payment_service = $('#paymentServiceData').val()
            
            // check
            if(data_phone =="" || data_package =="" || customer_email =="" || token=="" || service =="" || payment_service =="" || data_packageName =="" || amount ==""){
                $('#summary_data_phone').html(RequiredField(data_phone))
                $('#summary_data_package').html(RequiredField(service))
                $('#summary_data_email').html(RequiredField(customer_email))
                $('#summary_data_packageName').html(RequiredField(data_packageName))
                $('#summary_data_amount').html(RequiredField(amount))
                $('#summary_data_token').html(RequiredField(token))
                
            }else{
                validate = true
                $('#summary_data_phone').html(RequiredField(data_phone))
                $('#summary_data_package').html(RequiredField(service))
                $('#summary_data_email').html(RequiredField(customer_email))
                $('#summary_data_packageName').html(RequiredField(data_packageName))
                $('#summary_data_amount').html(RequiredField(amount))
                $('#summary_data_token').html(RequiredField(token))
                
            }
            
            if(validate == false) {
                $('#payData').prop('disabled', true)
            }else{
                $('#payData').prop('disabled', false)
            }
        }
        
        function ProceedCableSummary()
        {
            let validate = false
            let cable_phone = $('#cable_phone').val()
            let cable_smartcard = $('#cable_smartcard').val()
            let cable_package = $('#cable_package').val()
            let cable_packageName = $('#cable_packageName').val()
            let cable_customer = $('#cable_customer').val()
            let amount = $('#cable_amount').val()
            let customer_email = $('#cable_email').val()
            let token = $('#cable_token').val()
            let service = $('#billingServiceCable').val()
            let payment_service = $('#paymentServiceCable').val()
            
            // check
            if(cable_phone =="" || cable_smartcard=="" || cable_package =="" || customer_email =="" || token=="" || service =="" || payment_service =="" || cable_packageName =="" || amount ==""){
                $('#summary_cable_phone').html(RequiredField(cable_phone))
                $('#summary_cable_smartcard').html(RequiredField(cable_smartcard))
                $('#summary_cable_package').html(RequiredField(service))
                $('#summary_cable_email').html(RequiredField(customer_email))
                $('#summary_cable_packageName').html(RequiredField(cable_packageName))
                $('#summary_cable_amount').html(RequiredField(amount))
                $('#summary_cable_customer').html(RequiredField(cable_customer))
                $('#summary_cable_token').html(RequiredField(token))
                
            }else{
                validate = true
                $('#summary_cable_phone').html(RequiredField(cable_phone))
                $('#summary_cable_smartcard').html(RequiredField(cable_smartcard))
                $('#summary_cable_package').html(RequiredField(service))
                $('#summary_cable_email').html(RequiredField(customer_email))
                $('#summary_cable_packageName').html(RequiredField(cable_packageName))
                $('#summary_cable_amount').html(RequiredField(amount))
                $('#summary_cable_customer').html(RequiredField(cable_customer))
                $('#summary_cable_token').html(RequiredField(token))
                
            }
            
            if(validate == false) {
                $('#payCable').prop('disabled', true)
            }else{
                $('#payCable').prop('disabled', false)
            }
        }
        
        function ProceedMeterSummary()
        {
            let validate = false
            let meter_phone = $('#meter_phone').val()
            let meter_no = $('#meter_no').val()
            let meter_package = $('#meter_package').val()
            let meter_packageName = $('#meter_packageName').val()
            let meter_customer = $('#meter_customer').val()
            let amount = $('#meter_amount').val()
            let customer_email = $('#meter_email').val()
            let token = $('#meter_token').val()
            let service = $('#billingServiceMeter').val()
            let payment_service = $('#paymentServiceMeter').val()
            
            // check
            if(meter_phone =="" || meter_no=="" || customer_email =="" || token=="" || service =="" || payment_service =="" || meter_packageName =="" || amount ==""){
                $('#summary_meter_phone').html(RequiredField(meter_phone))
                $('#summary_meter_no').html(RequiredField(meter_no))
                $('#summary_meter_package').html(RequiredField(service))
                $('#summary_meter_email').html(RequiredField(customer_email))
                $('#summary_meter_packageName').html(RequiredField(meter_packageName))
                $('#summary_meter_amount').html(RequiredField(amount))
                $('#summary_meter_customer').html(RequiredField(meter_customer))
                $('#summary_meter_token').html(RequiredField(token))
                
            }else{
                validate = true
                $('#summary_meter_phone').html(RequiredField(meter_phone))
                $('#summary_meter_no').html(RequiredField(meter_no))
                $('#summary_meter_package').html(RequiredField(service))
                $('#summary_meter_email').html(RequiredField(customer_email))
                $('#summary_meter_packageName').html(RequiredField(meter_packageName))
                $('#summary_meter_amount').html(RequiredField(amount))
                $('#summary_meter_customer').html(RequiredField(meter_customer))
                $('#summary_meter_token').html(RequiredField(token))
                
            }
            
            if(validate == false) {
                $('#payMeter').prop('disabled', true)
            }else{
                $('#payMeter').prop('disabled', false)
            }
        }
        
        function PaystackPayment(data = {}){
            
            let pay_amount_init = parseInt(data.amount)
              let pay_amount_charge= parseInt(pay_amount_init * 1.0090)
              let charge = (pay_amount_init * 0.015)
    
          console.log(charge);
    
          let pay_amount= ((pay_amount_init + charge) * 100).toFixed(2)
          
          var name= data.name;
            var email = data.email;
            var phone = data.phone;
    
            var handler = PaystackPop.setup({
              key: "pk_live_280c8fae4d633ab87d618fed8b970d1b0ff4410f",
              email: email,
              amount: pay_amount,
              firstname: name,
              lastname: name,
              metadata: {
                 custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: phone
                    },
                    {
                        display_name: "Ebeano Token",
                        variable_name: "ebeano_token",
                        value: data.token
                    }
                 ]
              },
              callback: function(response){
                  console.log(response.reference);
                  var paystack_ref_code=response.reference;
                  
                  let pay_data = {
                      paystack_ref_code:paystack_ref_code,
                      amount: pay_amount_init,
                      transaction: data.transaction
                  }
                //   invoke send request
                    SendPurchaseRequest(pay_data)
              },
              onClose: function(){
                  console.log('window closed');
                  document.getElementById('btn').innerHTML="Pay";
              }
            });
            handler.openIframe();
            
        }
    </script>
@endsection