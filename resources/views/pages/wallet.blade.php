@extends('layouts.theme')

@section('title', 'Dashboard - Wallet')
@section('link')
    <!-- Data table CSS -->
	<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
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
            <div class="col-md-3 offset-md-2">
                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                    <i class="fa fa-dollar">&#8358;</i>
                    <span class="d-block title heading-3 strong-400">{{ number_format(Auth::user()->balance,2) }}</span>
                    <span class="d-block sub-title">{{ __('Wallet Balance') }}</span>

                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_wallet_modal()">
                    <i class="la la-plus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Recharge Wallet') }}</span>
                </div>
            </div>
            @if (Auth::user()->balance > 0)
            
                <div class="col-md-3">
                    <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_withdraw_modal()">
                        <i class="la la-minus"></i>
                        <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Withdraw Balance') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Wallet recharge history')}}</h4>
            </div>
            <div class="card-body">
                <table id="wallet_tab" class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Payment Method')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($wallets) > 0)
                            @foreach ($wallets as $key => $wallet)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                    <td>{{ single_price($wallet->amount) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}</td>
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
                {{ $wallets->links() }}
            </ul>
        </div>

    </div>

</div>
<div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Recharge Wallet')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('wallet.recharge') }}" method="post">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Amount')}} <span class="required-star">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="number" class="form-control mb-3" name="amount" placeholder="{{__('Amount')}}" required>
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                            <input type="hidden" name="orderID" value="{{ rand(100000000,999999999) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Payment Method')}}</label>
                        </div>
                        <div class="col-md-10">
                            <div class="mb-3">
                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="payment_option">

                                        <option value="paystack">{{__('PayStack')}}</option>
                                        <option value="interswitch">{{__('InterSwitch')}}</option>

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

<div class="modal fade" id="withdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Withdraw Balance')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('withdraw.balance') }}" method="post">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Amount')}} <span class="required-star">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="number" class="form-control mb-3" name="amount" placeholder="{{__('Amount')}}" required>
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                            <input type="hidden" name="orderID" value="{{ rand(100000000,999999999) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Enter Your Bank Details')}}</label>
                        </div>
                        <div class="col-md-10">
                            <div class="mb-3">
                                <textarea class="form-control" data-minimum-results-for-search="Infinity" name="payment_info">

                                </textarea>
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
        $('#waallet_tab').DataTable();
        $('#produ').DataTable({
            "lengthChange": false
        });
    });
</script>
    <script type="text/javascript">
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }
        function show_withdraw_modal(){
            $('#withdraw_modal').modal('show');
        }
    </script>
@endsection