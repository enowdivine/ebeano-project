@php
if (! Auth::guest()){
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Favicon -->
    {{--
    <link type="image/x-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />
    --}}
    <title>@yield('meta_title', config('app.name', 'Ebeano'))</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">

    {{-- Main css --}}
    @yield('link')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body>

    <div class="header">
        {{-- @include('inc/nav') --}}
    </div>

    <div class="container-fluid">

        @yield('content')

    </div>

    {{-- <div class="footer bg-dark text-white">
        <div class="footer-top py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-logo">
                            <a class="navbar-brand w-100" href="">
                                <img src="{{ asset('assets/images/ebeano-logo.png') }}" alt="Ebeano Market">

                            </a>
                        </div>
                        <div class="footer-about">
                            <p>Ebeano Market Place is an all in market place for various all in market place for various
                                all in market for various all in market for various all in market for various all in
                                market place for various good and services.</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="subscribe">
                            <div class="subscribe-info">
                                <div class="title text-uppercase font-weight-bold mb-2">
                                    Subscribe
                                </div>
                                Subscribe to our newsletter to get updates on our latest offers!
                            </div>
                            <form class="mt-3" action="" method="post">
                                <input class="form-control form-control-sm" type="text" name="email"
                                    placeholder="name@example.com">
                                <input class="btn btn-sm btn-default" type="submit" value="Subscribe">
                            </form>

                        </div>

                    </div>
                    <div class="col-lg-3 pr-lg-5 ">
                        <div class="title text-uppercase font-weight-bold mb-2">
                            CONNECT WITH US
                        </div>
                        <div class="social-link">
                            <a href="#"><i class="la la-facebook"></i></a>
                            <a href="#"><i class="la la-twitter"></i></a>
                            <a href="#"><i class="la la-instagram"></i></a>
                            <a href="#"><i class="la la-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
    <!-- Core -->

    @yield('script');
</body>

</html>
