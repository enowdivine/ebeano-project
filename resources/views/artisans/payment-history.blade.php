@extends('layouts.artisan')

@section('title', 'Payment History')

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
        
        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Payment History')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{__('Trx')}}</th>
                            <th>{{__('Main Balance')}}</th>
                            <th>{{__('Amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($trx) > 0)
                            @foreach($trx as $k=>$data)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td>
                                         @php $slug =  Str::slug($data->project->title) @endphp
                                                <a href="{{route('details.job',[$data->project->id, $slug])}}">
                                                    <h6>{{$data->project->title}} </h6>
                                                </a></td>
                                    <td>{{$data->trx}}</td>
                                    <td>&#8358;{{number_format($data->main_amo)}}</td>
                                    <td>
                                        @if($data->type == '+')
                                            <span class="text-success">&#8358;{{number_format($data->amount)}}</span>
                                        @else
                                            <span class="text-danger">&#8358;{{number_format($data->amount)}}</span>
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
                {!! $trx->links()!!}
            </ul>
        </div>

    </div>

</div>

@endsection