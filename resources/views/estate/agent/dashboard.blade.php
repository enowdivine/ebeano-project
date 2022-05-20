@extends('layouts.estate')

@section('title', $page_title)

@section('content')
<style>
    .inforide {
      box-shadow: 1px 2px 8px 0px #f1f1f1;
      background-color: white;
      border-radius: 8px;
      height: 125px;
    }
    
    .rideone {
      background-color: #6CC785;
      padding-top: 25px;
      border-radius: 8px 0px 0px 8px;
      text-align: center;
      height: 125px;
      margin-left: 15px;
    }
    
    .ridetwo {
      background-color: #9A75FE;
      padding-top: 30px;
      border-radius: 8px 0px 0px 8px;
      text-align: center;
      height: 125px;
      margin-left: 15px;
    }
    
    .ridethree {
      background-color: #4EBCE5;
      padding-top: 35px;
      border-radius: 8px 0px 0px 8px;
      text-align: center;
      height: 125px;
      margin-left: 15px;
    }
    
    .fontsty {
      margin-right: -15px;
    }
    
    .fontsty h2{
      color: #6E6E6E;
      font-size: 35px;
      margin-top: 15px;
      text-align: right;
      margin-right: 30px;
    }
    
    .fontsty h4{
      color: #6E6E6E;
      font-size: 25px;
      margin-top: 20px;
      text-align: right;
      margin-right: 30px;
    }
</style>
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('estate/agent/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="row">

          <!-- Icon Cards-->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide">
                  <div class="row">
                    <a href="<?php echo url("properties"); ?>">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                            
                        </div>
                    </a>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Properties</h4>
                        <h2><?php echo $total_properties; ?></h2>
                    </div>
                  </div>
                </div>
            </div>
    
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide">
                  <div class="row">
                    <a href="<?php echo route("estate.featured.property"); ?>">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                            <i class="fa fa-money fa-3x"></i>
                        </div>
                    </a>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Featured</h4>
                        <h2>{{ $featured_properties }}</h2>
                    </div>
                  </div>
                </div>
            </div>
    
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide">
                  <div class="row">
                    <a href="<?php echo url("customer-request"); ?>">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                    </a>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Requests</h4>
                        <h2><?php echo $total_customer_requests; ?></h2>
                    </div>
                  </div>
                </div>
            </div>
    
        </div>
        
        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Customers Inquiries')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($customer_requests) > 0)
                            @foreach($customer_requests as $k=>$row)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center pt-5 h4" colspan="100%">
                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                <span class="d-block">{{ __('No history found.') }}</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="pagination-wrapper py-4">
            <ul class="pagination justify-content-end">
                @if(count($customer_requests) > 0)
                {!! $customer_requests->links()!!}
                @endif
            </ul>
        </div>
        
    </div>

</div>
@endsection