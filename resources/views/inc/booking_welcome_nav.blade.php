@php
 function logo(){
@endphp
<img src="{{asset('assets/images/ebeano-logo.png')}}" alt="Ebeano Market">
 @php 
 }
 @endphp
    
    <style>
        .eb-booking-list {
            margin-right:5px;
            box-shadow: none;
            border-radius: 4px;
            padding:10px 10px 17px 10px;
            margin-bottom: 20px;
        }
    
        .eb-booking-list:hover {
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
        .eb-widget-2 {
            background-color: rgb(131, 13, 146);
        }
        
nav > .nav.nav-tabs{
  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
}

nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #eb790f ;
}
.tab-content{
  background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #eb790f;
    border-bottom:5px solid #eb790f;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #eb790f;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
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
                             
                             <div class="d-none d-lg-inline-block">
                                 <a class="btn btn-primary" data-toggle="modal" data-target="#book_now" href="#" style="border-radius:50px;padding-left:70px;padding-right:70px">Book Now</a>
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>
 
 <!-- Navbar -->
 
 @if(isset($page_title) && $page_title=='Welcome to Ebeano Bookings')
 <!--Header section start-->
    <div class="row ">
        <div class="col-12 col-sm-12">
            <div class="hero-area dark-overlay" style="background: url({{asset('assets/booking/assets/frontend/img/home/banner_section/banner_image.jpg')}}) no-repeat" style="height:300px">
                <div class="container position-relative">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero-content cl-white text-center">
                                <h3 class="wow fadeInUp" data-wow-delay="0.3s">Find the best hotels & flight deals</h3>
                                <h5 class="mb-40 wow fadeInUp" data-wow-delay="0.5s">We work with more than 300 partners to bring you better travel & stay deals</h5>
                            </div>
                        </div>
                    </div>
        
                    <div class="row hero-search">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hero-filter-search wow fadeInUp" data-wow-delay="0.6s">
                                <nav style="top:-300px;">
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                      <a class="nav-item nav-link active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="true"><i class="fa fa-home" aria-hidden="true"></i> Hotels</a>
                                      <a class="nav-item nav-link" id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="false"><i class="fa fa-plane" aria-hidden="true"></i> Flights</a>
                                    </div>
                                  </nav>
                                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                                      @include('bookings.partials.hotel-search')
                                    </div>
                                    <div class="tab-pane fade" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                                      @include('bookings.partials.flight-search')
                                    </div>
                                    
                                  </div>
                                
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
            
        </div>
    </div>
 @endif