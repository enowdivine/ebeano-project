@extends('layouts.theme')

@section('title', 'Dashboard - Earning')
@section('link')
    <!-- Data table CSS -->
	<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    @php
    $name = Str::of(Auth::user()->name)->explode(' ');
    $user_name = $name[0];
    if (Auth::user()->user_type == 'seller'){
    
        $earning = App\Seller::where('user_id',Auth::user()->id)->first()->admin_to_pay;
    }
    $withdrawals= App\SellerWithdrawRequest::where('user_id',Auth::user()->id)->get();
    @endphp
    <div class="col-lg-3">
        @if(Auth::user()->user_type == 'seller' || Auth::user()->user_type == 'admin')
                        @include('inc.seller_nav')
                    @elseif(Auth::user()->user_type == 'user')
                        @include('inc.customer_nav')
                    @endif

    </div>
    <div class="col-lg-9">
        <div class="row mt-4">
            <div class="col-sm-9">
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

        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                    <i class="fa fa-dollar">&#8358;</i>
                    <span class="d-block title heading-3 strong-400">{{ number_format($earning,2) ?? '0.00' }}</span>
                    <span class="d-block sub-title">{{ __('Earning') }}</span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_withdraw_modal()">
                    <i class="la la-minus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Withdraw Earning') }}</span>
                </div>
            </div>
        </div>

        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Withdrawal history')}}</h4>
            </div>
            <div class="card-body">
                <table id="withdraw_tab" class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{__('Transaction ID')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Payment Method')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Payment Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($withdrawals) > 0)
                            @foreach ($withdrawals as $key => $withdrawal)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($withdrawal->created_at)) ?? ''}}</td>
                                    <td>{{$withdrawal->trxn_id ?? '' }}</td>
                                    <td>{{ number_format($withdrawal->amount,2) ?? '' }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $withdrawal->method)) }}</td>
                                    <td>{{$withdrawal->status == 1 ? 'Approved' : 'Unapproved' }}</td>
                                    <td>{{$withdrawal->paid == 1 ? 'Paid' : 'Unpaid' }}</td>
                                </tr>
                            @endforeach
                      
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<div class="modal fade" id="withdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Withdraw')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('seller.withdraw_earning') }}" method="post">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-weight-bold">Amount: {{number_format($earning,2) ?? ''}} </p>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control mb-3" name="amount"  value="{{$earning ?? '0.00'}}">
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>{{__('Payment Method')}}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="method">

                                        <option value="bank">{{__('Bank')}}</option>
                                        <option value="wallet">{{__('Wallet')}}</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">{{__('Confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Data table JavaScript -->
<script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script>
    /*DataTable Init*/
    "use strict";
    $(document).ready(function() {
        "use strict";
        $('#withdraw_tab').DataTable();
        $('#produ').DataTable({
            "lengthChange": false
        });
    });
</script>
    <script type="text/javascript">
        function show_withdraw_modal(){
            $('#withdrawal_modal').modal('show');
        }
    </script>
@endsection
