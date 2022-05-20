<div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
    <div class="card-title px-3 py-2 mb-0">
        <h4 class="">Business Info Update</h4>
    </div>
    <form class="form-default" data-toggle="validator" action="{{ route('seller.updateInfo') }}" role="form"
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
            $data = App\Seller::where('user_id',$user->id)->first();
            
            @endphp

            <input type="hidden" name="seller_id" value="{{ encrypt($data['id'])}}">
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h5 class="fs-title">Store Information:</h5>
                    </div>
                </div> 
                <div class="form-wrap">
                    <div class="form-group">
                        <label class="control-label mb-10" for="storeName">Store name:</label>
                        
                            
                            <input id="storeName" type="text" name="store_name" class="form-control required" value="{{$data['store']['name'] ?? ''}}" required/>
                      
            
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="storeDesc">Store Description:</label>
                        <textarea id="storeDesc" type="text" name="store_desc"
                            class="form-control required"> {{$data['store']['description'] ?? ''}} </textarea>
                    </div>
            
                    
                    
                    <div class="form-group">
                        <label class="control-label mb-10" for="addressDetail">Address:</label>
                        <input id="addressDetail" type="text" name="store_address"
                            class="form-control required"  value="{{$data['store']['address'] ?? ''}}" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="storeCity">City:</label>
                        <input id="storeCity" type="text" name="store_city"
                            class="form-control required" value="{{$data['store']['city'] ?? ''}}" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="nearestPlace">Nearest Bus
                            stop:</label>
                        <input id="nearestPlace" type="text" name="nearest_bus_stop"
                            class="form-control" value="{{$data['store']['nearest_bus_stop'] ?? ''}}" />
                    </div>

                    <div class="form-group">
                        <label class="control-label mb-10">{{__('Select your state')}}</label>
                        <select id="stateName" class="form-control selectpicker" data-live-search="true" name="store_state">
                            <option value="0">Select</option>
                            @foreach (\App\State::all() as $key => $state)
                            <option value="{{ $state->state_id }}" {{$state->state_id == $user->state_id ? 'selected':''}}>{{ $state->name }}</option>
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
                    <div class="row">
                        <div class="col-7">
                            <h5 class="fs-title">Bank Information</h5>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="bank">Bank:</label>
                        <select id="bank" name="bank_name" class="form-control " required>
                            @foreach ($banks as $bank)
                            <option value="{{$bank->code}}" {{($data['bank_id'] == $bank->id) ? 'selected' :''}}>{{$bank->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="accNo">Account Number:</label>
                        <input type="text" id="accNo" class="form-control required"
                            name="bank_account_no" value="{{$data['bank_acc_no'] ?? ''}}" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10" for="accName">Account Name:</label>
                        <input type="text" id="accName" class="form-control mb-2"
                            name="bank_account_name" value="{{$data['bank_acc_name'] ?? ''}}" required />
                        <br><span class="text-info mb-2" id="msg"></span>
                    </div>
                    
                    <input type="submit" class="btn btn-default"  value="Update">
            
                </div>
            </div> 

            @endif
        </div>
    </form>
</div>

@section('script')
<script>
    $("#bank").on("change", function() {
        resolveAccount();
    });
    
    $("#accNo").on("focusout", function() {
        resolveAccount();
    });
    
    function resolveAccount(){
        $("#msg").html('');
        $( "#accName" ).prop( "disabled", true );
        var bank = $("#bank").val();
        var account_no = $("#accNo").val();
        $("#accName").val('Resolving account no...');
        if(account_no != '' & bank !=''){
            
            $.post("{{route('verify.account')}}", {
                    _token : '{{ @csrf_token() }}',
                    bank_code: bank,
                    account_no: account_no
                },
                function(data, status) {
                    if (data.status == true) {
                        $("#accName").val(data.data.account_name);
                        $( "#accName" ).prop( "disabled", false );
                    } else {
                        $("#msg").html(data.message);
                        $("#accName").val('');
                    }
    
                     console.log("Data: " + data.data.account_name + "\nStatus: " + data.status);
                }, "json");
        }
    }
    
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
    		        if(this.value == '{{$data['store']['market_id'] ?? ''}}'){
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