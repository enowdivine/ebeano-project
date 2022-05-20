@extends('layouts.theme')

@section('title'){{ (ucwords(strtolower($form->title ?? $form->title))).' | Ebeano Market' }}@stop

@section('meta_description'){{ strip_tags($form->general_instruction) }}@stop

@section('meta_keywords'){{ $form->title }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ ucwords(strtolower($form->title)) }}">
    <meta itemprop="description" content="{{ strip_tags($form->general_instruction) }}">
    <meta itemprop="image" content="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ ucwords(strtolower($form->title)) }}">
    <meta name="twitter:description" content="{{ $form->general_instruction }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}">
    <meta name="twitter:data1" content="{{ $form->amount }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ ucwords(strtolower($form->title)) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('registrar.view.eforms', $form->reference) }}" />
    <meta property="og:image" content="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}" />
    <meta property="og:description" content="{{ $form->general_instruction }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ $form->amount}}" />
@endsection

@section('content')
    <script>
        $(document).ready(function() {
            $(".p-it-sel").click(function() {
                $(".p-it-sel.active").removeClass("active");
                $(this).addClass("active");
            });
        });

    </script>
    <style>
        .tagClosed {
            margin-top: -9px;
    	display: inline-block;
      
      width: auto;
    	height: 38px;
    	
    	background-color: red;
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
    	font-size: 22px;
    	line-height: 38px;
    
    	padding: 0 10px 0 10px;
    }
    
    /* Makes the triangle */
    .tagClosed:before {
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
    .tagClosed:after {
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
    /* on sale*/
    .tag {
            margin-top: -9px;
    	display: inline-block;
      
      width: auto;
    	height: 38px;
    	
    	background-color: #53a653;
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
    	font-size: 22px;
    	line-height: 38px;
    
    	padding: 0 10px 0 10px;
    }
    
    /* Makes the triangle */
    .tag:before {
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
    .tag:after {
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
    
    .text-sec {
        color: rgb(128 13 144);
        font-size: 16px;
    }
    </style>
    {{-- breadcrumb --}}

    <div class="section mt-2 mt-md-0">
        <ul class="d-none d-md-flex my-md-2 p-md-1 breadcrumb">
            <li class="breadcrumb-item"><a href="/eforms">Home</a></li>
            
            @if(isset($form->institute->name))
            <li class="breadcrumb-item">
                <a href="{{ route('filter.eforms', $form->institute->slug) }}">{{ ucwords($form->institute->name)}}</a>
            </li>
            @else
            <li class="breadcrumb-item"><a href="">All Forms</a></li> 
            @endif
        
            <li class="breadcrumb-item active">{{ucwords(strtolower($form->title))}}</li>
        </ul>
        <div class="row">
            <div class="px-2 col-md-9">
            {{-- product preview section --}}
                <div class="card rounded-lg shadow-sm border-0 px-3 mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-img-view py-3">
                                <div id="p-img-slider" class="carousel slide" data-ride="carousel">
                                
                                  <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img src="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}" class="img-fluid show" alt="{{ucwords(strtolower($form->name))}}">
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                            <div class="product-img-select position-relative border-bottom pb-2 mb-3">
                                <div class="user-select-none smooth-scroll scr-sn-type-x-m ">
                                    
                                    <div class="p-i-s">
                                        <label data-target="#p-img-slider" data-slide-to="0" class="p-it-sel active">
                                            <img src="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}"
                                                class="img-fluid rounded-sm "
                                                alt="{{ asset('assets/eforms/institute/logo/'.$form->institute->institute_logo) }}">
                                        </label>
                                    </div>
                                    
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-md-7">
                            <form action="" method="post" id="option-choice-form">
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="reference" name="reference" value="{{ $form->reference }}">
                            <div class="product-p-section py-3">
                                <div class="product-info ">
                                    <div class="pb-2 border-bottom">
                                        <div class="product-title justify-content-between d-flex" itemprop="name">
                                            <h1 class="text-center" style="font-family: georgia;">{{ucwords(strtolower($form->title))}}</h1>
                                        </div>
                                        <div class="product-rating d-flex align-items-center">
                                            <h5 class="text-sec"><b>Opens :</b>  {{ date('d F, Y', strtotime($form->form_open)) }}</h5>
                                        </div>
                                        
                                        <div class="product-rating d-flex align-items-center">
                                            <h5 class="text-sec"><b>Closes :</b>  {{ date('d F, Y', strtotime($form->form_close)) }}</h5>
                                            
                                        </div>
                                    </div>
                                    <div class="pb-2 mt-2 border-bottom">
                                        <div class="product-price">
                                            <span>
                                                Price: ₦{{number_format($form->amount)}}
                                            </span>
                                            @if($form->form_close >= \Carbon\Carbon::today())
                                            <span class="tagClosed" style="float:right">Closed</span>
                                            @else
                                            <span class="tag" style="float:right">On Sale</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="pb-2 mt-2 border-bottom">
                                        <div class="product-variation">
                                            
                                            <div class="p-var-top pb-3 d-flex justify-content-between">
                                            @if($form->required_sales == 0)
                                                <span class="badge badge-primary">Available</span>
                                            @else
                                                <span class="badge badge-primary">Available</span>
                                            @endif
                                                
                                            </div>
                                            
                                        <div class="pb-2 p-var-qty">
                                        
                                        <div class="product-quantity d-flex align-items-center">
                                            
                                            <div class="product-price my-2">
                                                    
                                                <div class="p-action-btn d-flex">
                                                
                                                    <button type="button" class="btn btn-default mr-2" onclick="buyFormNow()">Buy Now <i class="la la-cash-register"></i></button>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="p-share pb-2 mt-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>

                </div>
                
                {{-- product details section --}}
                <div class="p-details card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="font-weight-bold text-uppercase">General Instructions</span>

                    </div>
                    <div class="card-body">
                        {!! $form->general_instruction !!}
                    </div>

                </div>
                
            </div>
                
            {{-- preview sidebar --}}
            <div class="px-2 col-md-3">
                <div class="sticky-top">
                
                    <div class="p-key-feat card border-0 rounded-lg mb-3">
                        <div class="card-header bg-white border-bottom py-2">
                            <span class="text-uppercase font-weight-bold">Registrar</span>
    
                        </div>
                        <div class="card-body">
                            <h3>{{ $form->institute->name }}</h3>
                            <div class="seller-info-box mb-3">
                                <div class="sold-by position-relative">
                                    Email: {{ $form->registrar->user->email }}
                                </div>
                            
                            </div>
                        </div>
    
                    </div>
                
                </div>
            </div>
            
        </div>
        
    </div>
    
    <!--Payment form modal-->
    <div id="showPaymentFormModal"></div>

    <div class="modal fade" id="showBuyForm">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="showBuyForm-modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>

    function buyFormNow(){
        if($('#reference').val()) {
            $('#showBuyForm').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('eforms.process.create-transaction') }}',
               data: {
                   "_token": "{{ csrf_token() }}",
                   reference: $('#reference').val()
               },
               success: function(data){
                   $('.c-preloader').hide();
                   $('#showBuyForm').hide();
                   $('.modal-backdrop').hide();
                   $('#showPaymentFormModal').html(data)
                   $('#form-payment').modal();
                   //window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }
    

    function SendPurchaseRequest(data = {}) {
        var form = document.createElement("form");
        var element1 = document.createElement("input"); 
        var element2 = document.createElement("input");
        var element3 = document.createElement("input");
        var element4 = document.createElement("input");
        
        form.method = "POST";
        form.action = "{{ route('send-form-purchase-request') }}";   
    
        element1.value=data.paystack_ref_code;
        element1.name="ref_code";
        form.appendChild(element1);  
    
        element2.value=data.amount;
        element2.name="amount_paid";
        form.appendChild(element2);
        
        element3.value=JSON.stringify(data.transaction);
        element3.name="data";
        form.appendChild(element3);
        
        element4.value="{{ csrf_token() }}";
        element4.name="_token";
        form.appendChild(element4);
    
        document.body.appendChild(form);
        form.submit();
    
    }
    
    function ProceedFormPayment(){
        
        if($('#form_reference').val() && $('#form_amount').val() && $('#form_fname').val() && $('#form_lname').val() && $('#form_phone').val() && $('#form_email').val()) {
            $('.payment-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('eforms.process.create-payment') }}',
               data: {
                   "_token": "{{ csrf_token() }}",
                   reference: $('#form_reference').val(),
                   first_name: $('#form_fname').val(),
                   last_name: $('#form_lname').val(),
                   phone: $('#form_phone').val(),
                   email: $('#form_email').val(),
               },
               success: function(data){
                   $('.payment-preloader').hide();
                   $('#showPaymentFormModal').hide
                   $('.modal-backdrop').hide();
                   console.log(data)
                   if(data.status =='success'){
                       PaystackPayment(data)
                   }else{
                       showFrontendAlert('error', 'Oops! Something went wrong');
                   }
                   
                   //window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please fill all the inputs');
        }
    }
    
    
    function PaystackPayment(data = {}){
        
        let pay_amount_init = parseInt(data.amount_paid)
        let pay_amount_charge= parseInt(pay_amount_init * 1.0090)
        let charge = (pay_amount_init * 0.015)
        
        customer = JSON.parse(data.customer_details)
        
        console.log(charge);

        let pay_amount= ((pay_amount_init + charge) * 100).toFixed(2)
      
        var email = customer.email;
        var phone = customer.phone;
        //{{ env('PAYSTACK_PUBLIC_KEY') }}
        var handler = PaystackPop.setup({
          key: "pk_test_93d94fd68e0f2b973b527f93db182885926a9b57",
          email: email,
          amount: pay_amount,
          firstname: customer.firstname,
          lastname: customer.lastname,
          metadata: {
             custom_fields: [
                {
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: phone
                },
                {
                    display_name: "Ebeano Form ORDER ID",
                    variable_name: "ebeano_orderID",
                    value: data.txn_code
                }
             ]
          },
          callback: function(response){
                console.log(response.reference);
                var paystack_ref_code=response.reference;
              
                let pay_data = {
                  paystack_ref_code:paystack_ref_code,
                  amount: pay_amount_init,
                  transaction: data
                }
                //   invoke send request
                SendPurchaseRequest(pay_data)
          },
          onClose: function(){
              console.log('window closed');
              document.getElementById('btn').innerHTML="Make Payment";
          }
        });
        handler.openIframe();
        
    }
</script>
@endsection