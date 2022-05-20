@extends('layouts.theme')

@if(isset($edit))
    @section('title', 'Edit Product')
@else
    @section('title', 'Add Product')
@endif


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
@php
if (session()->get('data')){
$edit = session()->get('data');
}
session()->forget('data');
@endphp
<div class="row">
    <div class="col-lg-3">

        @include('inc/seller_nav')

    </div>
    <div class="col-lg-9">
        <div class="row mt-0 mt-md-2">
        <div class="col-sm-12">
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
        <div class="card shadow-sm my-3 px-3 rounded justify-content-center border-0">

            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">{{($edit ?? '')?'Edit Product':'Add Product'}}</h4>
            </div>
            <div class="card-body">
                 <form action="{{isset($edit)?route('seller.update_product'):route('seller.add_product')}}" method="POST" enctype="multipart/form-data" id="product_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            @if(isset($edit))
                                <input type="hidden" name="id" value="{{ $edit->id}}">
                            @endif
                <div class="row mb-2">
        
                    <div class="col-md-12">
                        <div class="form-wrap">
                            {{-- general --}}
                            <h2>General</h2>
                            <div class="form-group">
                                <label class="control-label font-weight-bold" for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{!empty($edit->name)?$edit->name:''}}" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10">Category</label>
                                <select id="category_id" class="form-control"
                                    data-placeholder="Choose a Category" tabindex="1" name="category">
                                    <option value="">Select</option>
                                    @php
                                    $categories = App\Category::all();
                                    @endphp
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{(!empty($edit->category_id) && $edit->category_id == $category->id)?'selected':''}}>
                                        {{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10">SubCategory</label>
                                <select id="subcategory_id" class="form-control"
                                    data-placeholder="Choose a Category" tabindex="1" name="sub_category">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10"> Sub SubCategory</label>
                                <select id="subsubcategory_id" class="form-control"
                                    data-placeholder="Choose a Category" tabindex="1" name="sub_subcategory">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10">Brand</label>
                                <select class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                    name="brand">
                                    <option value="0">Select</option>
                                    @php
                                    $brands = App\Brand::all();
                                    @endphp
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}"
                                        {{(!empty($edit->brand_id) && $edit->brand_id == $brand->id)?'selected':''}}>
                                        {{$brand->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10">Tags</label>
                                <div class="tags-default">
                                    <input type="text" name="tags" class="form-control" value="{{json_decode($edit->tags ?? '') ?? ''}}" data-role="tagsinput"
                                        placeholder="add tags"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label font-weight-bold mb-10">Type</label>
                                <select class="form-control" data-placeholder="Choose type" tabindex="1"
                                    name="type">
                                    <option value="wholesale" {{(!empty($edit->type) && $edit->type == 'wholesale')?'selected':''}}>Wholesale</option>
                                    <option value="retail" {{(!empty($edit->type) && $edit->type == 'retail')?'selected':''}}>Retail </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="checkbox checkbox-success checkbox-circle">
                                    <input id="checkbox-10" type="checkbox" name="publish" {{(!empty($edit->published) && $edit->published == 0)?'':'checked="checked"'}}
                                        value="1">
                                    <label for="checkbox-10"> Publish </label>
                                </div>
                            </div>
                        </div>
                        
                        {{-- images --}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="featured_img">Featured Image (290x300)</label>
                            <!--<div class="row">-->
                                <div class="row" id="featured_img">
                                    @if (isset($edit) && $edit->featured_img != null)
									<div class="col-md-4 col-sm-4 col-6">
										<div class="img-upload-preview">
											<img loading="lazy"  src="{{ asset('storage/'.$edit->featured_img) }}" alt="" class="img-fluid">
											<input type="hidden" name="previous_featured_img" value="{{ $edit->featured_img }}" >
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								@endif
                                </div>
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="photos"> Images (680x850)</label>
                            
                                <div class="row" id="photos">
                            
                                @if(isset($edit) && is_array(json_decode($edit->photos)))
									@foreach (json_decode($edit->photos) as $key => $photo)
										<div class="col-md-4 col-sm-4 col-6">
											<div class="img-upload-preview">
												<img loading="lazy"  src="{{ asset('storage/'.$photo) }}" alt="" class="img-fluid">
												<input type="hidden" name="previous_photos[]" value="{{ $photo }}">
												<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
											</div>
										</div>
									@endforeach
								@endif
                                
                            </div>
                        </div>
                        
                        {{-- Customer choice --}}
                        
                         @php
                            $colors = App\Color::all();
                            if (isset($edit)){
                            $color_array = json_decode($edit->colors);
                            }
                        @endphp
                        
                        @if(isset($color_array))
                        <div class="form-group  mt-20">
                            <label class="control-label font-weight-bold mb-10" for="colors">Colors</label>
                        </div>
                        <div class="form-group">
                            
                            <div class="d-flex flex-wrap flex-horizontal checkbox checkbox-success checkbox-circle">
                                @foreach ($colors as $color)
                            
                            @php 
                                $checked = "";
                                if(isset($edit) && in_array($color->code,$color_array ?? '')){
                                    $checked = 'checked';
                                }
                            @endphp
                                <input id="color-{{$color->id}}" class="colors d-none" type="checkbox" name="colors[]" value="{{$color->code}}" {{$checked}} >
                                <label class="d-block user-select-none color-label mr-1" style="background-color: {{$color->code}}" for="color-{{$color->id}}" ></label>
                                @endforeach
                            </div>
                            
                        </div>
                        @endif
                        
                        @php
                            $attributes = App\Attribute::all();
                            $i= 0;
                        @endphp
                        @foreach ($attributes as $attribute)
                        @php
                            $i++
                        @endphp
                        @if(isset($edit) && isset($edit->choice_options))
                        @foreach (json_decode($edit->choice_options) as $key => $choice_option)
                            @if($attribute->id == $choice_option->attribute_id)
                                @php 
                                    $attribute_values = implode(',', $choice_option->values);
                                @endphp
                            @endif
                        @endforeach
                        @endif
                        
                        @if(isset($attribute_values))
                        <div class="form-group">
                            <label for="{{strtolower($attribute->name.$i)}}" class="control-label font-weight-bold mb-10">{{ucfirst($attribute->name)}} @php if($attribute->name =='size'){echo "<span class='small'>(e.g: XXL,XL,L,M,S)</span>";} @endphp</label>
                            <div class="tags-default">
                                <input type="hidden" name="choice_no[]" value="{{$i}}">
                                <input type="hidden" name="choice[]" value="{{strtolower($attribute->name)}}}}">
                            <input id="{{strtolower($attribute->name.$i)}}" type="text" name="choice_options_{{$i}}[]" class="form-control" value="{{$attribute_values ?? ''}}" data-role="tagsinput" onchange="update_sku()" placeholder="add value"/>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        
                        {{-- Price and Qty --}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="unit_price">Unit Price</label>
                            <input id="unit_price" type="text" class="form-control" name="unit_price" value="{{!empty($edit->unit_price)?$edit->unit_price:('0')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="bulk_price">Bulk price <span class="small">(if this is a wholesale product)</span></label>
                            <input type="text" id="bulk_price" name="bulk_price" class="form-control"
                                value="{{!empty($edit->bulk_price)?$edit->bulk_price:('0')}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="items">Item Per Bulk price</label>
                            <input id="items" type="text" class="form-control" name="items_per_bulk_price" value="{{!empty($edit->items_per_bulk_price)?$edit->items_per_bulk_price:('0')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="desc">Discount (%)</label>
                            <input id="discount" class="form-control" name="discount" value="{{!empty($edit->discount)?$edit->discount:('0')}}">
                        </div>

                        <div class="form-group" id="quantity">
                            <label class="control-label font-weight-bold mb-10 text-left" for="qty">Quantity</label>
                            <input id="qty" class="form-control" name="quantity" value="{{!empty($edit->current_stock)?$edit->current_stock:('0')}}">
                        </div>

                        <div class="mt-50 sku_combination" id="sku_combination">

                        </div>
                        
                        {{-- SEO --}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="meta_title">Meta title</label>
                            <input id="meta_title" type="text" class="form-control" name="meta_title" value="{{!empty($edit->meta_title)?$edit->meta_title:('')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="meta_desc">Meta Description </label>
                            <textarea type="text" id="meta_desc" name="meta_description" class="form-control"> {{!empty($edit->meta_description)?$edit->meta_description:('')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="meta_keys">Meta keywords</label>
                            <input id="meta_keys" type="text" class="form-control" name="meta_keywords" value="{{!empty($edit->meta_keywords)?$edit->meta_keywords:('')}}">
                        </div>
                        
                        {{-- Desc --}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-3 text-left" for="weight">Description:</label>
                            <textarea name="full_description" class="summernote form-control" rows="10">{{!empty($edit->description)?$edit->description:($edit->full_description ?? '')}}</textarea>
                        </div>
                        
                        {{-- Shipping --}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="shipping_cost">Shipping cost</label>
                            <input id="shipping_cost" type="text" class="form-control" name="shipping_cost" value="{{!empty($edit->shipping_cost)?$edit->shipping_cost:('0')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-10 text-left" for="weight">weight (in Kg)</label>
                            <input id="weight" class="form-control" name="weight" value="{{!empty($edit->weight)?$edit->weight:('0')}}">
                        </div>

                        <div class="form-group">
                            <div class="checkbox checkbox-success checkbox-circle">
                                <input id="free" type="checkbox" name="free_shipping" value="1" {{(!empty($edit->free_shipping) && $edit->free_shipping == 1)?'checked':''}}>
                                <label for="free"> Free shipping </label>
                            </div>
                        </div>
                        
                        {{-- Specification--}}
                        
                        <div class="form-group">
                            <label class="control-label font-weight-bold mb-3 text-left" for="weight">Specifications: </label>
                            <textarea name="specifications" class="summernote form-control mb-3" rows="10">{{!empty($edit->specification)?$edit->specification:($edit->specifications ?? '')}}</textarea>
                            
                            <input type="submit" class="btn btn-primary btn-anim" name="save" value="Save">
                        
                        </div>
                        
                    </div>
                </div>
                
                </form>
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


<!-- Summernote Wysuhtml5 Init JavaScript -->
<script>

        
$(function(){

$("#colors").bsMultiSelect({
  cssPatch: {
    choices: {
      listStyleType: 'none',
      columnCount:'5',
      overflowY:'auto'
    },
    picks: {
      listStyleType: 'none',
      display: 'flex',
      flexWrap: 'wrap',
      height: 'auto',
      marginBottom: '0'
    },
    choice: 'px-md-2 px-1',
    choice_hover: 'text-primary bg-light',
    filterInput: {
      border: '0px',
      height: 'auto',
      boxShadow: 'none',
      padding: '0',
      margin: '0',
      outline: 'none',
      backgroundColor: 'transparent',
      backgroundImage: 'none' // otherwise BS .was-vali<a href="https://www.jqueryscript.net/time-clock/">date</a>d set its image

    },
    filterInput_empty: 'form-control',
    // need for placeholder, TODO test form-control-plaintext
    // used in staticContentGenerator
    picks_disabled: {
      backgroundColor: '#e9ecef'
    },
    picks_focus: {
      borderColor: '#80bdff',
      boxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)'
    },
    picks_focus_valid: {
      borderColor: '',
      boxShadow: '0 0 0 0.2rem rgba(40, 167, 69, 0.25)'
    },
    picks_focus_invalid: {
      borderColor: '',
      boxShadow: '0 0 0 0.2rem rgba(220, 53, 69, 0.25)'
    },
    // used in BsAppearance
    picks_def: {
      minHeight: 'calc(2.25rem + 2px)'
    },
    picks_lg: {
      minHeight: 'calc(2.875rem + 2px)'
    },
    picks_sm: {
      minHeight: 'calc(1.8125rem + 2px)'
    },
    // used in pickContentGenerator
    pick: {
      paddingLeft: '0px',
      lineHeight: '1.5em'
    },
    pickButton: {
      fontSize: '1.5em',
      lineHeight: '.9em',
      float: "none"
    },
    pickContent_disabled: {
      opacity: '.65'
    },
    // used in choiceContentGenerator
    choiceContent: {
      justifyContent: 'initial'
    },
    // BS problem: without this on inline form menu items justified center
    choiceLabel: {
      color: 'inherit'
    },
    // otherwise BS .was-validated set its color
    choiceCheckBox: {
      color: 'inherit'
    },
    choiceLabel_disabled: {
      opacity: '.65'
    }
  }
});

});

		/*Bootstrap wysihtml5 Init*/

		$(document).ready(function () {
			"use strict";
			
			$('.summernote').wysihtml5({
				toolbar: {
				fa: true,
				"link": true,
				}
			});
			
		});
</script>
<script>
    $('#colors').on('change', function() {
	    update_sku();
	});
	
	$('.colors').on('change', function() {
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
		   url:'{{isset($edit) ? route('seller.sku_combination_edit') : route('seller.sku_combination') }}',
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
		        
		  @if(isset($edit))
		    $("#subcategory_id > option").each(function() {
		        if(this.value == '{{$edit->subcategory_id ?? ''}}'){
		            $("#subcategory_id").val(this.value).change();
		        }
		    });
		    
		  @endif
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
		        @if(isset($edit))
		        $("#subsubcategory_id > option").each(function() {
		        if(this.value == '{{$edit->subsubcategory_id ?? ""}}'){
		            $("#subsubcategory_id").val(this.value).change();
		        }
		        });
		        @endif
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
<script>
    $(document).ready(function() {

        $(".color-label").click(function() {
                if($(this).hasClass("checked")){
                    $(this).removeClass("checked");
                }else{
                    $(this).addClass("checked");
                }
                update_sku();
        });
    });
</script>
<!--Spartan Image JavaScript [ REQUIRED ]-->
<script src="{{asset('assets/vendors/bower_components/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#featured_img").spartanMultiImagePicker({
            fieldName: 'featured_img',
            maxCount: 1,
            rowHeight: '150px',
            groupClassName: 'col-md-4 col-sm-4 col-6',
            allowedExt: 'png|jpg|jpeg',
            dropFileLabel: "Drop Here",
            onExtensionErr: function(index, file) {
                console.log(index, file);
                alert('Please only input png or jpg type file');
            },
            onSizeErr: function(index, file) {
                console.log(index, file);
                alert('File size too big');
            }
        });
        $("#photos").spartanMultiImagePicker({
            fieldName: 'photos[]',
            maxCount: 5,
            rowHeight: '150px',
            groupClassName: 'col-md-4 col-sm-4 col-6',
            allowedExt: 'png|jpg|jpeg',
            dropFileLabel: "Drop Here",
            onExtensionErr: function(index, file) {
                console.log(index, file);
                alert('Please only input png or jpg type file');
            },
            onSizeErr: function(index, file) {  
                console.log(index, file);
                alert('File size too big');
            }
        });
        
        @if(isset($edit))
         	 get_subcategories_by_category();
        
        	 get_subsubcategories_by_subcategory(); 
        	 
        	 update_sku();
        
    		$('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });
        function delete_row(em){
    		$(em).closest('.form-group').remove();
    		update_sku();
	    }
        @endif
    });
</script>

@endsection