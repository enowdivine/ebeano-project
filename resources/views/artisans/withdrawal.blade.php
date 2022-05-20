@extends('layouts.artisan')

@section('title', 'Withdrawal Request')

@section('content')
<div class="row">
    @php
    $name = Str::of(Auth::user()->name)->explode(' ');
    $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">

        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="dashboard-widget text-center eb-widget text-white mt-4 c-pointer">
                    <i class="fa fa-dollar">&#8358;</i>
                    <span class="d-block title heading-3 strong-400">{{ number_format(Auth::user()->balance,2) }}</span>
                    <span class="d-block sub-title">{{ __('Wallet Balance') }}</span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_withdrawal_modal()">
                    <i class="la la-plus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Withdrawal Funds') }}</span>
                </div>
            </div>
        </div>

        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Withdrawal history')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Payment Method')}}</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($wallets) > 0)
                            @foreach ($wallets as $key => $wallet)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                    <td>{{ single_price($wallet->amount) }}</td>
                                    <td>Local Bank</td>
                                    <td>
                                        @if($wallet->status == 0)
                                            <span class="badge badge-warning">pending</span>
                                        @else
                                            <span class="badge badge-success">success</span>
                                        @endif
                                    </td>
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
<div class="modal fade" id="withdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Withdraw funds')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('wallet.withdrawal') }}" method="post">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Amount')}} <span class="required-star">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="number" class="form-control mb-3" name="amount" placeholder="{{__('Amount')}}" required>
                            <input type="hidden" name="orderID" value="{{ rand(100000000,999999999) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{__('Withdrawal Method')}}</label>
                        </div>
                        <div class="col-md-10">
                            <div class="mb-3">
                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="withdraw_option">
                                        <option value="Local">{{__('Local Bank (1% charge)')}}</option>

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
    <script type="text/javascript">
        function show_withdrawal_modal(){
            $('#withdrawal_modal').modal('show');
        }
    </script>
@endsection