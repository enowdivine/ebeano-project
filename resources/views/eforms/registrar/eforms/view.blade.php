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
    
    </style>
    {{-- breadcrumb --}}

    <div class="section mt-2 mt-md-0">
        <ul class="d-none d-md-flex my-md-2 p-md-1 breadcrumb">
        </ul>
        <div class="row">
            <div class="px-2 mb-2 col-md-12 text-center"><h3>Preview Form</h3></div>
            <div class="px-2 col-md-9">
            
                <div class="card rounded-lg shadow-sm border-0 px-3 mb-4 pt-4">

                    {!! draw_ebForm($form->form_content) !!}
                    <div class="row pb-4">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-block btn-default" value="Submit Form">
                        </div>
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


@endsection

@section('script')
 <script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
 </script>
@endsection