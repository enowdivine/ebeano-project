@extends('layouts.artisan')


@section('content')

<div class="block no-padding">
    <div class="container">
        <div class="row no-gape">

            <div class="col-lg-12 column">
                <section><br /><br /></section>

                <script type="text/javascript">
                    function AlertName() {
                        $("#divTest").show();
                        $("#divTest2").hide();
                    }
                </script>

                <div class="block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 column">
                                <div class="job-single-sec style3">
                                    <div class="job-wide-devider">
                                        <div class="job-overview divide">
                                            <h3><b><a class="badge badge-success" style="font-size:medium">Personal
                                                        Information</a></b></h3>
                                            <ul>
                                                <li>
                                                    <i class="la la-check-circle"></i>
                                                    <h3>Status </h3><span><b>Verified <img
                                                                src="/Uploads/General/myhandworkng_verify.png"
                                                                width="29" height="37" /></b></span>
                                                </li>
                                                <li><i class="la la-star-o"></i>
                                                    <h3>Rating </h3><span><b>Not Rated</b></span>
                                                </li>
                                                <li><i class="la la-map-marker"></i>
                                                    <h3>Locations</h3><span>Benin City</span>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><i class="la la-hand-paper-o"></i>
                                                    <h3>Handwork</h3><span>Soundproof and Mini Generators</span>
                                                </li>
                                                <li><i class="la la-clock-o"></i>
                                                    <h3>Completed Task</h3><span>None</span>
                                                </li>
                                                <li><i class="la la-map-pin"></i>
                                                    <h3>State</h3><span>Edo</span>
                                                </li>
                                            </ul>

                                        </div><!-- Job Overview -->
                                        <div class="job-details">
                                            <h3><b><a class="badge badge-success" style="font-size:medium">Skills
                                                        Description and Services</a></b></h3>
                                            <p></p>
                                            <p>We repair all kinds of generators ,both diesel and petrol generator and
                                                we help you to get it fixed whenever called.</p>
                                        </div>

                                        <div class="recent-jobs">
                                            <h3><b><a class="badge badge-success" style="font-size:medium">Completed or
                                                        On-going Project</a></b></h3>

                                            <div class="job-list-modern">
                                                <div class="job-listings-sec no-border">
                                                    <div class="job-listing wtabs noimg">
                                                        <div class="job-title-sec">
                                                            <h3><a title=""><b>Repair of SoundProof and Mini
                                                                        Generators</b></a></h3>
                                                            <span>We repair and fix all kinds of sound proof and small
                                                                or mini generators like ELEPAQ and Mikano etc. </span>
                                                            <div class="job-lctn"><i class="la la-map-marker"></i>Benin
                                                                City</div>
                                                        </div>
                                                        <div class="job-style-bx">
                                                            <span class="job-is ft">Completed</span>
                                                            <span class="fav-job"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tags-share">
                                            <div class="tags_widget">
                                                <span></span>
                                                <a href="https://myhandwork.ng/Handworks?handwork=Soundproof and Mini Generators&location=Benin City"
                                                    title="">Soundproof and Mini Generators at Benin City</a>
                                            </div>
                                            <div class="share-bar">
                                                <a onClick="shareOnFB()" title="" class="share-fb"><i
                                                        class="fa fa-facebook"></i></a><a onClick="shareOntwitter()"
                                                    title="" class="share-twitter"><i class="fa fa-twitter"></i></a><a
                                                    href="https://api.whatsapp.com/send?text=Assign God&#x27;s will a task on myhandwork.ng using this Link: https://myhandwork.ng/Handworks/Detail/Omotech"
                                                    target="_blank"><i class="fa fa-whatsapp"></i></a><span>Share</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 column">
                                <div class="reviews style2">
                                    <img src="https://d19620mnk6hjug.cloudfront.net/Omotech.jpg" alt=""
                                        style="width:200px; height:200px;" />
                                </div><!-- Reviews -->
                                <div class="job-single-head style2">

                                    <div class="job-head-info">
                                        <h4><b>God&#x27;s will Ukhurebor</b></h4>

                                        <span>Along country home road, opposite Juka street</span>

                                        <div id="divTest2">
                                            <i class="la la-phone"></i> +234 *******0840
                                        </div>

                                    </div>
                                    <div class="share-bar">
                                        <a href="https://www.instagram.com/" title="" target="_blank"
                                            class="share-insta"><i class="la la-instagram"></i></a><a
                                            href="https://www.facebook.com/" title="" target="_blank"
                                            class="share-fb"><i class="fa fa-facebook"></i></a><a
                                            href="https://www.twitter.com/" title="" target="_blank"
                                            class="share-twitter"><i class="fa fa-twitter"></i></a>
                                    </div>

                                    <div class="emply-btns">
                                        <a class="followus signup-popup" title=""><i class="la la-hand-o-right"
                                                style="font-size:18px;"></i><b> Assign me a task </b> </a>

                                    </div>
                                </div><!-- Job Head -->

                            </div>

                        </div>

                        <br />
                        <br />
                        <h6>Similar Profiles Nearby</h6>
                        <hr />

                        <div class="block less-top">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-12 column">

                                        <div class="emply-list-sec style2">
                                            <div class="row" id="masonry">

                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="emply-list">
                                                        <div class="emply-list-thumb">
                                                            <a href="#" title=""><img
                                                                    src="https://d19620mnk6hjug.cloudfront.net/Jagaban.jpg"
                                                                    height="90" /></a>
                                                        </div>
                                                        <div class="emply-list-info">
                                                            <div class="emply-pstn"></div>
                                                            <h3><a title="" href="/Handworks/Detail/Jagaban">Yemi,
                                                                    Oluwanishola</a></h3>
                                                            <span>Soundproof and Mini Generators</span>
                                                            <h6><i class="la la-map-marker"></i> Ogba</h6>
                                                        </div>
                                                    </div><!-- Employe List -->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="emply-list">
                                                        <div class="emply-list-thumb">
                                                            <a href="#" title=""><img
                                                                    src="https://d19620mnk6hjug.cloudfront.net/IFECHUKWU.jpg"
                                                                    height="90" /></a>
                                                        </div>
                                                        <div class="emply-list-info">
                                                            <div class="emply-pstn"></div>
                                                            <h3><a title="" href="/Handworks/Detail/IFECHUKWU">Ifenna ,
                                                                    Udochukwu </a></h3>
                                                            <span>Soundproof and Mini Generators</span>
                                                            <h6><i class="la la-map-marker"></i> Lagos Mainland</h6>
                                                        </div>
                                                    </div><!-- Employe List -->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="emply-list">
                                                        <div class="emply-list-thumb">
                                                            <a href="#" title=""><img
                                                                    src="https://d19620mnk6hjug.cloudfront.net/Stanley.jpg"
                                                                    height="90" /></a>
                                                        </div>
                                                        <div class="emply-list-info">
                                                            <div class="emply-pstn"></div>
                                                            <h3><a title="" href="/Handworks/Detail/Stanley">Stanley,
                                                                    Nwali</a></h3>
                                                            <span>Soundproof and Mini Generators</span>
                                                            <h6><i class="la la-map-marker"></i> Lagos State</h6>
                                                        </div>
                                                    </div><!-- Employe List -->
                                                </div>

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
                        <h4>Are you a registered client ?</h4>

                        <div class="select-user">
                            <span><a href="/Client/Assign_me_a_task/Omotech?id=Omotech">Yes</a></span>
                            <span><a href="/Account/ClientSignUp">No</a></span>
                        </div>

                    </div>
                </div><!-- SIGNUP POPUP -->

                <script type="text/javascript">
                    $('#cbSafetyManagement').change(
                        function(e) {
                            // code here to hide your text
                            var checked = $(this).attr('checked');
                            if (checked) {
                                $('#divTest').show();
                            } else {
                                $('#divTest').hide();
                            }
                        }
                    );

                    // function shareOnFB() {
                    //     var url =
                    //         "https://www.facebook.com/sharer/sharer.php?u=https://myhandwork.ng/Handworks/Detail/Omotech&t=Assign me a task on myhandwork.ng";
                    //     window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
                    //     return false;
                    // }

                    // function shareOntwitter() {
                    //     var url =
                    //         'https://twitter.com/intent/tweet?url=https://myhandwork.ng/Handworks/Detail/Omotech&via=myhandworkng&text=Assign me a task on myhandwork.ng';
                    //     TwitterWindow = window.open(url, 'TwitterWindow', width = 600, height = 300);
                    //     return false;
                    // }
                </script>

            </div>

        </div>
    </div>
</div>
<br/>
@endsection
