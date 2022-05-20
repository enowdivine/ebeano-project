@extends('layouts.theme')

@section('title', 'Choose Category')

@section('link')
<!-- multi-select CSS -->
<link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/BsMultiSelect.min.css')}}" rel="stylesheet" type="text/css"/>


<!-- Bootstrap Dropify CSS -->
<link href="{{asset('assets/vendors/bower_components/dropify/dist/css/dropify.min.css')}}" rel="stylesheet"
type="text/css" />
	
<link href="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset('assets/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css')}}" />


<style>
    .bootstrap-tagsinput .tag {
    margin: 2px;
    color: white;
    background-color: #222;
    padding: 0 3px 6px;
    border-radius: 3px;
}
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3">

        @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        
        <div class="card shadow-sm my-3 px-3 rounded justify-content-center border-0">

            <div class="card-title px-3 py-2 mb-0 mt-3">
                <h4 class="text-center">Choose a Category</h4>
            </div>
            <div class="card-body">
                
                <div class="row mb-2">
                    @php
                        $categories = App\Category::where('featured', 1)->get();
                    @endphp
                    @foreach($categories as $category)
                        <div class="col-4 col-md-2 home-category py-2" >
                            
                            <a href="{{route('seller.product_action',['step'=>'choose-category', 'action' => $category->slug])}}">
                                <div class="bg-white rounded pt-0">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <img class="img-fluid" src="{{ asset('storage/'.$category->desktop_image) }}"  alt="{{$category->name}}">
                                    </div>
                                    <div class="col-md-12 py-2">
                                    <h4 class="text-center">{{Str::title($category->name)}}</h4>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')

<!-- Bootstrap Tagsinput JavaScript -->
<script src="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<!-- Summernote Plugin JavaScript -->
<script src="{{asset('assets/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js')}}"></script>

<!-- Bootstrap Select JavaScript -->
<script src="{{asset('assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

<!-- Select2 JavaScript -->
<script src="{{asset('assets/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<!-- Bootstrap Select JavaScript -->
<script src="{{asset('assets/vendors/bower_components/bootstrap-select/dist/js/BsMultiSelect.min.js')}}"></script>

@endsection