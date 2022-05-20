@extends('layouts.theme')

@section('title', $page_title)

@section('content')
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('eforms/registrar/partials/menuhome')
    </div>
    <div class="col-lg-9">
    
        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('My Forms')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{__('Reference')}}</th>
                            <th>{{__('Open')}}</th>
                            <th>{{__('Deadline')}}</th>
                            <th>{{__('Sales Limit')}}</th>
                            <th>{{__('Amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($eforms) > 0)
                            @foreach($eforms as $k=>$data)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td>
                                         @php $slug =  Str::slug($data->title) @endphp
                                                <a href="{{route('registrar.view.eforms',[$data->reference, $slug])}}">
                                                    <h6>{{$data->title}} </h6>
                                                </a></td>
                                    <td>{{$data->reference}}</td>
                                    <td><small class="black">Open : {{date( "d.m.Y", strtotime($data->form_open) )}}</small></td>
                                    <td><small class="black">Deadline : {{date( "d.m.Y", strtotime($data->form_close) )}}</small></td>
                                    <td>@if($data->required_sales ==0) Unlimited @else {{$data->required_sales}} @endif</td>
                                    <td><span class="text-success">&#8358;{{number_format($data->amount)}}</span></td>
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
                {!! $eforms->links()!!}
            </ul>
        </div>
        
    </div>

</div>
@endsection