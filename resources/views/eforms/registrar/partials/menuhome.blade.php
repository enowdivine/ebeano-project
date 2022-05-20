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
    <ul class="nav card shadow-sm rounded-lg border-0 h-100 d-block justify-content-center" style="background-image: -webkit-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);">
        @if(Auth::check())
        <li class="nav-item ">
            <a class="nav-link active rounded-top" href="{{route('user.edit_profile')}}"><i class="la la-user-alt mr-3"></i> My Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('registrar.create.institute')}}"><i class="la la-plus-circle mr-3"> </i> Create Institute</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('registrar.show.institute')}}"><i class="la la-bank mr-3"> </i> My Institute</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('registrar.create.eforms')}}"><i class="la la-plus-circle mr-3"> </i> Create Form</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('registrar.show.eforms')}}"><i class="la la-edit mr-3"> </i> Manage Forms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('all.apply.eforms')}}"><i class="la la-comment-alt mr-3"> </i> Manage Applications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('artisan.payment-history')}}"><i class="la la-history mr-3"> </i> Payment history</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('wallet.index')}}"><i class="la la-wallet mr-3"> </i> My wallet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout"><i class="la la-power-off mr-3"> </i> Logout</a>
        </li>
        @else
        <li class="nav-item ">
            <a class="nav-link rounded-top" href="/login/eforms"><i class="la la-user-alt mr-3"></i> Login now</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('vendor.register')}}"><i class="la la-plus-circle mr-3"> </i> Create account</a>
        </li>
        @endif
        
    </ul>
</div>