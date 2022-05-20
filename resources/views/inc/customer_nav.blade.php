       <button class="btn btn-sm btn-default d-sm-none my-4" onclick="openNav()"><i class="la la-bars mr-2"></i>Dashboard</button> 
        <div class="profile-nav my-4 px-3">
            
            <ul class="nav card shadow-sm rounded-lg border-0 h-100 d-block justify-content-center">
                <li class="nav-item">
                         <a href="{{route('vendor.quick_register')}}" class="nav-link sell-on-ebeano"
                            ><span class="fa-stack fa-sm"
                              ><i class="fa fa-circle fa-stack-2x"></i
                              ><i
                                class="fa fa-star fa-stack-1x fa-inverse"
                                ></i></span
                            > Sell on Ebeano</a
                          >
                </li>
                <li class="nav-item ">
                    <a class="nav-link active rounded-top" href="{{route('dashboard')}}"><i class="la la-user-alt mr-3"></i> My Account</a>
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
                    <a class="nav-link" href="#"><i class="la la-support mr-3"> </i>Support Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('wallet.index')}}"><i class="la la-wallet mr-3"> </i> My wallet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.change_pass_page')}}"><i class="la la-key mr-3"> </i>Change Password</a>
                </li>
            </ul>
        </div>