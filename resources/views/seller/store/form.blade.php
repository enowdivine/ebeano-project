@extends('layouts.theme')

@section('title', 'Dashboard')

@section('content')
<link href="https://stormmarts.com/artisan/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">
<link href="https://stormmarts.com/artisan/assets/front/css/bootstrap-datepicker.min.css" rel="stylesheet">

<div class="row">
    @php
    $name = Str::of(Auth::user()->name)->explode(' ');
    $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @if(Auth::user()->user_type == 'seller' || Auth::user()->user_type == 'admin')
        @include('inc.seller_nav')
        @elseif(Auth::user()->user_type == 'user')
        @include('inc.customer_nav')
        @endif
    
    </div>
    <div class="col-lg-9">
    
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h4 class="">Add and Update Store</h4>
            </div>
            <form class="form-default" data-toggle="validator" action="{{isset($edit) && $edit != "" ? route('seller.update-store') : route('seller.save-store') }}" role="form"
        method="POST">
        @csrf
        <div class="card-body">
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
            @if(Auth::check())
            @php
            $user = Auth::user();
            $seller = App\Seller::where('user_id',$user->id)->first();
            
            @endphp
        
            <input type="hidden" name="seller_id" value="{{ encrypt($seller['id'])}}">
            <input type="hidden" name="store_id" value="{{ encrypt($edit['id'] ?? "")}}">
        <div class="form-card">
        <div class="row">
        <div class="col-7">
        <h5 class="fs-title">Store Information:</h5>
        </div>
        </div> 
        <div class="form-wrap">
        <div class="form-group">
        <label class="control-label mb-10" for="storeName">Store name:</label>
        
            
            <input id="storeName" type="text" name="store_name" class="form-control required" value="{{$edit['name'] ?? ''}}" required/>
        
        
        </div>
        <div class="form-group">
        <label class="control-label mb-10" for="storeDesc">Store Description:</label>
        <textarea id="storeDesc" type="text" name="store_desc"
            class="form-control required"> {{$data['store']['description'] ?? ''}} </textarea>
        </div>
        
        
        
        <div class="form-group">
        <label class="control-label mb-10" for="addressDetail">Address:</label>
        <input id="addressDetail" type="text" name="store_address"
            class="form-control required"  value="{{$edit['address'] ?? ''}}" required/>
        </div>
        <div class="form-group">
        <label class="control-label mb-10" for="storeCity">City:</label>
        <input id="storeCity" type="text" name="store_city"
            class="form-control required" value="{{$edit['city'] ?? ''}}" required />
        </div>
        <div class="form-group">
        <label class="control-label mb-10" for="nearestPlace">Nearest Bus
            stop:</label>
        <input id="nearestPlace" type="text" name="nearest_bus_stop"
            class="form-control" value="{{$edit['nearest_bus_stop'] ?? ''}}" />
        </div>
        
        <div class="form-group">
        <label class="control-label mb-10">{{__('Select your state')}}</label>
        <select id="stateName" class="form-control selectpicker" data-live-search="true" name="store_state">
            <option value="0">Select</option>
            @foreach (\App\State::all() as $key => $state)
            <option value="{{ $state->state_id }}" {{$state->state_id == ($edit['state_id'] ?? "") ? 'selected':''}}>{{ $state->name }}</option>
            @endforeach
            
        </select>
        </div>
        <div class="form-group">
        <label class="control-label mb-10" for="referer">Market Place</label>
        <select id="marketPlace" class="form-control" name="market_place" >
            <option value="0">Select</option>
        </select>
        </div>
        <div class="form-group">
        <div id="other_market" >
        
        </div>
        </div>
        <div class="form-group">
        <label class="control-label mb-10" for="storeCountry">Country</label>
        <select id="storeCountry" class="form-control required"
            name="store_country" required>
            <option value="0">Select</option>
            @foreach ($countries as $country)
            <option value="{{$country->id}}" {{($country->name == "Nigeria")?'selected':''}}>{{$country->name}}</option>
            @endforeach
        </select>
        </div>
        
        <input type="submit" class="btn btn-default"  value="Update">
        
        </div>
        </div> 
        
        @endif
        </div>
        </form>
        </div>
    </div>

</div>
<script src="https://stormmarts.com/artisan/assets/admin/js/bootstrap-fileinput.js"></script>
<script src="https://stormmarts.com/artisan/assets/front/js/bootstrap-datepicker.min.js"></script>
@endsection
@section('script')
<script>

    function get_markets_by_state(){
		var state_id = $('#stateName').val();
		$.post('{{ route('markets.get') }}',{_token:'{{ csrf_token() }}', state_id:state_id}, function(data){
          
            console.log(data);
            $('#marketPlace').html(null);
            $('#other_market').html(null);
            $('#marketPlace').append($('<option>', {
				value: 0,
				text: 'select'
			}));
			if (data.length > 0){
			    $( "#marketPlace" ).prop( "disabled", false );
    		    for (var i = 0; i < data.length; i++) {
    		        $('#marketPlace').append($('<option>', {
    		            value: data[i].id,
    		            text: data[i].name
    		        }));
    		        
    		  @if(isset($data['store']))
    		    $("#marketPlace > option").each(function() {
    		        if(this.value == '{{$edit['market_id'] ?? ''}}'){
    		            $("#marketPlace").val(this.value).change();
    		        }
    		    });
    		    
    		  @endif
    		       
    		    }
			}else {
			 //   $( "#marketPlace" ).prop( "disabled", true );
			    $('#other_market').append($('<input>', {
    		            value: "",
    		            id: "otherMarket",
    		            name: "other_market",
    		            class: "form-control mb-2",
    		            placeholder: "Enter your market"
    		        }));
			}
            
		});
	}
	
	$('#stateName').on('change', function() {
	    get_markets_by_state();
	});
</script>  
@endsection