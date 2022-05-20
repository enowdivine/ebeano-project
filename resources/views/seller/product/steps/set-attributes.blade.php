@extends('layouts.theme')

@section('title', 'Set Product Attributes')

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
                <h4 class="text-center">Attributes for {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{route('seller.product_action',['step'=>'save-attributes', 'action' => $product->slug])}}" method="POST" enctype="multipart/form-data" id="product_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="product" value="{{ $product->id }}">
                            
                <div class="row mb-2">
                    
                    <div class="form-group col-md-6">
                        <label class="control-label font-weight-bold mb-10 text-left" for="featured_img">Featured Image (290x300)</label>
                        <!--<div class="row">-->
                            <div class="row" id="featured_img">
                                @if (isset($product) && $product->featured_img != null)
								<div class="col-md-4 col-sm-4 col-6">
									<div class="img-upload-preview">
										<img loading="lazy"  src="{{ asset('storage/'.$product->featured_img) }}" alt="" class="img-fluid">
										<input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}" >
										<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
									</div>
								</div>
							@endif
                            </div>
                        <!--</div>-->
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label font-weight-bold mb-10 text-left" for="photos"> Images (680x850)</label>
                        
                            <div class="row" id="photos">
                        
                            @if(isset($product) && is_array(json_decode($product->photos)))
								@foreach (json_decode($product->photos) as $key => $photo)
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
                        if (isset($product)){
                        $color_array = json_decode($product->colors);
                        }
                    @endphp
                    <div class="form-group col-md-12">
                        <label class="control-label font-weight-bold mb-10" for="colors">Colors</label>
                        
                        <div class="d-flex flex-wrap flex-horizontal checkbox checkbox-success checkbox-circle">
                            @foreach ($colors as $color)
                        
                            <input id="color-{{$color->id}}" class="colors d-none" type="checkbox" name="colors[]" value="{{$color->code}}">
                            <label class="d-block user-select-none color-label mr-1" style="background-color: {{$color->code}}" for="color-{{$color->id}}" ></label>
                            @endforeach
                        </div>
                        
                    </div>
                    @php
                        $attributes = App\Attribute::all();
                        $i= 0;
                    @endphp
                    @foreach ($attributes as $attribute)
                    @php
                        $i++
                    @endphp
                    <div class="form-group col-md-6">
                        <label for="{{strtolower($attribute->name.$i)}}" class="control-label font-weight-bold mb-10">{{ucfirst($attribute->name)}} @php if($attribute->name =='size'){echo "<span class='small'>(e.g: XXL,XL,L,M,S)</span>";} @endphp</label>
                        <div class="tags-default">
                            <input type="hidden" name="choice_no[]" value="{{$i}}">
                            <input type="hidden" name="choice[]" value="{{strtolower($attribute->name)}}}}">
                        <input id="{{strtolower($attribute->name.$i)}}" type="text" name="choice_options_{{$i}}[]" class="form-control" value="{{$attribute_values ?? ''}}" data-role="tagsinput" onchange="update_sku()" placeholder="add value"/>
                        </div>
                    </div>
                    @endforeach
                        
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-primary btn-anim" name="save" value="Save & Continue">
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
		   url:'{{ route('seller.sku_combination') }}',
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
        
        @if(isset($product))
        
        	 update_sku();
        
    		$('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });
        function delete_row(em){
    		$(em).closest('.form-group col-md-6').remove();
    		update_sku();
	    }
        @endif
        
    });
</script>

@endsection