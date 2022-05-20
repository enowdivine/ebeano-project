<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('meta_title', config('app.name', 'Ebeano ').'Artisans')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="/Uploads/General/myhandworkng.ico" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/bootstrap-grid.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/ats/css1/icons.css')}}">
    <link rel="stylesheet" href="{{asset('asset/ats/css1/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/chosen.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/colors.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('asset/ats/css1/bootstrapmaxcdn.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

</head>

<body class="newbg">
    <div class="theme-layout" id="scrollup">

        <div class="responsive-header three">
            <div class="responsive-menubar">
                <div class="res-logo"><a title="" href="./"><img src="" alt="" /></a></div>
                <div class="menu-resaction">
                    <div class="res-openmenu">
                        <img src="./images1/icon.png" alt="" /> Menu <i class="la la-bars"></i>
                    </div>
                    <div class="res-closemenu">
                        <img src="./images1/icon2.png" alt="" /> Close <i class="la la-close"></i>
                    </div>
                </div>
            </div>
            <div class="responsive-opensec ">
                <div class="btn-extars">
                    <a class="post-job-btn" href="./getStarted"><i class="la la-registered"></i>Register now</a>
                    <ul class="account-btns">
                        <li><a href="./Login"><i class="la la-sign-in"></i> Login</a></li>
                    </ul>
                </div>
                <div class="responsivemenu">
                    <ul>
                        <li>
                            <a href="./handworks">Find Handyman</a>
                        </li>
                        <li>
                            <a href="./handyJobs">Get a Handyman Job</a>
                        </li>
                        <li>
                            <a href="./blog"> Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <header class="stick-top forsticky new-header">
            <div class="menu-sec">
                <div class="container">
                    <div class="logo">
                        <a href="./"><img src="/Uploads/General/myhandworkng-logo.png" alt="" /></a>
                    </div><!-- Logo -->
                    <div class="btn-extars">
                        <a class="post-job-btn" href="./getStarted"><i class="la la-registered"></i>Register now</a>
                        <ul class="account-btns">
                            <li><a href="./Login"><i class="la la-sign-in"></i> Login</a></li>
                        </ul>

                    </div><!-- Btn Extras -->
                    <nav>
                        <ul>
                            <li>
                                <a href="./handworks">Find Handyman</a>
                            </li>
                            <li>
                                <a href="./handyJobs"> Get a Handyman Job</a>
                            </li>
                            <li>
                                <a href="./blog"> Blog</a>
                            </li>
                        </ul>
                    </nav><!-- Menus -->
                </div>
            </div>
        </header>

        <!-- Main Page-Body Content -->
        <section>

            @yield('content')

    <!-- LOGIN POPUP -->

    <!-- SIGNUP POPUP -->

        </section>

    <footer class="ft">
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 column">
                        <div class="widget">
                            <div class="about_widget">
                                <div class="logo">
                                    <a title="" href="./"><img src="/Uploads/General/myhandwork_ng.png" alt="" /></a>
                                </div>

                                <span> <a href="./Privacy" target="_blank">Privacy Policy </a></span>
                                <span>+234 701-219-2860</span>
                                <span>contact@myhandwork.ng</span>
                                <div class="social">
                                    <a href="" target="_blank" title=""><i class="fa fa-twitter"></i></a>
                                    <a href="" target="_blank" title=""><i class="fa fa-facebook"></i></a>
                                    <a href="" target="_blank" title=""><i class="la la-instagram"></i></a>
                                    <a href="" title=""><i class="la la-linkedin"></i></a>
                                    <a href="https://wa.me/message/S232FZLTJ6PBD1" title=""><i
                                            class="la la-whatsapp"></i></a>
                                </div>
                            </div><!-- About Widget -->

                        </div>
                    </div>
                    <div class="col-lg-2 column">
                        <div class="widget">
                            <h3 class="footer-title">About Us</h3>
                            <div class="link_widgets3 nolines">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="./HowItWorks">How it Works </a>
                                        <!-- <a href="/Home/Video_How_to_register_on_myhandworkng">Videos: How To Register </a>
                                            <a href="/Home/Video_How_it_works">Video: How it works </a>-->
                                        <a href="./TermsandCondition" title="" target="_blank">Terms & Condition </a>
                                        <a href="./Faq">FAQ’s </a>
                                        <a href="./Contact">Contact Us </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 column">
                        <div class="widget">
                            <h3 class="footer-title">Follow Us</h3>
                            <div class="link_widgets3 nolines">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="" target="_blank" title=""><i class="fa fa-facebook"></i> Facebook</a>
                                        <a href="" target="_blank" title=""><i class="fa fa-twitter"></i> Twitter</a>
                                        <a href="" target="_blank" title=""><i class="la la-instagram"></i>
                                            Instagram</a>
                                        <a href="" target="_blank" title=""><i class="la la-youtube"></i> YouTube</a>
                                        <a href="" title=""><i class="la la-linkedin"></i> Linkedin</a>
                                        <a href="" title=""><i class="la la-whatsapp"></i> Chat on WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-2 column">
                        <div class="widget">
                            <h3 class="footer-title">Partner With Us</h3>
                            <div class="link_widgets3 nolines">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="./PartnerSignup">Partner SignUp </a>
                                        <a href="./SecurityTips">Security Tips </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 column">
                        <div class="widget">
                            <h3 class="footer-title">Accepted Payments</h3>
                            <div class="subscribe_widget">
                                <p>We accept payments from any of the debit and credit cards.</p>

                                <img src="./images1/acceptedPayments.png" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bottom-line">
            <div class="container">
                <span>© <script>
                        document.write(new Date().getFullYear())
                    </script> Ebeano Market. All rights reserved.</span>
                <a href="#scrollup" class="scrollup" title=""><i class="la la-long-arrow-up"></i></a>
            </div>
        </div>
    </footer>
    </div>

    <script src="{{asset('asset/ats/js1/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/modernizr.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/script.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/parallax.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/select-chosen.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/ats/js1/counter.js')}}" type="text/javascript"></script>

</body>

</html>