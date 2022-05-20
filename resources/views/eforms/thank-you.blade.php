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
            
            
        });

    </script>
    <style>
        @media print {
          body * {
            visibility: hidden;
          }
          #section-to-print, #section-to-print * {
            visibility: visible;
          }
          #section-to-print {
            position: relative;
            left: -10px;
            right: -10px;
            top: -18px;
          }
        }
    </style>
    {{-- breadcrumb --}}

    <div class="section mt-2 mt-md-0">
        <ul class="d-none d-md-flex my-md-2 p-md-1 breadcrumb">
        </ul>
        <div class="row">
            <div class="px-2 col-md-8 offset-md-2">
                <div class="card rounded-lg shadow-sm border-0 px-3 mb-4 pt-4" id="section-to-print">
                    <div class="text-center">
                        <img src="{{ asset('assets/eforms/success.png') }}" width="100" height="100" alt="{{ucwords(strtolower($form->name))}}">
                        <h3>Thank You!</h3>
                        <h5 style="font-family:georgia">Payment successfully received! Click below button to start filling your form.</h5>
                        <h6><span style="color:rgb(161, 17, 181)">Ebeano</span> <span style="color:#eb790f">Market</span></h6>
                    </div>
                    <a href="{{ route('registrar.start-complete.eforms', ['reference'=>$order->form_id, 'orderID'=>$order->txn_code, 'hash'=>$hash]) }}" class="btn btn-default">Let's Go!</a>
                <br>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    
@endsection

@section('script')

@endsection