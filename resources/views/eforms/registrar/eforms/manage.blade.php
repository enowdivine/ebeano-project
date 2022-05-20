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
                <h4 class="mb-0 h6">{{__('Manage Forms')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-responsive-md mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{__('Opens')}}</th>
                            <th>Closes</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Req Sales')}}</th>
                            <th>{{__('Ref')}}</th>
                            <th>Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($forms) > 0)
                            @foreach ($forms as $key => $form)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{route('registrar.view.eforms',[$form->reference])}}">{{ $form->title }}</a></td>
                                    <td>{{ date('d M, Y', strtotime($form->form_open)) }}</td>
                                    <td>{{ date('d M, Y', strtotime($form->form_close)) }}</td>
                                    <td>&#8358;{{ number_format($form->amount) }}</td>
                                    <td>
                                        @if($form->required_sales == 0)
                                            <span class="badge badge-default">unlimited</span>
                                        @else
                                            <span class="badge badge-default">{{ $form->required_sales }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $form->reference }}</td>
                                    <td>{{ date('d F, Y', strtotime($form->created_at)) }}</td>
                                    <td>
                                        @if($form->status == 0)
                                            <span class="badge badge-warning">pending</span>
                                        @else
                                            <span class="badge badge-success">success</span>
                                        @endif
                                    </td>
                                    <td style="display: inline; width: 100%">
                                        <a href="{{route('registrar.present.eforms',[$form->reference])}}"
                                           class="btn btn-info btn-sm" title="Preview">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{route('registrar.edit.eforms',[$form->reference])}}"
                                           class="btn btn-info btn-sm" title="Edit">
                                            <i class="la la-pencil-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#small" value="3" data-id="{{$form->reference}}"
                                                class="delete_button btn btn-danger btn-sm" title="Remove">
                                            <i class="fa fa-trash"></i>
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
            </div>
        </div>
        <div class="pagination-wrapper py-4">
            <ul class="pagination justify-content-end">
                {{ $forms->links() }}
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><i class="fa fa-trash"></i></h6>
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
@section('script')
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
                    url: "{{route('registrar.delete.eforms')}}",
                    data: {
                        id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            $('#tr_' + id).hide();
                            toastr.success(" Delete Successfully");
                        }else{
                            toastr.error(" Unable to delete");
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