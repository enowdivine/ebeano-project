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
                    <h4 class="">Create Form</h4>
                </div>
                <div class="card-body">
                    
                    <div class="form-group">
                        <label class="col-md-5"><strong>Institution :</strong></label>
                        <div class="col-md-5">
                            <select class="form-control" name="institute" id="institute" required>
                                <option value="" disabled>Select Institute</option>
                                @foreach($institutes as $inst)
                                    <option value="{{$inst->id}}">{{        $inst->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                            
                    <div id="ebeano-form"></div>
                    
                    <div class="overlay"></div>
                </div>
        </div>
    </div>
        
        <span style="display:none" id="eb-form-data"></span>
        
    </div>

</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src="{{asset('ebForms/dist/form-builder.min.js?v=3.6.2')}}"></script>
<script src="{{asset('ebForms/dist/form-render.min.js?v=3.6.2')}}"></script>

<script>

    //{type:"button",label:"viewJSON",id:"data",className:"btn btn-default get-data",events:{click:t.showData.bind(t)}}, ,{type:"button",id:"save",className:"btn btn-primary save-template",events:{click:function(e){t.save(),m.a.opts.onSave(e,t.data.formData)}}}
    
    jQuery($ => {
      const fbTemplate = document.getElementById('ebeano-form');
        var options = {
            disableFields: ['autocomplete', 'button']
        };
        $(fbTemplate).formBuilder(options);
        
        $('body').on('click', '.get-data', function () {
            if($('#eb-form-data').text() !=='[]' && $('#institute').val()){
                //get element within the dom
                $("body").addClass("loading"); 
                $.post("{{route('registrar.create.eforms')}}",
                  {
                    "_token": "{{ csrf_token() }}",
                    ebform: $('#eb-form-data').text(),
                    institute: $('#institute').val()
                  },
                  function(response){
                      $("body").removeClass("loading");
                      if(response.status=='success'){
                          showFrontendAlert('success', response.message)
                          window.location.href ="{{url('/eforms/registrar/final/institute/eforms')}}/"+response.id
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
@endsection