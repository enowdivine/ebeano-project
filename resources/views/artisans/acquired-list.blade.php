@extends('layouts.artisan')

@section('title', 'Acquired Jobs')

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
            <div class="col-md-4 offset-md-4">
                <a href="{{route('create-job')}}">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_withdrawal_modal()">
                    <i class="la la-plus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Create Job') }}</span>
                </div>
                </a>
            </div>
            
        </div>
        
        <div class="row">
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

        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Acquired Jobs')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{__('Contractor')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($projects) > 0)
                            @foreach($projects as $k=>$data)
                                <tr>
                                    <td>{{++$k}}</td>
                                    <td>
                                         @php $slug =  Str::slug($data->project->title) @endphp
                                                <a href="{{route('details.job',[$data->project->id, $slug])}}">
                                                    <h6>{{$data->project->title}} </h6>
                                                </a>
                                                <small class="black">Deadline : {{date('m.d.Y',strtotime($data->deadline))}}
                                                </small></td>
                                    <td><a href="{{route('biography',[$data->author->id, $data->author->name])}}" class="black">
                                                    {{$data->author->name}}
                                                </a></td>
                                    <td>
                                        @if($data->status == 1)
                                            <button class="btn btn-success btn-sm" title="Approved"><i class="fa fa-check"></i></button>
                                        @else
                                        <button class="btn btn-warning btn-sm" title="Remove">Pending</button>
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
                {!! $projects->links()!!}
            </ul>
        </div>

    </div>

</div>

@endsection