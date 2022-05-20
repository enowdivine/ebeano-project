<div class="modal fade" id="form-payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{__('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{__('Complete this payment form')}}</p>
                <h3>{{ $data->institute->name }}</h3>
                
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="la la-wpforms"></i></span>
                            </div>
                          <input type="text" id="form_title" readonly value="{{ $data->title }}" class="form-control validate">
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="la la-clipboard-check"></i></span>
                            </div>
                          <input type="text" id="form_reference" readonly value="{{ $data->reference }}" class="form-control validate">
                        </div>
                    </div>
                    
                </div>
        
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&#8358;</span>
                    </div>
                  <input type="number" id="form_amount" readonly value="{{ $data->amount }}" class="form-control validate">
                </div>
                
                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                          <input type="text" id="form_fname" placeholder="First Name" class="form-control validate">
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                          <input type="text" id="form_lname" placeholder="Last Name" class="form-control validate">
                        </div>
                    </div>
                
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                          <input type="text" id="form_phone" placeholder="Phone" class="form-control validate">
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                          <input type="text" id="form_email" placeholder="Email Address" class="form-control validate">
                        </div>
                    </div>
                </div>
                
                <div class="payment-preloader" style="display:none">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                <a onclick="ProceedFormPayment();this.disabled=true; this.value='Sending…';" class="btn btn-default btn-ok">{{__('Make Payment')}}</a>
            </div>
        </div>
    </div>
</div>