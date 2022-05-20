<style>
    .nav-item .nav-link {
        color:white;
    }
    .nav-link .la {
        color:white;
    }
    .text-tsk{
        background: #830D92;
        color: white;
    }
</style>
<button class="btn btn-sm my-4 btn-default d-sm-none" onclick="openNav()"><i class="la la-bars mr-2"></i>Quick Menu</button>
<div class="profile-nav my-4 px-3">
    <ul class="nav card shadow-sm rounded-lg border-0 h-100 d-block justify-content-center" style="background-color:#eb790f;">
        @if(Auth::check())
        
            @if(Auth::user()->bookingclient->client_type ==2)
                <li class="nav-item ">
                    <a class="nav-link active rounded-top" href="{{route('booking.dashboard')}}"><i class="la la-home mr-3"></i>  Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rounded-top" href="{{route('user.edit_profile')}}"><i class="la la-user-alt mr-3"></i> My Account</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rounded-top" href="{{route('flight.create-flight-available')}}"><i class="la la-plus mr-3"></i> Create Reservation</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rounded-top" href="{{route('flight.flight-available')}}"><i class="la la-plus mr-3"></i> Available Flights</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rounded-top" href="{{route('flight.flight-booked')}}"><i class="la la-plus mr-3"></i> Booked Flights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout"><i class="la la-power-off mr-3"> </i> Logout</a>
                </li>
            @else
                <li class="nav-item ">
                    <a class="nav-link active rounded-top" href="{{route('booking.dashboard')}}"><i class="la la-home mr-3"></i> Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rounded-top" href="{{route('user.edit_profile')}}"><i class="la la-user-alt mr-3"></i> My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('reservations')}}"><i class="la la-user mr-3"> </i> Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('guests')}}"><i class="la la-user mr-3"> </i> Guests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('room_type')}}"><i class="la la-dot-circle-o mr-3"> </i> Room Types</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('room')}}"><i class="la la-dot-circle-o mr-3"> </i> Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('floor')}}"><i class="la la-dot-circle-o mr-3"> </i> Floors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('amenities')}}"><i class="la la-dot-circle-o mr-3"> </i> Amenities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('paid_service')}}"><i class="la la-dot-circle-o mr-3"> </i> Paid Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('coupon')}}"><i class="la la-dot-circle-o mr-3"> </i> Coupon Master</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tax')}}"><i class="la la-dot-circle-o mr-3"> </i> Tax</a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link" href="{{route('booking.payment-history')}}"><i class="la la-history mr-3"> </i> Payment history</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('wallet.index')}}"><i class="la la-wallet mr-3"> </i> My wallet</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/logout"><i class="la la-power-off mr-3"> </i> Logout</a>
                </li>
            @endif
        @else
        <li class="nav-item ">
            <a class="nav-link rounded-top" href="/login/artisan"><i class="la la-user-alt mr-3"></i> Login now</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('vendor.register')}}"><i class="la la-plus-circle mr-3"> </i> Create account</a>
        </li>
        @endif
        
    </ul>
</div>