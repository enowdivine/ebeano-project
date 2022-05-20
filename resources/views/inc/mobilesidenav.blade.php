
<div id="myNav" class="overlay">
    <div class="logo border-bottom">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  {{logo()}}
  </div>
  
  <div class="overlay-content">
  	<h3 style="color: #800080; font-size: 16px; font-weight: bold;" class="pt-3 px-2">Ebeano Account</h3>
  	<ul class="categories no-scrollbar">
  	@if (Auth::check())
  	    @if(Auth::user()->user_type == 'booking_agent')
  	        @if(Auth::user()->bookingclient->client_type == 2)
  	            <li><a class="p-2" href="{{route('booking.dashboard')}}"><i class="la la-home mr-2"></i>Airline Agent Dashboard</a></li>
      	        <li>
                    <a class="p-2" href="{{route('user.edit_profile')}}"><i class="la la-user mr-2"> </i> My Account</a>
                </li>
      	        <li>
                    <a class="p-2" href="{{route('flight.create-flight-available')}}"><i class="la la-dot-circle-o mr-2"> </i> Create Reservation</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('flight.flight-available')}}"><i class="la la-dot-circle-o mr-2"> </i> Available Flights</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('flight.flight-booked')}}"><i class="la la-dot-circle-o mr-2"> </i> Booked Flights</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('artisan.withdrawLog')}}"><i class="la la-money-bill-alt mr-2"> </i> Withdraw Request</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('artisan.payment-history')}}"><i class="la la-history mr-2"> </i> Payment history</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"> </i> My wallet</a>
                </li>
  	        @elseif(Auth::user()->bookingclient->client_type == 1)
  	            <li><a class="p-2" href="{{route('booking.dashboard')}}"><i class="la la-home mr-2"></i>Hotelier Agent Dashboard</a></li>
      	        <li>
                    <a class="p-2" href="{{route('user.edit_profile')}}"><i class="la la-user mr-2"> </i> My Account</a>
                </li>
      	        <li>
                    <a class="p-2" href="{{route('reservations')}}"><i class="la la-dot-circle-o mr-2"> </i> Reservations</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('guests')}}"><i class="la la-dot-circle-o mr-2"> </i> Guests</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('room_type')}}"><i class="la la-dot-circle-o mr-2"> </i> Room Types</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('room')}}"><i class="la la-dot-circle-o mr-2"> </i> Rooms</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('floor')}}"><i class="la la-dot-circle-o mr-2"> </i> Floors</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('amenities')}}"><i class="la la-dot-circle-o mr-2"> </i> Amenities</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('paid_service')}}"><i class="la la-dot-circle-o mr-2"> </i> Paid Service</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('coupon')}}"><i class="la la-dot-circle-o mr-2"> </i> Coupon Master</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('tax')}}"><i class="la la-dot-circle-o mr-2"> </i> Tax</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('artisan.withdrawLog')}}"><i class="la la-money-bill-alt mr-2"> </i> Withdraw Request</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('booking.payment-history')}}"><i class="la la-history mr-2"> </i> Payment history</a>
                </li>
                <li>
                    <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"> </i> My wallet</a>
                </li>
  	        @endif
  	            <li>
                    <a class="p-2" data-toggle="modal" data-target="#book_now" href="#"><i class="la la-book mr-2"> </i> Book Now</a>
                </li>
  	  @elseif(Auth::user()->user_type == 'artisan')
  	        <li><a class="p-2" href="/artisans"><i class="la la-shopping-bag mr-2"></i>My Artisan Dashboard</a></li>
  	        <li>
                <a class="p-2" href="{{route('artisan.all-artisans')}}"><i class="la la-user mr-2"> </i> View Artisans</a>
            </li>
  	        <li>
                <a class="p-2" href="{{route('create-job')}}"><i class="la la-plus-circle mr-2"> </i> Create Job</a>
            </li>
            <li>
                <a class="p-2" href="{{route('my-job')}}"><i class="la la-comment-alt mr-2"> </i> Manage Jobs</a>
            </li>
            <li>
                <a class="p-2" href="{{route('recent-job')}}"><i class="la la-box-open mr-2"> </i> Recent Jobs</a>
            </li>
            <li>
                <a class="p-2" href="{{route('artisan.withdrawLog')}}"><i class="la la-money-bill-alt mr-2"> </i> Withdraw Request</a>
            </li>
            <li>
                <a class="p-2" href="{{route('assign.list')}}"><i class="la la-heart-o mr-2"> </i> Awarded list</a>
            </li>
            <li>
                <a class="p-2" href="{{route('acquired.list')}}"><i class="la la-piggy-bank mr-2"> </i> Jobs Acquired list</a>
            </li>
            <li>
                <a class="p-2" href="{{route('artisan.payment-history')}}"><i class="la la-history mr-2"> </i> Payment history</a>
            </li>
            <li>
                <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"> </i> My wallet</a>
            </li>
            
            <li>
                <a class="p-2" href="{{route('kyc.upload')}}"><i class="la la-user-alt mr-2"> </i> My KYC</a>
            </li>
        @elseif(Auth::user()->user_type == 'institute_registrar')
  	        <li><a class="p-2" href="{{route('registrar.create.institute')}}"><i class="la la-campground mr-2"></i>My Institute</a></li>
  	        <li>
                <a class="p-2" href="{{route('registrar.create.eforms')}}"><i class="la la-plus-circle mr-2"> </i> Create Form</a>
            </li>
  	        <li>
                <a class="p-2" href="{{route('registrar.show.eforms')}}"><i class="la la-edit mr-2"> </i> Manage Forms</a>
            </li>
            <li>
                <a class="p-2" href="{{route('all.apply.eforms')}}"><i class="la la-comment-alt mr-2"> </i> Manage Applications</a>
            </li>
            <li>
                <a class="p-2" href="{{route('artisan.payment-history')}}"><i class="la la-box-open mr-2"> </i> Recent Jobs</a>
            </li>
            <li>
                <a class="p-2" href="{{route('artisan.payment-history')}}"><i class="la la-history mr-2"> </i> Payment history</a>
            </li>
            <li>
                <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"> </i> My wallet</a>
            </li>
        @elseif(Auth::user()->user_type == 'seller')
            <li><a class="p-2" href="/sellers/dashboard"><i class="la la-shopping-bag mr-2"></i>My seller Dashboard</a></li>
        @else
              <li><a class="p-2" href="/dashboard"><i class="la la-dashboard mr-2"></i>Dashboard</a></li>
        @endif
  	
  	  @if(Auth::user()->user_type !== 'artisan' && Auth::user()->user_type !== 'institute_registrar' && Auth::user()->user_type !== 'booking_agent')
        <li><a class="p-2" href="/user/orders"><i class="la la-box-open mr-2"></i>Order</a></li>
         <li>
            <a class="p-2" href="{{route('dashboard')}}"><i class="la la-user-alt mr-2"></i>My Account {{Auth::user()->user_type}}</a>
        </li>
        <li >
            <a class="p-2" href="{{route('orders')}}"><i class="la la-box-open mr-2"></i>Orders</a>
        </li>
        <li >
            <a class="p-2" href=""><i class="la la-comment-alt mr-2"></i>My Reviews</a>
        </li>
    
        <li >
            <a class="p-2" href="{{route('wishlists.index')}}"><i class="la la-heart-o mr-2"></i>Wishlist</a>
        </li>
    
        <li >
            <a class="p-2" href="#"><i class="la la-history mr-2"></i> Recently viewed</a>
        </li>
    
        <li >
            <a class="p-2" href="#"><i class="la la-support mr-2"></i>Support Ticket</a>
        </li>
        <li>
            <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"> </i>My wallet</a>
        </li>
      @endif
      <li >
            <a class="p-2" href="{{route('user.change_pass_page')}}"><i class="la la-key mr-2"> </i>Change Password</a>
    </li>
  	@else
  	
  	<li><a class="p-2" href="/login"><i class="la la-user mr-2"></i>Login</a></li>
    <li><a class="p-2" href="/register"><i class="la la-user-check mr-2"></i>Register</a></li>
  	@endif
  	    
  	@if(Auth::check())
  	    @if(Auth::user()->user_type == 'artisan')
        
        @elseif(Auth::user()->user_type == 'institute_registrar')
        
  	    @elseif(Auth::user()->user_type == 'seller')

            <a class="p-2" href="{{route('seller.product')}}"><i class="la la-box-open mr-2"></i>Products</a>
        </li>
        <li>
            <a class="p-2" href="{{route('seller.product_review')}}"><i class="la la-comment-alt mr-2"></i>Customer Reviews</a>
        </li>

        <li>
            <a class="p-2" href="{{route('seller.earning')}}"><i class="la  la-money-bill-alt mr-2"></i>Earnings/Withdrawals</a>
        </li>
        <li>
            <a class="p-2" href="{{route('seller.sales')}}"><i class="la la-money-bill-alt mr-2"></i>Sales</a>
        </li>
        <li>
            <a class="p-2" href="{{route('wallet.index')}}"><i class="la la-wallet mr-2"></i>My wallet</a>
  	    @elseif(Auth::user()->user_type == 'admin')
  	    <li><a class="p-2" href="/eb-admin"><i class="la la-dashboard mr-2"></i>Admin</a></li>
  	    @else
  	    <li><a class="p-2" href="{{route('vendor.quick_register')}}"><i class="la la-shopping-bag mr-2"></i>Become a Vendor</a></li>
  	    @endif
  	    <li><a class="p-2" href="/logout"><i class="la la-sign-out mr-2"></i>Logout</a></li>
  	@else
    <li><a class="p-2" href="{{route('vendor.quick_register')}}"><i class="la la-shopping-bag mr-2"></i>Become a Vendor</a></li>
    @endif
    </ul>
  </div>
  @if (Auth::check())
  @if(Auth::user()->user_type !== 'artisan' &&  Auth::user()->user_type !== 'institute_registrar')
  <div class = "overlay-content"><h3 style="color: #800080; font-size: 16px;font-weight: bold;">Categories</h3><!-- <a id="see" href="#">See all</a> -->
  	 <ul class="categories no-scrollbar">
                        @php 
                            $categories = App\Category::where('featured',1)->get();

                        @endphp
                        @if(count($categories) > 0)

                            @foreach($categories as $category)
                                <li><a class="p-2" href="{{route('products.by_category',['slug' => $category->slug])}}" class="cat-item"> {{Str::title($category->name)}} </a></li>
                            @endforeach
                        @endif
                    </ul>

</div>
@endif
@endif

    <div class = "overlay-content">
  	    <ul class="categories no-scrollbar">

            <li><a class="p-2" href="{{route('contact')}}" class="cat-item">Contact Us</a></li>
            <li><a class="p-2" href="{{route('about')}}" class="cat-item">About Us</a></li>
            <li><a class="p-2" href="{{route('help')}}" class="cat-item">Need Help?</a></li>
        </ul>

    </div>
</div>


