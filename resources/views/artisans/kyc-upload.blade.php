@extends('layouts.artisan')

@section('title', 'KYC Upload & Verification')

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
            @if(count($kyc) < 1)
            <div class="col-md-4 offset-md-4">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="add_kycupload_modal()">
                    <i class="la la-plus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Upload Document') }}</span>
                </div>
            </div>
            @else
            <!--<div class="col-md-4 offset-md-4">
                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="edit_kycupload_modal()">
                    <i class="la la-plus"></i>
                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Edit Document') }}</span>
                </div>
            </div>-->
            @endif
        </div>

        <div class="card no-border mt-5">
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('KYC Upload & Verification')}}</h4>
            </div>
            <div class="card-body">
                
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
        
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{__('Owner')}}</th>
                            <th>{{__('Document Type')}}</th>
                            <th>{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($kyc) > 0)
                            @foreach ($kyc as $key => $data)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $data ->doc_type)) }}</td>
                                    <td>
                                        @if(isset($data->verified_by))
                                           <span class="badge badge-success"><i class="fa fa-check"></i> Verified</span>
                                        @else
                                        <span class="badge badge-warning"><i class="fa fa-eye"></i> Pending</span>
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
                {{ $kyc->links() }}
            </ul>
        </div>

    </div>

</div>


<div class="modal fade" id="add_kycupload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Upload Document')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('add.kycupload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label>{{__('Doc Type')}}</label>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="doc_type">
                                        <option value="national_id_card">{{__('National ID Card')}}</option>
                                        <option value="driver_license">{{__('Driver License')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <label>{{__('Doc File')}}</label>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <input class="form-control" type="file" name="file" accept="image/*" required>
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

<div class="modal fade" id="edit_kycupload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Edit Document')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('edit.kycupload') }}" method="post">
                @csrf
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label>{{__('Doc Type')}}</label>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="doc_type">
                                        <option value="national_id_card">{{__('National ID Card')}}</option>
                                        <option value="driver_license">{{__('Driver License')}}</option>
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
        function add_kycupload_modal(){
            $('#add_kycupload_modal').modal('show');
        }
        function edit_kycupload_modal(){
            $('#edit_kycupload_modal').modal('show');
        }
    </script>
@endsection