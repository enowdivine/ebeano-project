@php
 function logo(){
@endphp
<img src="{{asset('assets/images/ebeano-logo.png')}}" alt="Ebeano Market">
 @php 
 }
 @endphp
 
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
                     
                         <div class="logo-bar-icons d-inline-block ml-auto">
                             <div class="d-inline-block d-lg-none">
                                 <div class="nav-search-box eb-mobile-tap">
                                    @if (Auth::guest())
                                      <a href="/vendors/quick/registration"><i class="la la-plus la-flip-horizontal d-inline-block nav-box-icon" style="color:white"></i></a>
                                    @else
                                       <a href="/estate/agent/create"><i class="la la-plus la-flip-horizontal d-inline-block nav-box-icon" style="color:white"></i></a>
                                    @endif
                                 </div>
                             </div>
                             
                            <div class="d-none d-lg-inline-block eb-menu pt-2">
                                <ul>
                                    <li><a class="onepage" href="/estate/filter/property-for-sale">For Sale</a></li>
                                    <li><a class="onepage" href="/estate/filter/property-for-rent">For Rent</a></li>
                                    <li><a class="onepage" href="/estate/filter/property-for-shortlet">Short Let</a></li>
                                    <!--<li><a class="onepage" href="/estate/filter/agents">Agents</a></li>-->
                                </ul>
                            </div>
                             
                             <div class="d-none d-lg-inline-block pt-2">
                                 @if (Auth::guest())
                                 <a class="eb-post-estate" href="/vendors/quick/registration">Post Property</a>
                                 <a class="eb-post-estate" href="/login/estate">Login Agent</a>
                                 @else
                                 <a class="eb-post-estate" href="/estate/agent/create">Post Property</a>
                                 <a class="eb-post-estate" href="/estate/agent/home">Agent Dashboard</a>
                                 @endif
                                 
                             </div>
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>
 
 <!-- Navbar -->
