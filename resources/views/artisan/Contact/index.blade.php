@extends('layouts.artisan')


@section('content')
    

<section>
    <p><br /></p>
</section>


<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 column">
                    <div class="contact-form">
                        <h3>Keep In Touch</h3>
                        <form action="/Home/Contact" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pf-field">
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="full name is required" id="Fullname" name="Fullname"
                                            placeholder="Full name" type="text" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="pf-field">
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-regex="wrong email address"
                                            data-val-regex-pattern="^[\w\.-]&#x2B;@[\w\.-]&#x2B;\.\w{2,4}$"
                                            data-val-required="email is required" id="Email" name="Email"
                                            placeholder="Email address" type="text" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="pf-field">
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="subject is required" id="Subject" name="Subject"
                                            placeholder="Message title or subject" type="text" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Message</span>
                                    <div class="pf-field">
                                        <textarea data-val="true" data-val-required="message is required"
                                            htmlAttributes="{ class = form-control, placeholder = let us hear from you }"
                                            id="Message" name="Message">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div>
                                        <div class="g-recaptcha"
                                            data-sitekey="6LdbrJYUAAAAABDg_BhHPUEmLzb7N-LZBNXjNnMl"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="aply-btn">Send</button>

                                </div>
                                <div class="col-lg-6">
                                    <span><span class="field-validation-valid text-danger" data-valmsg-for="Message"
                                            data-valmsg-replace="true"></span></span><br>
                                    <span> <span class="field-validation-valid text-danger" data-valmsg-for="Email"
                                            data-valmsg-replace="true"></span></span><br>
                                    <span><span class="field-validation-valid text-danger" data-valmsg-for="Fullname"
                                            data-valmsg-replace="true"></span></span><br>
                                    <span> <span class="field-validation-valid text-danger" data-valmsg-for="Subject"
                                            data-valmsg-replace="true"></span></span><br>
                                    <span> <span class="field-validation-valid text-danger"
                                            data-valmsg-for="GoogleReCaptchaResponse"
                                            data-valmsg-replace="true"></span></span>
                                </div>
                            </div>
                            <input name="__RequestVerificationToken" type="hidden"
                                value="CfDJ8GWqW66mGW5OvVk-MSZBP5QstDKDA9oUXd7RoIueKsCQvcbSuvvQIFvaazstv0fIh4oxgFIW69WwH7VW7Axj-siVNsO9dnp5Hi2RDtch2_f3pTA9t3otYOs3xcM5POc6C2JLihkba07kgSC1cBHwVgo" />
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 column">
                    <div class="contact-textinfo">
                        <h3>Office</h3>
                        <ul>
                            <li><i class="la la-map-marker"></i><span>myhandwork.ng </span></li>
                            <li><i class="la la-phone"></i><span>Call Us : +234 701-219-2860</span></li>
                            <li><i class="la la-whatsapp"></i><span><a href="https://wa.me/message/S232FZLTJ6PBD1"
                                        target="_blank">Chat on WhatsApp</a></span></li>
                            <li><i class="la la-envelope-o"></i><span>Email : contact@myhandwork.ng</span></li>
                        </ul>
                        <a class="fill" href="#" title="">See on Map</a><a href="#" title="">Directions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section><br /></section>

@endsection