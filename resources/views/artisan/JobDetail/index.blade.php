@extends('layouts.artisan')

@section('content')
<div class="block no-padding">
    <div class="container">
        <div class="row no-gape">

            <div class="col-lg-12 column">

                <p><br /></p>
                <p></p>

                <section>
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 column">
                                    <div class="job-single-sec style3">
                                        <div class="job-head-wide">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="job-single-head3">
                                                        <div class="job-thumb"> <img
                                                                src="https://d3ty35mhs7yv2e.cloudfront.net/251.png"
                                                                width="120" height="120" alt="" /> </div>
                                                        <div class="job-single-info3">
                                                            <h3>Posted By: myhandwork.ng</h3>
                                                            <span><i class="la la-map-marker"></i>Abuja (FCT)
                                                            </span><span class="job-is ft"><a
                                                                    href="#">Permanent</a></span>
                                                            <ul class="tags-jobs">
                                                                <li><i class="la la-file-text"></i> Location: Abuja</li>
                                                                <li><i class="la la-calendar-o"></i> Posted on:
                                                                    Saturday, December 5, 2020</li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- Job Head -->
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="emply-btns">
                                                        <a class="followus signup-popup" title=""><i
                                                                class="la la-paper-plane"></i><b> Apply for job </b>
                                                        </a>
                                                    </div>
                                                    <p><br /><br /></p>

                                                    <div class="share-bar">
                                                        <a onClick="shareOnFB()" title="" class="share-fb"><i
                                                                class="fa fa-facebook"></i></a><a
                                                            onClick="shareOntwitter()" title="" class="share-twitter"><i
                                                                class="fa fa-twitter"></i></a><a
                                                            href="https://api.whatsapp.com/send?text=Apply for handyman job, Driver at AVK Security Services Nigeria Limited at Abuja on myhandwork.ng using this Link: https://myhandwork.ng/Handworks/handyJobDetail/251"
                                                            target="_blank"><i
                                                                class="fa fa-whatsapp"></i></a><span>Share</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-wide-devider">
                                            <div class="row">
                                                <div class="col-lg-8 column">

                                                    <div class="job-details">
                                                        <h3><a class="badge badge-success"
                                                                style="font-size:medium">HandyJob</a></h3>
                                                        <p><b style="font-size:19px;">Driver at AVK Security Services
                                                                Nigeria Limited</b></p>

                                                    </div>

                                                    <div class="job-details">
                                                        <h3><a class="badge badge-success"
                                                                style="font-size:medium">HandyJob Description</a></h3>
                                                        <p style="font-size:15px;">Manage, drive and maintain
                                                            vehicle.&#xD;&#xA;Applicants must be resident in
                                                            Abuja&#xD;&#xA;Applicants must posses a minimum of SSCE
                                                            certificate, have a valid driver&#x2019;s license, must be
                                                            able to communicate effectively in
                                                            English.&#xD;&#xA;Applicants should possess 3 &#x2013; 15
                                                            years work experience.&#xD;&#xA;Applicant must have a good
                                                            knowledge of Abuja Metropolis&#xD;&#xA;Applicant must be
                                                            smart, punctual and honest..</p>

                                                        <br />
                                                        <p style="font-size:14px;">
                                                            <b>Application Deadline: </b>
                                                            Thursday, December 31, 2020
                                                        </p>
                                                    </div>

                                                    <div class="recent-jobs">
                                                        <h3><a class="badge badge-success"
                                                                style="font-size:medium">Similar Jobs</a></h3>
                                                        <div class="job-list-modern">
                                                            <div class="job-listings-sec no-border">

                                                                <div class="job-listing wtabs">
                                                                    <div class="job-title-sec">

                                                                        <div class="c-logo"> <img
                                                                                src="https://d3ty35mhs7yv2e.cloudfront.net/handyman_ngList.png"
                                                                                width="80" height="85" alt="" /> </div>
                                                                        <h3><a href="/Handworks/handyJobDetail/76">Dispatch
                                                                                Riders at Whytehors Limited</a></h3>
                                                                        <div class="job-lctn"><i
                                                                                class="la la-map-marker"></i>Lagos,
                                                                            Nigeria, Lagos State</div>
                                                                    </div>
                                                                    <div class="job-style-bx">
                                                                        <span class="job-is ft">Contract</span>
                                                                        <span class="fav-job"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="job-listing wtabs">
                                                                    <div class="job-title-sec">

                                                                        <div class="c-logo"> <img
                                                                                src="https://d3ty35mhs7yv2e.cloudfront.net/77.png"
                                                                                width="80" height="85" alt="" /></div>
                                                                        <h3><a href="/Handworks/handyJobDetail/77">Dispatch
                                                                                Rider at Conciliandos Computer Store</a>
                                                                        </h3>
                                                                        <div class="job-lctn"><i
                                                                                class="la la-map-marker"></i>Ogba,
                                                                            Lagos, Ogba</div>
                                                                    </div>
                                                                    <div class="job-style-bx">
                                                                        <span class="job-is ft">Contract</span>
                                                                        <span class="fav-job"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="job-listing wtabs">
                                                                    <div class="job-title-sec">

                                                                        <div class="c-logo"> <img
                                                                                src="https://d3ty35mhs7yv2e.cloudfront.net/78.jpg"
                                                                                width="80" height="85" alt="" /></div>
                                                                        <h3><a href="/Handworks/handyJobDetail/78">Dispatch
                                                                                Rider at a Courier Service Company</a>
                                                                        </h3>
                                                                        <div class="job-lctn"><i
                                                                                class="la la-map-marker"></i>90, Olonode
                                                                            Street, Off Alagomeji, Sabo Yaba, Lagos,
                                                                            Yaba</div>
                                                                    </div>
                                                                    <div class="job-style-bx">
                                                                        <span class="job-is ft">Contract</span>
                                                                        <span class="fav-job"></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 column">
                                                    <!-- Job Overview panel, can be Ads-->
                                                    <!-- Contact Form for google ads, can be Ads-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="account-popup-area signup-popup-box">
                        <div class="account-popup">
                            <span class="close-popup"><i class="la la-close"></i></span>
                            <h4>Are you a registered handyman ?</h4>

                            <div class="select-user">
                                <span><a href="/Handworks/handyJobApplication/251">Yes</a></span>
                                <span><a href="/Account/SignUp">No</a></span>
                            </div>

                        </div>
                    </div><!-- SIGNUP POPUP -->

                    <span><b></b></span><br>
                </section>
                <script type="text/javascript">
                    function shareOnFB() {
                        var url = "";
                        window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
                        return false;
                    }

                    function shareOntwitter() {
                        var url = '';
                        TwitterWindow = window.open(url, 'TwitterWindow', width = 600, height = 300);
                        return false;
                    }
                </script>
                <section><br /></section>
            </div>

        </div>
    </div>
</div>
<br />

@endsection