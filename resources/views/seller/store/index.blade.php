@extends('layouts.theme')

@section('title', 'Add Store')
@section('link')
    <!-- Data table CSS -->
	<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @php
    // $name = Str::of(Auth::user()->name)->explode(' ');
    // $user_name = $name[0];

    $user_id = Auth::user()->id;

    $seller = App\Seller::where('user_id',$user_id)->first();

    @endphp

    <div class="col-lg-3">

        @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Stores</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">

                    <div class="col-sm-12">
                        <div class="float-right">
                            <a class="btn btn-sm btn-info btn-anim" href="{{route('seller.create-store')}}"><span>Add new</span></a>
                        </div>
                        
                    </div>
            
                </div>
                <div class="table-responsive">
                    <table id="store_tab" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $stores = \App\Store::where('seller_id','=',$seller->id)->get();
                            $i = 0;
                            
                            @endphp
                            @foreach($stores as $store)
                            @php 
                            
                            $i += 1;
                            
                            @endphp
                            <tr>

                                <td>{{$i}}</td>
                                <td>{{$store->name}}</td>
                                <td>
                                    <a href="{{route('seller.edit-store',['id'=>encrypt($store->id)])}}" class="mr-25"
                                        data-toggle="tooltip" data-original-title="Edit"> <i
                                            class="la la-pencil text-inverse m-r-10"></i> </a>
                                    <a href="{{route('seller.delete-store',['id'=>encrypt($store->id)])}}"
                                        data-toggle="tooltip" data-original-title="Delete"> <i
                                            class="fa fa-times text-danger"></i> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('script')
<!-- Data table JavaScript -->
<script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script>
    /*DataTable Init*/
    "use strict";
    $(document).ready(function() {
        "use strict";
        $('#store_tab').DataTable();
        $('#produ').DataTable({
            "lengthChange": false
        });
    });
</script>
@endsection