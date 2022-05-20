@extends('layouts.artisan')

@section('content')

<section><br /><br /></section>

<script type="text/javascript">
    function AlertName() {
        //alert('You clicked ' + name + "!");
        $("#divTest").show();
        $("#divTest2").hide();
    }
</script>

<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signup-popup-box static">
                        <div class="account-popup">

                            <div class="select-user">
                                <span>Partner Registration</span>
                            </div>

                            <form action="/Account/PartnerSignup" enctype="multipart/form-data" method="post">
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-required="The BusinessName field is required." id="BusinessName"
                                        name="BusinessName" placeholder="Business Name" type="text" value="" />
                                    <i class="la la-user"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-required="The RegistrationNumber field is required."
                                        id="RegistrationNumber" name="RegistrationNumber"
                                        placeholder="RC or BN Registration Number" type="text" value="" />
                                    <i class="la la-registered"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-regex="Wrong email address"
                                        data-val-regex-pattern="^[\w\.-]&#x2B;@[\w\.-]&#x2B;\.\w{2,4}$"
                                        data-val-required="Email is required" id="Email" name="Email"
                                        placeholder="Email" type="text" value="" />
                                    <i class="la la-envelope-o"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line password" data-val="true"
                                        data-val-length="Password must be 8 char long and 16 char max"
                                        data-val-length-max="16" data-val-length-min="8"
                                        data-val-required="Passsword is required" id="Password" name="Password"
                                        placeholder="Password" type="password" value="" />
                                    <i class="la la-key"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line" data-val="true"
                                        data-val-length="The Mobile number incorrect" data-val-length-max="11"
                                        data-val-length-min="10" data-val-regex="Please enter a valid Phone number."
                                        data-val-regex-pattern="^(\&#x2B;?1?( ?.?-?\(?\d{3}\)?) ?.?-?)?(\d{3})( ?.?-? ?\d{4})$"
                                        data-val-required="Phone number required" id="phone" name="phone"
                                        placeholder="08000000000" type="text" value="" />

                                    <i class="la la-phone"></i>

                                </div>
                                <div class="upload-portfolio">
                                    <div class="uploadbox">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="la la-cloud-upload"></i> <span style="color:green">Upload Business
                                                CAC Registration document</span>
                                        </label>
                                        <input id="file-upload" type="file" name="file" />
                                    </div>

                                </div>
                                <div class="specialism_widget">
                                    <div class="simple-checkbox">
                                        <p><input data-val="true" data-val-required="The agreement field is required."
                                                id="agreement" name="agreement" type="checkbox" value="true" /><label
                                                for="agreement">I agree with <a href="/Home/TermsandCondition"
                                                    target="_blank">terms and condition</a></label></p>
                                    </div>
                                </div>
                                <span><b></b></span><br>
                                <span><b></b></span><br>
                                <span> <span class="field-validation-valid text-danger" data-valmsg-for="Email"
                                        data-valmsg-replace="true"></span></span><br>
                                <span><span class="field-validation-valid text-danger" data-valmsg-for="phone"
                                        data-valmsg-replace="true"></span></span><br>
                                <span> <span class="field-validation-valid text-danger" data-valmsg-for="Password"
                                        data-valmsg-replace="true"></span></span><br>
                                <div id="divTest2">
                                    <button type="submit" class="btn btn-success"
                                        onclick="AlertName()">Register</button>
                                </div>
                                <div id="divTest" style="display: none;">
                                    <button type="button" class="btn btn-success"><i class="fa fa-spinner fa-spin"></i>
                                        Please wait</button>
                                </div>
                                <br />
                                <input name="" type="hidden" value="" /><input name="agreement" type="hidden"
                                    value="false" />
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection