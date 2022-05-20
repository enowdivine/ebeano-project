@extends('layouts.artisan')

@section('content')
<section><br /><br /></section>

<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signup-popup-box static">
                        <div class="account-popup">
                            <h3>Login</h3>

                            <div class="select-user">
                                <span><a href="/Account/getStarted"><b>Sign Up</b></a></span>
                            </div>

                            <form action="/Account/Login" method="post">
                                <div class="cfield">
                                    <input class="form-control text-box single-line" id="Email" name="Email"
                                        placeholder="Email or Phone number (08000000000)" type="text" value="" />
                                    <i class="la la-envelope-o"></i>

                                </div>
                                <div class="cfield">
                                    <input class="form-control text-box single-line password" data-val="true"
                                        data-val-length="Password Incorrect" data-val-length-max="16"
                                        data-val-length-min="6" data-val-required="Password is required" id="Password"
                                        name="Password" placeholder="********" type="password" value="" />
                                    <i class="la la-key"></i>

                                </div>
                                <button type="submit" class="btn btn-success">Login</button>
                                <br /><br />
                                <ul>
                                    <a href="/Account/forgotPassword"><b>forgot password</b></a>
                                </ul>
                                <br />
                                <ul>
                                    <li> <span class="field-validation-valid text-danger" data-valmsg-for="Email"
                                            data-valmsg-replace="true"></span></li>
                                    <li> <span class="field-validation-valid text-danger" data-valmsg-for="Password"
                                            data-valmsg-replace="true"></span></li>
                                    <li><b> </b></li>
                                    <li><b></b></li>

                                </ul>
                                <input name="" type="hidden" value="" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection