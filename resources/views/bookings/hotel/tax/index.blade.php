@extends('layouts.booking')

@section('title', 'Tax')

@section('content')
<div class="row">
    @php
       $name = Str::of(Auth::user()->name)->explode(' ');
       $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @include('bookings/partials/menuhome')
    </div>
    
    <div class="col-lg-9">
    <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-header bg-white">
                <h2>Tax
                    <a class="btn btn-tsk float-right" href="{{route('tax.create')}}"><i class="fa fa-plus"></i>Add Tax</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxes as $key=>$tax)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$tax->name}}</td>
                        <td>{{$tax->code}}</td>
                        <td>{{$tax->type}}</td>
                        <td>{{$tax->rate}}</td>
                        <td><span class="badge {{$tax->status?'badge-success':'badge-danger'}}">{{$tax->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('tax.edit',$tax->id)}}" class="btn btn-tsk"><i class="la la-pencil"></i> Edit</a>
                           </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</div>
</div>
@endsection
