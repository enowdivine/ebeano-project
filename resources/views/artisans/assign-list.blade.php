@extends('layouts.artisan')

@section('title', 'Job Awarded List')

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

        <div class="card no-border mt-5">
            
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
        
            <div class="card-header py-3">
                <h4 class="mb-0 h6">{{__('Jobs Awarded for Artisans')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{__('Artisan')}}</th>
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
                                    <td><a href="{{route('biography',[$data->user->id, $data->user->name])}}" class="black">
                                                    {{$data->user->name}}
                                                </a>
                                                @if($data->reject == 1)
                                                <span class="badge badge-danger">Rejected</span>
                                                @endif
                                    </td>
                                    <td>
                                        @if($data->status == 0)

                                                     <button data-toggle="modal" data-target="#paybutton" value="2" data-idd="{{$data->id}}" data-salary="{{number_format($data->project->salary)}}" data-artisan="{{$data->user->name}}" class="pay_button btn btn-info btn-sm" title="Pay"> <i class="fas fa-donate"></i> <i></i> </button>
                                        <button data-toggle="modal" data-target="#small" value="3" data-id="{{$data->id}}" class="delete_button btn btn-danger btn-sm" title="Remove"> <i class="fa fa-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" role="dialog" id="small">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fa fa-trash"></i> Remove !</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure to remove this artisan ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('remove.assign.list')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="confirm_id">
                    <button type="submit" id="confirm_accept" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="paybutton">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fa fa-donate"></i> Approve Payment !</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>You are about to approve the payment of &#8358;<span id='salary'></span> to <span id='artisan'></span> ?</h4>
            </div>
            <div class="modal-footer">
                <form action="{{route('approve.job.payment')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="confirm_idd">
                    <button type="submit" id="confirm_accept" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_button', function () {
            var id = $(this).data('id');
            $('#confirm_id').val(id);
        });
        $(document).on('click', '.pay_button', function () {
            var idd = $(this).data('idd');
            var salary = $(this).data('salary');
            var artisan = $(this).data('artisan');
            $('#confirm_idd').val(idd);
            $('#salary').html(salary);
            $('#artisan').html(artisan);
        });
    });

</script>
@endsection