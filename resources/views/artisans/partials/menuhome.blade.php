<style>
    .nav-item .nav-link {
        color:white;
    }
    .nav-link .la {
        color:white;
    }
</style>
<button class="btn btn-sm my-4 btn-default d-sm-none" onclick="openNav()"><i class="la la-bars mr-2"></i>Quick Menu</button>
<div class="profile-nav my-4 px-3">
    <ul class="nav card shadow-sm rounded-lg border-0 h-100 d-block justify-content-center" style="background-color:rgb(131, 13, 146);">
        @if(Auth::check())
        <li class="nav-item ">
            <a class="nav-link active rounded-top" href="{{route('user.edit_profile')}}"><i class="la la-user-alt mr-3"></i> My Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('artisan.all-artisans')}}"><i class="la la-user mr-3"> </i> View Artisans</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('create-job')}}"><i class="la la-plus-circle mr-3"> </i> Create Job</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('my-job')}}"><i class="la la-comment-alt mr-3"> </i> Manage Jobs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('recent-job')}}"><i class="la la-box-open mr-3"> </i> Recent Jobs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('artisan.withdrawLog')}}"><i class="la la-money-bill-alt mr-3"> </i> Withdraw Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('assign.list')}}"><i class="la la-heart-o mr-3"> </i> Awarded list</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('acquired.list')}}"><i class="la la-piggy-bank mr-3"> </i> Jobs Acquired list</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('artisan.payment-history')}}"><i class="la la-history mr-3"> </i> Payment history</a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{route('wallet.recharge')}}"><i class="la la-money-bill-alt mr-3"> </i> Deposit money</a>-->
        <!--</li>-->
        <li class="nav-item">
            <a class="nav-link" href="{{route('wallet.index')}}"><i class="la la-wallet mr-3"> </i> My wallet</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('kyc.upload')}}"><i class="la la-user-alt mr-3"> </i> My KYC</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout"><i class="la la-power-off mr-3"> </i> Logout</a>
        </li>
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