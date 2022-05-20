@extends('layouts.artisan')

@section('link')

@endsection

@section('script')
<script type="text/javascript">
    function AlertName() {
        //alert('You clicked ' + name + "!");
        $("#divTest").show();
        $("#divTest2").hide();
    }
</script>
@endsection

@section('content')
<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signup-popup-box static">
                        <div class="account-popup">
                            <h3>Client Sign-Up</h3>

                            <div class="select-user">

                                <span>Client</span>
                            </div>
                            <form action="/Account/ClientSignUp" method="post">
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-required="Please provide Username" id="CmURS" name="CmURS"
                                        placeholder="Username" type="text" value="" />
                                    <i class="la la-user"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-regex="Wrong email address"
                                        data-val-regex-pattern="^[\w\.-]&#x2B;@[\w\.-]&#x2B;\.\w{2,4}$"
                                        data-val-required="Please provide email" id="Email" name="Email"
                                        placeholder="Email" type="text" value="" />
                                    <i class="la la-envelope-o"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line password" data-val="true"
                                        data-val-length="Password must be 8 char long and 16 char max"
                                        data-val-length-max="16" data-val-length-min="8"
                                        data-val-required="Please provide Password" id="Password" name="Password"
                                        placeholder="password" type="password" value="" />
                                    <i class="la la-key"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-length="The Mobile number incorrect" data-val-length-max="11"
                                        data-val-length-min="10" data-val-regex="Please enter a valid Phone number."
                                        data-val-regex-pattern="^(\&#x2B;?1?( ?.?-?\(?\d{3}\)?) ?.?-?)?(\d{3})( ?.?-? ?\d{4})$"
                                        data-val-required="Please provide phone number" id="phone" name="phone"
                                        placeholder="08000000000" type="text" value="" />

                                    <i class="la la-phone"></i>

                                </div>
                                <div class="specialism_widget">
                                    <div class="simple-checkbox">
                                        <p><input data-val="true" data-val-required="The agreement field is required."
                                                id="agreement" name="agreement" type="checkbox" value="true" /><label
                                                for="agreement">I agree with <a href="/Home/TermsandCondition"
                                                    target="_blank">terms and condition</a></label></p>
                                    </div>
                                </div>
                                <div id="divTest2">
                                    <button type="submit" class="btn btn-success" onclick="AlertName()">Signup</button>
                                </div>
                                <div id="divTest" style="display: none;">
                                    <button type="button" class="btn btn-success"><i class="fa fa-spinner fa-spin"></i>
                                        Please wait</button>
                                </div>
                                <span><b></b></span><br>
                                <span><span class="field-validation-valid text-danger" data-valmsg-for="CmURS"
                                        data-valmsg-replace="true"></span></span><br>
                                <span> <span class="field-validation-valid text-danger" data-valmsg-for="Email"
                                        data-valmsg-replace="true"></span></span><br>
                                <span><span class="field-validation-valid text-danger" data-valmsg-for="phone"
                                        data-valmsg-replace="true"></span></span><br>
                                <span> <span class="field-validation-valid text-danger" data-valmsg-for="Password"
                                        data-valmsg-replace="true"></span></span><br>
                                <br />
                                <input name="__RequestVerificationToken" type="hidden"
                                    value="CfDJ8GWqW66mGW5OvVk-MSZBP5TB_R6LCJgPEcl9tX905UOKU1jLNoewgNHjyLCN2y-eomNFRCjdbr1gHNxHX_F2y9NimVOPN0afITl3T_8r-LEulKkymRkqEhvGLyx0DWoB7EvPOqmsNF0upYZ0vCPFJUU" /><input
                                    name="agreement" type="hidden" value="false" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection