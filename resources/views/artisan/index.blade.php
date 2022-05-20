@extends('layouts.artisan')

@section('content')
    
    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-featured-sec">
                            <div class="new-slide-3">
                                <img src="./images1/myhandworkng_home.png" alt="" />
                            </div>
                            <div class="job-search-sec">
                                <div class="job-search">
                                    <br /><br />
                                    <h4 style="text-align:left;color:black">find handymen and artisans in Nigeria</h4>
                                    <span>Find handyman Jobs & Connect with Clients who need your service</span>

                                    <form action="/" class="job-search" method="post">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <select class="chosen" id="handworks" name="handworks">
                                                        <option value="AC Installation and Repair">AC Installation and
                                                            Repair</option>

                                                    </select>

                                                    <i class="la la-hand-grab-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                                <div class="job-field">
                                                    <select class="chosen" id="Location" name="Location">
                                                        <option value="Aba">Aba</option>

                                                    </select>
                                                    <i class="la la-map-marker"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                                <button type="submit"><i class="la la-search"></i></button>
                                            </div>
                                        </div>
                                        <input name="__RequestVerificationToken" type="hidden"
                                            value="CfDJ8GWqW66mGW5OvVk-MSZBP5RWrs5zFPzJHMFM-ayzavhjZOjw0qdi1X0wnj7vW5fZVJo3r-WofKyeg9cydAQmcLSBohGW8tNFRWnNN2HxIzZAZovOdK-D2wn6MqgoVtDm2YgkVPAJseB5p9aD3KND0ko" />
                                    </form>

                                    <div class="or-browser">
                                        <span>find handyman & artisan jobs</span>
                                        <a title="" href="./handyjobs">Apply now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="scroll-to">
                                <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section><br /></section>

    <section>
        <div class="block remove-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>How It Works</h2>
                            <span>
                                Find and Connect with handymen around your area or anywhere in Nigeria <br />With over
                                2million handymen and artisans in Nigeria.
                            </span>
                        </div><!-- Heading -->
                        <div class="how-to-sec style2">
                            <div class="how-to">
                                <span class="how-icon"><i class="la la-user"></i></span>
                                <h3>Register an account</h3>
                                <p>Sign up as a handyman who can get it fixed or as a client who needs the service of a
                                    handyman.</p>
                            </div>
                            <div class="how-to">
                                <span class="how-icon"><i class="la la-map-marker"></i></span>
                                <h3>Locate a handyman using our Directory</h3>
                                <p>Search handyman profiles using their handwork and connect with your matches by
                                    instant messaging or by phone call. </p>
                            </div>
                            <div class="how-to">
                                <span class="how-icon"><i class="la la-money"></i></span>
                                <h3>Negotiate, Deposit & Approve Payment</h3>
                                <p>Use the platform to deposit agreed payment with the handyman and approve payment to
                                    handyman after task is marked as completed by the handyman.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="browse-all-cat green">
                            <a class="rounded" href="./handworks">Begin Your Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block double-gap-top double-gap-bottom">
            <div data-velocity="-.1"
                style="background: url(./images1/myhandwork_repair.jpg) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text-block">
                            <h3>Make your Handwork Visible and Accessible</h3>
                            <span>Connecting clients with nearby handymen and artisans</span>
                            <a title="" href="./getStarted">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 column">
                        <div class="heading left">
                            <h2>Frequently Asked Questions?</h2>
                        </div><!-- Heading -->
                        <div id="toggle-widget" class="experties">
                            <h2>Who can register on myhandwork.ng?</h2>
                            <div class="content">
                                <p>Any handyman or artisan, Male or Female anywhere in Nigeria, who can help Clients to
                                    Get it fixed.</p>
                            </div>
                            <h2>Who is a Client on myhandwork.ng?</h2>
                            <div class="content">
                                <p>
                                    A Client is anyone who needs the service of a handyman anywhere in Nigeria.
                                    These Clients can register, assign task to a handyman and post handyman jobs. This
                                    will help handyman within that location to apply for handyman jobs and get connected
                                    with the Client.
                                </p>
                            </div>
                            <h2>How do Clients Assign Task to handymen?</h2>
                            <div class="content">
                                <p>Client must be registered and logged into the platform, search for handyman service
                                    and location, click on "Assign me a task" on the handyman profile page. Contact the
                                    handyman, negotiate payment and deposit fund.</p>
                            </div>
                            <h2>Must Negotiated Handyman Task Payment be made on myhandwork.ng platform?</h2>
                            <div class="content">
                                <p>No, however when funds are deposited on myhandwork.ng for any assigned task, this
                                    helps to ensure optimum service delivery from handymen and payment can be approved
                                    after assigned task is marked "completed" by the handyman and confirmed by the
                                    client. </p>
                            </div>
                            <h2>When do handymen receive approved payments from clients and any service charge?</h2>
                            <div class="content">
                                <p>Clients approved payments are sent to handymen 48hours after approval. Approved
                                    payments will attract 10% service charge of total amount for assigned task. However
                                    payments to handymen can be withheld if there are any further complaints from
                                    clients within the 48hours until all pending issues are resolved.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 column">
                        <div class="reviews-sec" id="reviews">
                            <div class="col-lg-6">
                                <div class="reviews style2">
                                    <img src="./images1/BlueflashLimited.png" alt="" />
                                    <h3>Blueflash Limited <span>Inverter & Solar Energy</span></h3>
                                    <p>Through myhandwork.ng platform, we have been able to hire handymen, connect with
                                        clients and execute projects in different locations in Nigeria.</p>
                                </div><!-- Reviews -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    @endsection