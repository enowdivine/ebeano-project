@extends('layouts.artisan')

@section('title', $page_title)

@section('content')

<style>
    .artisan-card {
        border: 0;
        border-radius: 27.5px;
        box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
        overflow: hidden;
    }
    
    .artisan-card .card-body {
        padding: 6px 10px 10px;
    }
    
    .artisan-card-description {
        font-size: 25px;
        color: #000;
        font-weight: normal;
        margin-bottom: 23px;
    }

    .artisan-card .form-control {
        border: 1px solid #d5dae2;
        padding: 10px 20px;
        margin-bottom: 20px;
        min-height: 45px;
        font-size: 13px;
        line-height: 15;
        font-weight: normal;
    }

    .artisan-card .form-control::-webkit-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::-moz-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control:-ms-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::-ms-input-placeholder {
        color: #919aa3;
    }

    .artisan-card .form-control::placeholder {
        color: #919aa3;
    }

    .artisan-card .artisan-btn {
        padding: 13px 20px 12px;
        background-color: #eb790f;
        border-radius: 4px;
        font-size: 17px;
        font-weight: bold;
        line-height: 20px;
        color: #fff;
        margin-bottom: 24px;
    }

    .artisan-card .artisan-btn:hover {
        border: 1px solid #eb790f;
        background-color: transparent;
        color: #000;
    }
    
    table tr td {
        padding: 15px 10px;
    }

</style>


<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="card artisan-card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h3 class="text-center">Manage Job <i class="la la-comment-alt mr-3"> </i> </h3>
            </div>
            <div class="card-body">
                <div class="portlet box blue">

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Total Bid</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($projects) > 0)
                                @foreach($projects as $k=>$data)
                                    <tr id="tr_{{$data->id}}">
                                        <td data-label="SL" class="black">{{++$k}}</td>
                                        <td data-label="Job Title">
                                            @php $slug =  Str::slug($data->title, '-') @endphp
                                            <h6>{{$data->title}}</h6>
                                            <small class="black">Deadline : {{date( "d.m.Y", strtotime($data->deadline) )}}
                                                <span class="padding-l-10 black">Last update : {{date( "d.m.Y", strtotime($data->updated_at) )}}</span>
                                            </small>
                                        </td>
                                        <td data-label="Salary" class="black">&#8358;{{number_format($data->salary,2)}} </td>
                                        <td data-label="Total Bid">
                                            <a href="{{route('bid.Userlist',[$data->id, $slug])}}"
                                               class="btn btn-info">{{$data->bids()->count()}}</a>
                                        </td>
                                        <td data-label="Status">
                                            @if($data->deleted_at == null)
                                                @if($data->approve == 0)
                                                    <button class="btn btn-warning btn-sm ">
                                                        Pending
                                                    </button>
                                                @elseif($data->approve == 1)
                                                    <button class="btn btn-success btn-sm ">
                                                        Approved
                                                    </button>
                                                @elseif($data->approve == 2)
                                                    <button class="btn btn-success btn-sm ">
                                                        Delivered
                                                    </button>
                                                @elseif($data->approve == -1)
                                                    <button class="btn btn-danger btn-sm">
                                                        Rejected
                                                    </button>
                                                @endif
                                            @endif

                                        </td>
                                        <td data-label="Action">
                                            @if($data->approve != -1)
                                                <a href="{{route('edit.job',[$data->id, $slug])}}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="la la-pencil-alt"></i>
                                                </a>
                                            @endif
                                            <button data-toggle="modal" data-target="#small" value="3"
                                                    data-id="{{$data->id}}"
                                                    class="delete_button btn btn-danger btn-sm" title="Remove">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">You have no job post !!</td>
                                </tr>

                            @endif
                            </tbody>
                        </table>
                        {!! $projects->links()!!}
                    </div>
                </div>
                    
            </div>
        </div>
        
    </div>

</div>

<!-- Modal -->
<div class="modal fade" role="dialog" id="small">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><i class="fa fa-trash"></i> Deleting Job !</h6>
            </div>
            <div class="modal-body">
                <p>Are you sure delete this ?</p>
                <input type="hidden" id="confirm_id">

            </div>
            <div class="modal-footer">
                <button type="button" id="confirm_delete" class="btn btn-primary" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
                // alert(id);
            });

            $(document).on('click', '#confirm_delete', function () {
                var id = $('#confirm_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('job.delete')}}",
                    data: {
                        id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 0) {
                            $('#tr_' + id).hide();
                            toastr.success(" Delete Successfully");
                        }
                    }
                    ,
                    error: function (res) {

                    }
                })
            });


        });

    </script>
@endsection