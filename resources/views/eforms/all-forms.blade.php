@extends('layouts.theme')

@section('title', $page_title)
@section('script')
<script>
    $(document).ready(function() {
        $('.eb-forms').removeClass('container-fluid container-lg')
        
    });
</script>
@endsection
<style>
    .ebforms-list {
        margin-right:5px;
        box-shadow: none;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .ebforms-list:hover {
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
        border:1px solid rgb(131, 13, 146);
    }
    .ebform-lists {
        background-color: #fff;
        box-shadow: 0px 16px 32px 0px rgb(22 85 197 / 6%);
    }
    
    .pricetag {
    	display: inline-block;
      
      width: auto;
    	height: 38px;
    	
    	background-color: #eb790f;
    	-webkit-border-radius: 3px 4px 4px 3px;
    	-moz-border-radius: 3px 4px 4px 3px;
    	border-radius: 3px 4px 4px 3px;
    	
    	border-left: 1px solid #979797;
    
    	/* This makes room for the triangle */
    	margin-left: 19px;
    	
    	position: relative;
    	
    	color: white;
    	font-weight: 300;
    	font-family: 'Source Sans Pro', sans-serif;
    	font-size: 15px;
    	line-height: 38px;
    
    	padding: 0 10px 0 10px;
    }
    
    /* Makes the triangle */
    .pricetag:before {
    	content: "";
    	position: absolute;
    	display: block;
    	left: -19px;
    	width: 0;
    	height: 0;
    	border-top: 19px solid transparent;
    	border-bottom: 19px solid transparent;
    	border-right: 19px solid #979797;
    }
    
    /* Makes the circle */
    .pricetag:after {
    	content: "";
    	background-color: white;
    	border-radius: 50%;
    	width: 4px;
    	height: 4px;
    	display: block;
    	position: absolute;
    	left: -9px;
    	top: 17px;
    }
</style>
@section('content')

<div class="container">
    <div class="search-section mt-4 mb-0">
        <form action="{{route('filter.eforms.post')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="filter" value="true">
            <div class="row">
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Institution</span>
                    </div>
                    <select id="institute" class="eb-select custom-select" name="institute">
                        <option value="" disabled>Select Institute</option>
                        @foreach($Allinstitutes as $inst)
                            <option value="{{$inst->id}}">{{ $inst->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <input type="submit" class="btn eb-text-sm btn-sm btn-default" value="Filter">
                </div>
            </div>

        </form>

    </div>
    
    <!--top selling-->
    <div class="section" style="background:white">
        <div class="py-2 px-3 my-3 border-bottom">
            <h3>Forms for sale</h3>
        </div>
        <div class="row px-4">
            @foreach ($forms as $form)
                <div class="col-6 col-md-3 col-lg-3 ebforms-list ebform-lists col-margin">
                    <img width="40" height="40" style="float:right;margin-top:-10px;border-radius:50%; border:1px solid rgb(128 13 144)" src="{{asset('assets/eforms/institute/logo')}}/{{$form->institute->institute_logo}}" alt="">
                    
                    <a href="{{ route('registrar.view.eforms', $form->reference) }}"><h5 class="title">{{ $form->title }}</h5></a>
                    <span class="pricetag">&#8358;{{ number_format($form->amount) }}</span>
                </div>
            @endforeach
            
            @if(count($forms) > 0)
            <div class="col-8 col-md-8 offset-md-2">
                <div class="pagination-wrapper py-4">
                    <ul class="pagination justify-content-end">
                        {{ $forms->links() }}
                    </ul>
                </div>
            </div>
            @endif
            
        </div>
        
    </div>
    
</div>
    
@endsection

@section('script')

@endsection