@extends('layouts.app')

@section('content')
@php
if (session()->get('data')){
$data = session()->get('data');
}
@endphp
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Products</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li class="active"><span>Products</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>

    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm-9">
            @if(Session::has('success') && !empty(Session::get('success')))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif

            @if(Session::has('error') && !empty(Session::get('error')))
            <div class="alert alert-info">
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
    <!-- /Row -->

    <div class="row">
        <div class="col-sm-9">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Product'):('Add Product')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{isset($edit)?route('product.update',['id'=>$edit->id]):route('product.add')}}" method="POST" enctype="multipart/form-data" id="product_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="pills-struct vertical-pills mt-20">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="pull-right mb-20">
                                        <input type="submit" class="btn btn-sm btn-primary btn-anim" name="save" value="Save">
                                    </div>

                                </div>

                            </div>
                            <ul role="tablist" class="nav nav-pills ver-nav-pills" id="myTabs_10">
                                <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab"
                                        role="tab" id="info_tab" href="#info">Information</a></li>
                                <li role="presentation"><a data-toggle="tab" id="image_tab" role="tab" href="#image"
                                        aria-expanded="false">Images</a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" id="choice_tab"
                                            href="#choice">Customer Choice</a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" id="price_tab"
                                        href="#price">Price & Quantity</a></li>
                                <li role="presentation"><a data-toggle="tab" id="seo_tab" role="tab" href="#seo"
                                        aria-expanded="false">SEO</a></li>
                                
                                <li role="presentation"><a data-toggle="tab" id="desc_tab" role="tab" href="#desc"
                                        aria-expanded="false">Description</a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" id="shipping_tab"
                                        href="#shipping">Shipping Info</a></li>
                                <li role="presentation"><a data-toggle="tab" id="spec_tab" role="tab" href="#spec"
                                        aria-expanded="false">Specification</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent_10">
                                
                                <div id="info" class="tab-pane fade active in" role="tabpanel">
                                    <div class="panel-heading ">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">General Information</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                

                                    <div class="form-group">
                                        <label class="control-label" for="name">Name</label>
                                            <input id="name" type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Category</label>
                                        <select id="category_id" class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                            name="category">
                                            <option value="">Select</option>
                                            @php
                                                $categories = App\Category::all();
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option value="{{$category->id}}" {{(!empty($edit->category_id) && $edit->category_id == $category->id)?'selected':''}}>{{$category->name}}</option>  
                                            @endforeach
                                            

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">SubCategory</label>
                                        <select id="subcategory_id" class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                            name="sub_category">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10"> Sub SubCategory</label>
                                        <select id="subsubcategory_id" class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                            name="sub_subcategory">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Brand</label>
                                        <select class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                            name="brand">
                                            <option value="Category 1">Select</option>
                                            @php
                                                $brands = App\Brand::all();
                                            @endphp
                                            @foreach ($brands as $brand)
                                              <option value="{{$brand->id}}" {{(!empty($edit->brand_id) && $edit->brand_id == $brand->id)?'selected':''}}>{{$brand->name}}</option>  
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Tags</label>
                                        <div class="tags-default">
											<input type="text" class="form-control" name="tags" value="" data-role="tagsinput" placeholder="add tags"/>
										</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Type</label>
                                        <select class="form-control" data-placeholder="Choose type" tabindex="1"
                                            name="type">
                                            <option value="wholesale">Wholesale</option>
                                            <option value="retail">Retail </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-success checkbox-circle">
                                            <input id="checkbox-10" type="checkbox" name="publish" checked="checked" value="1">
                                            <label for="checkbox-10"> Publish </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="choice" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Customer Choice</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                        <div class="form-group  mt-20">
                                            <label class="control-label mb-10" for="colors">Colors</label>
                                            <select id="colors" class="select2 select2-multiple" name="colors[]" multiple="multiple" data-placeholder="Choose">   
                                                @php
                                                $colors = App\Color::all();
                                                @endphp
                                                @foreach ($colors as $color)
                                            <option value="{{$color->code}}" {{(!empty($edit->color_id) && $edit->color_id == $color->id)?'selected':''}}> {{$color->name}}</option>  
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                            $attributes = App\Attribute::all();
                                            $i= 0;
                                        @endphp
                                        @foreach ($attributes as $attribute)
                                        @php
                                            $i++
                                        @endphp
                                        <div class="form-group">
                                            <label for="{{strtolower($attribute->name.$i)}}" class="control-label mb-10">{{ucfirst($attribute)}}</label>
                                            <div class="tags-default">
                                                <input type="hidden" name="choice_no[]" value="{{$i}}">
                                                <input type="hidden" name="choice[]" value="{{strtolower($attribute->name)}}}}">
                                            <input id="{{strtolower($attribute->name.$i)}}" type="text" name="choice_options_{{$i}}[]" class="form-control" value="" data-role="tagsinput" onchange="update_sku()" placeholder="add value"/>
                                            </div>
                                        </div>
                                        @endforeach
                                    
                                </div>

                                <div id="price" class="tab-pane fade " role="tabpanel">
                                    <div class="panel-heading ">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Price</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="unit_price">Unit Price</label>
                                        <input id="unit_price" type="text" class="form-control" name="unit_price" value="{{!empty($edit->name)?$edit->name:('0')}}">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="bulk_price">Bulk price <span class="small">(if this is a wholesale product)</span></label>
                                        <input type="text" id="bulk_price" name="bulk_price" class="form-control"
                                            value="{{!empty($edit->bulk_price)?asset('storage/'.$edit->bulk_price):('0')}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="items">Item Per Bulk price</label>
                                        <input id="items" type="text" class="form-control" name="items_per_bulk_price" value="{{!empty($edit->meta_title)?$edit->meta_title:('0')}}">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="desc">Discount</label>
                                        <input id="discount" class="form-control" name="discount" value="{{!empty($edit->discount)?$edit->discount:('0')}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Discount Type</label>
                                        <select class="form-control" data-placeholder="Choose type" tabindex="1"
                                            name="discount_type">
                                            <option value="percent">Percentage</option>
                                            <option value="amount">Fixed </option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="quantity">
                                        <label class="control-label mb-10 text-left" for="qty">Quantity</label>
                                        <input id="qty" class="form-control" name="quantity" value="{{!empty($edit->quantity)?$edit->quantity:('0')}}">
                                    </div>

                                    <div class="mt-50 sku_combination" id="sku_combination">

                                    </div>
                                </div>
                                <div id="image" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading ">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Images</h6>
                                        </div>
                                        <div class="clearfix"></div>    
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="featured">Featured Image</label>
                                        <div class="row">
                                            <div id="featured"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="images"> Images</label>
                                        <div class="row">
                                            <div id="images"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="seo" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading ">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">SEO Meta Tags</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="meta_title">Meta title</label>
                                            <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{!empty($edit->meta_title)?$edit->meta_title:('')}}">
                                        </div>
            
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="meta_desc">Meta Description </label>
                                            <textarea type="text" id="meta_desc" name="meta_description" class="form-control"> {{!empty($edit->meta_description)?$edit->meta_description:('')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left" for="meta_keys">Meta keywords</label>
                                            <input id="meta_keys" type="text" class="form-control" name="meta_keywords" value="{{!empty($edit->meta_keywords)?$edit->meta_title:('')}}">
                                        </div>
                                    
                                </div>
                                
                                <div id="desc" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Full Description</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                    <textarea name="full_description" class="summernote form-control" rows="25">{{!empty($edit->full_description)?$edit->full_description:('')}}</textarea>
                                </div>
                                <div id="shipping" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Shipping Info</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="shipping_cost">Shipping cost</label>
                                        <input id="shipping_cost" type="text" class="form-control" name="shipping_cost" value="{{!empty($edit->meta_title)?$edit->meta_title:('0')}}">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left" for="weight">weight (in Kg)</label>
                                        <input id="weight" class="form-control" name="weight" value="{{!empty($edit->weight)?$edit->weight:('0')}}">
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-success checkbox-circle">
                                            <input id="free" type="checkbox" name="free_shipping" value="1">
                                            <label for="free"> Free shipping </label>
                                        </div>
                                    </div>

                                </div>
                                <div id="spec" class="tab-pane fade" role="tabpanel">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">Specification</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <textarea name="specifications" class="summernote form-control" rows="25">{{!empty($edit->specifications)?$edit->specifications:('')}}</textarea>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')
        <script>
	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
		   data:$('#product_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if (data.length > 1) {
				   $('#quantity').hide();
			   }
			   else {
					$('#quantity').show();
			   }
		   }
	   });
	}
        
        function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
          
		    $('#subcategory_id').html(null);
            $('#subsubcategory_id').append($('<option>', {
				value: null,
				text: 'select'
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    get_subsubcategories_by_subcategory();
            
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get') }}',{_token:'{{ csrf_token() }}', sub_category_id:subcategory_id}, function(data){
            
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: 'select'
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }

		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

    $('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});
        </script>
    @endsection