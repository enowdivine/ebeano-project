@extends('layouts.theme')

@section('title', 'Add Product')
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

    $seller_id = App\Seller::select('id')->where('user_id',$user_id);
    if (Auth::user()->user_type == 'admin'){
    $seller_id = $user_id;
    }
    @endphp

    <div class="col-lg-3">

        @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Products</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">

                    <div class="col-sm-12">
                        <div class="float-right">
                            <a class="btn btn-sm btn-info btn-anim" href="{{route('seller.product_add', 'choose-category')}}"><span>Add new</span></a>
                        </div>
                        
                    </div>
            
                </div>
                <div class="table-responsive">
                    <table id="product_tab" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Featured Image</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $products = \App\Product::where('user_id','=',$user_id)->get();
                            $i = 0;
                            
                            @endphp
                            @foreach($products as $product)
                            @php 
                            
                            $i += 1;
                            
                            @endphp
                            <tr>

                                <td>{{$i}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category['name']}}</td>
                                <td> <img class="img-fluid" src="{{asset('storage/'.$product->featured_img)}}" width="50" height="40" alt="photo">
                                </td>
                                <td>
                                    @if($product->published == 0)
                                        <span class="text-warning">In review</span>
                                    @else
                                        <span class="text-success">Published</span>
                                    @endif
                                </td>
                                <td><a href="{{route('seller.product_view',['id'=>encrypt($product->id)])}}" target="_blank" class="mr-25"
                                        data-toggle="tooltip" data-original-title="View"> <i
                                            class="la la-eye text-inverse m-r-10"></i> </a>
                                    <a href="{{route('seller.product_edit',['id'=>encrypt($product->id)])}}" class="mr-25"
                                        data-toggle="tooltip" data-original-title="Edit"> <i
                                            class="la la-pencil text-inverse m-r-10"></i> </a>
                                    <a href="{{route('seller.product_delete',['id'=>encrypt($product->id)])}}"
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
        $('#product_tab').DataTable();
        $('#produ').DataTable({
            "lengthChange": false
        });
    });
</script>
@endsection