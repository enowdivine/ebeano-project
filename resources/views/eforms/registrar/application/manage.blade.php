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
                <h4 class="mb-0 h6">{{__('Manage Applications')}}</h4>
            </div>
            <div class="card-body">
                <form action="{{route('all.apply.eforms')}}" name='addForm' enctype='multipart/form-data' method="POST">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="input-group col-md mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Institution</b></span>
                            </div>
                            <select name="institute_id" id="institute_id" class="eb-select custom-select">
                                <option value="" disabled>Select Institute</option>
                                @foreach($institutes as $inst)
                                    <option value="{{$inst->id}}">{{ $inst->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md">
                            <input type="submit" class="btn eb-text-sm btn-sm btn-default" value="Filter">
                        </div>
                    </div>
                </form>
                
                @if($filter == true)
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{__('Form ID')}}</th>
                            <th>Order ID</th>
                            <th>Applicant</th>
                            <th>{{__('Paid')}}</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($solds) > 0)
                            @foreach ($solds as $key => $sold)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ get_form($sold->form_id)->title }}</td>
                                    <td>{{ $sold->form_id }}</td>
                                    <td>{{ $sold->txn_code }}</td>
                                    <td>
                                        @foreach(json_decode($sold->customer_details) as $customer)
                                            <span><b>{{ $customer }}</b></span>
                                        @endforeach
                                    </td>
                                    <td>&#8358;{{ number_format($sold->amount_paid) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($inst->created_at)) }}</td>
                                    <td>
                                        @if($sold->approved == 0)
                                            <span class="badge badge-warning">pending</span>
                                        @else
                                            <span class="badge badge-success">success</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('registrar.preview-complete.eforms', ['reference'=>$sold->form_id, 'orderID'=>$sold->txn_code, 'hash'=>md5(base64_encode($sold->paid_reference))])}}"
                                           class="btn btn-info btn-sm" title="Preview">
                                            <i class="la la-eye"></i>
                                        </a>
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
                @endif
            </div>
        </div>
        
        @if($filter == true)
        <div class="pagination-wrapper py-4">
            <ul class="pagination justify-content-end">
                {{ $solds->links() }}
            </ul>
        </div>
        @endif
        
    </div>

</div>

<!-- Modal -->

@endsection
@section('script')

@endsection