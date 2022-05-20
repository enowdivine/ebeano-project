@php
 function logo(){
@endphp
<img src="{{asset('assets/images/ebeano-logo.png')}}" alt="Ebeano Market">
 @php 
 }
 @endphp
    <style>
        
        .header-area .eb-artisan-thumb  {
            background: url("assets/artisan/images/slider/slider_1534686772.png");
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            padding: 160px 0;
        }
        
        .header-section-top-part {
            color:white;
        }
        
        
.title-box {
    margin-bottom: 50px;
}
.title-box .title-center {
    text-transform: capitalize;
    font-weight: 400;
    text-align: center;
    margin: 0;
    background: url(../images/elements/line.png) no-repeat bottom center;
    padding-bottom: 20px;
}
.title-box .title-left {
    color: #1a1a1a;
    text-transform: capitalize;
    font-size: 37px;
    font-weight: 400;
    text-align: left;
    margin: 0;
    background: url(../images/elements/line.png) no-repeat bottom left;
    padding-bottom: 20px;
}
.title-box .description {
  font-weight: 300;
  max-width: 500px;
  font-family: 'Poppins',sans-serif;
  font-size: 14px;
  color: #777;
  margin: 15px auto 0;
}
.title-box .description-left {
  font-weight: 300;
  max-width: 500px;
  font-family: 'Poppins',sans-serif;
  font-size: 16px;
  color: #777;
  margin: 15px 0 0;
}
.no-padding-bottom{
	padding-bottom: 0
}
.no-padding-top{
	padding-top: 0
}
        
        /*=====================
   05. Artisan area 279, 67, +28
=====================*/
.eb-artisans-section {
  background-color: rgb(131, 13, 146);
  padding: 50px 0px; }
  @media (max-width: 480px) {
    .eb-artisans-section .eb-artisans-content {
      text-align: center; } }
  .eb-artisans-section .eb-artisans-content .eb-artisans-text {
    float: left; }
    @media (max-width: 480px) {
      .eb-artisans-section .eb-artisans-content .eb-artisans-text {
        float: none;
        margin-bottom: 20px; } }
    .eb-artisans-section .eb-artisans-content .eb-artisans-text h2 {
      font-weight: 400;
      color: #fff;
      text-transform: capitalize; }
      @media (max-width: 990px) {
        .eb-artisans-section .eb-artisans-content .eb-artisans-text h2 {
          font-size: 30px; } }
      @media (max-width: 640px) {
        .eb-artisans-section .eb-artisans-content .eb-artisans-text h2 {
          font-size: 22px; } }
  .eb-artisans-section .eb-artisans-content .eb-artisans-user {
    float: right; }
    @media (max-width: 480px) {
      .eb-artisans-section .eb-artisans-content .eb-artisans-user {
        float: none; } }
    .eb-artisans-section .eb-artisans-content .eb-artisans-user button {
      text-transform: uppercase;
      border: 2px solid #131C24;
      -webkit-border-radius: 25px;
      -moz-border-radius: 25px;
      border-radius: 25px;
      color: #fff;
      padding: 8px 20px;
      background-color: transparent;
      margin-right: 20px;
      outline: none;
      -webkit-transition: all 0.5s ease-in-out;
      -o-transition: all 0.5s ease-in-out;
      transition: all 0.5s ease-in-out; }
      @media (max-width: 320px) {
        .eb-artisans-section .eb-artisans-content .eb-artisans-user button {
          margin-bottom: 20px; } }
      .eb-artisans-section .eb-artisans-content .eb-artisans-user button:hover {
        background-color: #131C24; }
    .eb-artisans-section .eb-artisans-content .eb-artisans-user button.button-hover {
      background-color: #131C24; }
      .eb-artisans-section .eb-artisans-content .eb-artisans-user button.button-hover:hover {
        background-color: #A20DCD; }
        
    </style> 
    
    <style>
        .eb-artisan-list {
            margin-right:5px;
            box-shadow: none;
            border-radius: 4px;
            padding:10px 10px 17px 10px;
            margin-bottom: 20px;
        }
    
        .eb-artisan-list:hover {
            box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
            border:1px solid rgb(131, 13, 146);
        }
        
        .btn-primary {
            color: #fff;
            background-color: rgb(131, 13, 146);
            border-color: rgb(131, 13, 146);
        }
        .btn-primary:hover {
            background-color: #A20DCD;
            border-color: rgb(131, 13, 146);
        }
        .badge-primary {
            color: #fff;
            background-color: rgb(131, 13, 146);
            padding:5px;
        }
        .badge-highlight {
            color: #fff;
            background-color: #eb790f;
            padding:3px;
            border-radius:10px;
        }
        .part-badge {
            color: #fff;
            background-color: #eb790f;
            padding:3px;
            border-radius:10px;
        }
        .eb-color {
            color: #eb790f;
        }
        .eb-widget {
            background-color: #eb790f;
        }
    </style>

<!-- mobile menu -->
 <div class="mobile-side-menu hide d-lg-none">
     <div class="side-menu-wrap opacity-0">
         <div class="side-menu closed">
             <div class="side-menu-list px-3">
                 @include('inc/mobilesidenav')
                 
             </div>
         </div>
     </div>
 </div>
 <!-- end mobile menu -->
 
 <div class="position-relative logo-bar-area sticky-top">
     <div class="">
         <div class="container">
             <div class="row no-gutters align-items-center">
                 <div class="col-lg-3 col-8">
                     <div class="d-flex">
                         <div class="d-block d-lg-none mobile-menu-icon-box">
                             <!-- Navbar toggler  -->
                             <div class="hamburger-menu">
                                 <span style="font-size:25px;cursor:pointer" onload="Onload()"
                                     Onclick="openNav()">&#9776;</span>
                                 

                             </div>
                             {{-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mobileNav" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                               <span class="navbar-toggler-icon"></span>
                           </button> --}}
                         </div>

                         <!-- Brand/Logo -->
                         <a class="navbar-brand w-100" href="/">
                             {{logo()}}

                         </a>

                     </div>
                 </div>
                 <div class="col-lg-9 col-4 position-static">
                     <div class="d-flex w-100">
                         <div class="search-box flex-grow-1 px-4">
                             <form action="/search" method="GET">
                                 <div class="d-flex position-relative">
                                     <div class="d-lg-none search-box-back">
                                         <button class="" type="button"><i class="la la-long-arrow-left"></i></button>
                                     </div>
                                     <div class="w-100">
                                         <input type="text" aria-label="Search" id="search" name="q" class="w-100"
                                             placeholder="What are you looking for..." autocomplete="off">
                                     </div>

                                     <button class="d-none d-lg-block" type="submit">
                                         <i class="la la-search la-flip-horizontal"></i>
                                     </button>
                                     <div class="typed-search-box d-none">
                                         <div class="search-preloader">
                                             <div class="loader">
                                                 <div></div>
                                                 <div></div>
                                                 <div></div>
                                             </div>
                                         </div>
                                         <div class="search-nothing d-none">

                                         </div>
                                         <div id="search-content">

                                         </div>
                                     </div>
                                 </div>
                             </form>

                         </div>

                         <div class="logo-bar-icons d-inline-block ml-auto">
                             <div class="d-inline-block d-lg-none">
                                 <div class="nav-search-box">
                                     <a href="#" class="nav-box-link">
                                         <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                     </a>
                                 </div>
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>
 
 <!-- Navbar -->
 
 <!--Header section start-->
<section class="header-area">
    @if(isset($page_title) && $page_title=='home_page')
    <div class="eb-artisan-thumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-section-wrapper justify-content-center">
                        <div class="header-section-top-part">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endif
   
   @if (!Auth::check())
    <!-- Admin section start -->
    <div class="eb-artisans-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- admin content start -->
                    <div class="eb-artisans-content">
                        <!-- admin text start -->
                        <div class="eb-artisans-text" style="color:white">
                            <h2>Ebeano artisans are ready. Are you ?</h2>
                        </div>
                        <!-- admin text end -->
                        <!-- admin user start -->
                        <div class="eb-artisans-user">
                    
                            <a href="/login/artisan">
                                <button class="button-hover" type="submit" name="login">sign in</button>
                            </a>
                            <a href="{{route('vendor.quick_register')}}">
                                <button type="submit" name="register">register now</button>
                            </a>
                            
                        </div>
                        <!-- admin user end -->
                    </div>
                    <!-- eb-artisans-content end -->
                </div>
            </div>
        </div>
    </div>
    
    @endif       
</section>

@if (!Auth::check())
<section class="our-services no-padding-bottom no-padding-top mt-4">
		<div class="container">
			<div class="title-box">
				<h2 class="text-center">Our Offers</h2>
				<p class="description text-center">We offer you best and skilled artisans to get your job done without any discrepancy</p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single-service-item">
					
						<span class="top-border"></span>
	                    <span class="right-border"></span>
	                    <span class="bottom-border"></span>
						
						<div class="service-left-bg"></div>
						<div class="service-icon">
							<img width="128" height="128" src="assets/artisan/images/slider/artisan1.png" alt="programmer">

						</div>
						<div class="service-text">
							<h4><a href="#">Expert & Experienced</a></h4>
							<p>We put so much thought and effort into ensuring that you are provided with expert and experienced artisans to get your job done for you. Artisans here are very skillful, competent and highly professional.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single-service-item">
					
						<span class="top-border"></span>
	                    <span class="right-border"></span>
	                    <span class="bottom-border"></span>
						
						<div class="service-left-bg"></div>
						<div class="service-icon">
							
							<img width="128" height="128" src="assets/artisan/images/slider/artisan2.png" alt="design">


						</div>
						<div class="service-text">
							<h4><a href="#">Credible & Timely</a></h4>
							<p>Our artisans do not waste time on any job. We make sure your job is delivered at the due time. Their services are credible and top-notch without any delay. This is second to none.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single-service-item">
					
						<span class="top-border"></span>
	                    <span class="right-border"></span>
	                    <span class="bottom-border"></span>
						
						<div class="service-left-bg"></div>
						<div class="service-icon">
							<img width="132" height="132" src="assets/artisan/images/slider/artisan3.png" alt="Dm">
						</div>
						<div class="service-text">
							<h4><a href="#">Professional Service Delivery</a></h4>
							<p>One of our biggest brag-points is the top-notch service provided by Ebeano Artisans. Services are delivered professionally to ensure the scope of trust building and relationship is enhanced.</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>	
	</section>
@endif


