<button class="btn btn-sm my-4 btn-default d-sm-none" onclick="openNav()"><i class="la la-bars mr-2"></i>Dashboard</button>
<div class="profile-nav my-4 px-3">
    
    <ul class="nav card shadow-sm rounded-lg border-0 h-100 d-block justify-content-center">
        <li class="nav-item ">
            <a class="nav-link active rounded-top" href="{{route('seller.index')}}"><i class="la la-user-alt mr-3"></i>My Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('orders')}}"><i class="la la-box-open mr-3"> </i> Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=""><i class="la la-comment-alt mr-3"> </i>My Reviews</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('wishlists.index')}}"><i class="la la-heart-o mr-3"> </i> Wishlist</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#"><i class="la la-history mr-3"> </i> Recently viewed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('seller.store')}}"><i class="la la-box-open mr-3"> </i>Create store</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="la la-support mr-3"> </i>Support Ticket</a>
        <li class="nav-item">
            <a class="nav-link" href="{{route('seller.product')}}"><i class="la la-box-open mr-3"> </i>Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('seller.product_review')}}"><i class="la la-comment-alt mr-3"> </i>Customer Reviews</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('seller.earning')}}"><i class="la  la-money-bill-alt mr-3"> </i>Earnings/Withrawals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('seller.sales')}}"><i class="la la-money-bill-alt mr-3"> </i>Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('wallet.index')}}"><i class="la la-wallet mr-3"> </i>My wallet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('user.change_pass_page')}}"><i class="la la-key mr-3"> </i>Change Password</a>
        </li>
    </ul>
</div>