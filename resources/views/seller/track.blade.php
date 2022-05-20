<div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
    <div class="card-title px-3 py-2 mb-0">
        <h4 class="">Track Order</h4>
    </div>
    <form class="form-default" data-toggle="validator" action="{{ route('seller.track-order') }}" role="form"
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
                        <h5 class="fs-title">Track Order:</h5>
                    </div>
                </div> 
                <div class="form-wrap">
                    
                    <div class="form-group">
                        <label class="control-label mb-10" for="order_id">Order ID:</label>
                        <input id="order_id" type="text" name="order_id"
                            class="form-control required" required/>
                    </div>
                    
                    <input type="submit" class="btn btn-default"  value="Track">
            
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
</script>  
@endsection