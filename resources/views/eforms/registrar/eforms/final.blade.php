@extends('layouts.theme')

@section('title', $page_title)

@section('content')
<link href="https://stormmarts.com/artisan/assets/admin/css/bootstrap-fileinput.css" rel="stylesheet">
<link href="https://stormmarts.com/artisan/assets/front/css/bootstrap-datepicker.min.css" rel="stylesheet">

<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('eforms/registrar/partials/menuhome')
    </div>
    <div class="col-lg-9">
        
        <div class="card artisan-card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-title px-3 py-2 mb-0">
                <h3 class="text-center">Complete Your Form </h3>
                <h5><b>Reference ID: </b>{{ $eform->reference }}</h5>
            </div>
            <div class="card-body">
                
        <form action="{{route('registrar.final.eforms', $eform->reference)}}" name='addForm' enctype='multipart/form-data' method="POST">
            {{ csrf_field() }}
            
              <div class="form-group">
                <label for="title" class="sr-only"><strong>Form Title :</strong></label>
                <input type="text" name="name" id="title" class="{{ $errors->has('title') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Form Title" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group">
                <label for="amount" class="sr-only"><strong>Price :</strong></label>
                <input type="number" name="amount" id="amount" class="{{ $errors->has('amount') ? 'form-control is-invalid' : 'form-control' }}" placeholder="Price" required>
                @if ($errors->has('amount'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
              </div>
              
              <div class="form-group"><strong>General Instruction :</strong>
                <label for="general_instruction"></label>
                <textarea name="general_instruction" placeholder="Type here..." id="area1" class="{{ $errors->has('general_instruction') ? 'form-control is-invalid' : 'form-control' }}" ></textarea>
                @if ($errors->has('general_instruction'))
                    <span class="invalid-feedback error-color red">
                        <strong>{{ $errors->first('general_instruction') }}</strong>
                    </span>
                @endif
              </div>
              
                <div class="row">
                    
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-12 "><strong>Form Opens
                                :</strong></label>
                        <div class="col-md-12">
                            <div class="input-group input-group-md open_date" id="open_date"
                                 data-provide="datepicker">
                                <input type="text" name="open_date" class="form-control" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-12 "><strong>Form Closes
                                :</strong></label>
                        <div class="col-md-12">
                            <div class="input-group input-group-md close_date" id="close_date"
                                 data-provide="datepicker">
                                <input type="text" name="close_date" class="form-control" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="required_sales"><strong>Required Sales ( zero for unlimited):</strong></label>
                        <input type="text" name="required_sales" id="required_sales" class="{{ $errors->has('required_sales') ? 'form-control is-invalid' : 'form-control' }}" value="0" placeholder="Required Sales ( zero for unlimited)" required>
                        @if ($errors->has('required_sales'))
                            <span class="invalid-feedback error-color red">
                                <strong>{{ $errors->first('required_sales') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12">
                    <br>
                    <input type="submit" class="btn btn-block btn-default" value="Finalize form">
                </div>
            </div>
        </form>
        </div>
    </div>
        

    </div>

</div>
<script src="https://stormmarts.com/artisan/assets/front/js/bootstrap-datepicker.min.js"></script>
<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'area1');
</script>
<script>
    // $('.datepicker').datepicker();
    var date = new Date();
    date.setDate(date.getDate());

    $('#open_date').datepicker({
        startDate: date
    });
    
    $('#close_date').datepicker({
        startDate: date
    });

</script>
@endsection