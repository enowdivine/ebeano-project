@extends('layouts.theme')

@section('title', $page_title)

@section('content')

<style>
    .form-wrap.form-builder .btn-group {
        position: relative;
        display: flex;
        margin-top: 20px
    }
    
    .form-wrap.form-builder .frmb-control li {
        box-shadow: inset 0 0 0 1px #fff;
        background: #eb790f;
    }
    
    .form-wrap.form-builder .frmb>li:hover {
        border-color: #66afe9;
        outline: 0;
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 10%), 0 0 8px rgb(161 17 181 / 62%);
    }
    .form-wrap.form-builder .frmb .field-actions .toggle-form:hover {
        background-color: rgb(161 17 181);
        color: #fff;
    }
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("{{asset('assets/eforms/eb-loader.gif')}}") center no-repeat;
    }
    body.loading{
        overflow: hidden;   
    }
    body.loading .overlay{
        display: block;
    }
</style>

<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('eforms/registrar/partials/menuhome')
    </div>
    
    <div class="col-lg-9">
        
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
                <div class="card-title px-3 py-2 mb-0">
                    <h4 class="">Editing Form</h4>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="col-md-5"><strong>Institution :</strong></label>
                                <select class="form-control" name="institute" id="institute" required>
                                    <option value="" disabled>Select Institute</option>
                                    @foreach($institutes as $inst)
                                        <option value="{{$inst->id}}" @if($form->institute_id == $inst->id) selected @endif>{{ $inst->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-6"><strong>Form Title :</strong></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Form Title" value="{{ $form->title }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5"><strong>Form Price :</strong></label>
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Form Price" value="{{ $form->amount }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>General Instruction :</strong></label>
                                <textarea name="general" id="general" class="form-control" required>{{ $form->general_instruction }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5"><strong>Required Sales :</strong></label>
                                <input type="text" name="sales" id="sales" class="form-control" placeholder="Required Sales" value="{{ $form->required_sales }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5"><strong>Form Opens :</strong></label>
                                    <div class="input-group input-group-md open_date" id="open_date"
                                         data-provide="datepicker">
                                    <input type="text" value="{{ $form->form_open }}" id="opens_date" class="form-control" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-5"><strong>Form Closes :</strong></label>
                                    <div class="input-group input-group-md close_date" id="close_date"
                                         data-provide="datepicker">
                                    <input type="text" value="{{ $form->form_close }}" id="closes_date" class="form-control" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <hr>
                            
                    <div id="ebeano-form"></div>
                    
                    <div class="overlay"></div>
                    
                </div>
        </div>
    </div>
        
        <textarea style="display:none" id="ebeano-form-data">{{ $form->form_content }}</textarea>
        <span style="display:none" id="eb-form-data"></span>
    </div>

</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src="{{asset('ebForms/dist/form-builder.min.js?v=3.6.2')}}"></script>
<script src="{{asset('ebForms/dist/form-render.min.js?v=3.6.2')}}"></script>

<script>

    jQuery($ => {

      const fbTemplate = document.getElementById('ebeano-form');
      var formDataVAL =document.getElementById('ebeano-form-data').value;
      
        var options = {
            formData: formDataVAL,
            disableFields: ['autocomplete', 'button'],
            editOnAdd: true
        };
        var formBuilder = $(fbTemplate).formBuilder(options);
        
        $('body').on('click', '.get-data', function () {
            if($('#eb-form-data').text() !=='[]' && $('#institute').val()){
            
                //get element within the dom
                $("body").addClass("loading"); 
                $.post("{{route('registrar.edit.process.eforms')}}",
                  {
                    "_token": "{{ csrf_token() }}",
                    ebform: $('#eb-form-data').text(),
                    institute: $('#institute').val(),
                    reference: "{{ $form->reference }}",
                    title: $('#title').val(),
                    amount: $('#amount').val(),
                    description: $('#general').text(),
                    sales: $('#sales').val(),
                    form_open: $('#opens_date').val(),
                    form_close: $('#closes_date').val(),
                  },
                  function(response){
                      $("body").removeClass("loading");
                      if(response.status=='success'){
                          showFrontendAlert('success', response.message)
                          window.location.href ="{{url('/eforms/registrar/show/institute/eforms')}}"
                      }else{
                          showFrontendAlert('error', response.message)
                      }
                  });
            }else{
                showFrontendAlert('error', 'Something is missing')
                return
            }
        });
    });
</script>
<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'general');
</script>

@endsection