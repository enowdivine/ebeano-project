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
<meta name="robots" content="index, follow">

@php
$seosetting = App\SeoSetting::first();
$generalsetting = App\GeneralSetting::first();
@endphp

<meta name="description" content="@yield('meta_description', isset($seosetting->description)? $seosetting->description:'' )" />
<meta name="keywords" content="@yield('meta_keywords', isset($seosetting->keyword)?$seosetting->keyword:'')">
<meta name="author" content="{{ isset($seosetting->author) ?$seosetting->author:'' }}">
<meta name="sitemap_link" content="{{ isset($seosetting->sitemap_link) ?$seosetting->sitemap_link:'' }}">

@yield('meta')

@if(!isset($detailedProduct) && isset($generalsetting))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Ebeano Market') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ asset($generalsetting->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Ebeano Market') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($generalsetting->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Ebeano Market') }}" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ asset($generalsetting->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endif

    <!-- Favicon -->

    <link type="image/x-icon" href="{{ asset('assets/images/favicon1.png') }}" rel="icon" />


    <title>@yield('title', config('app.name', 'Ebeano Market'))</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" media="none" onload="if(media!='all')media='all'"> --}}

    {{-- icons --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/icons/la/css/line-awesome.min.css') }}" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('asset/font/Titania-Regular.ttf')}}" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bs/bootstrap.min.css')}}" type="text/css" media="all">

    {{-- Main css --}}
    @yield('link')
    
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/active-shop.min.css') }}" type="text/css" media="all"> --}}
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/market.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/pagination.css') }}" type="text/css" media="all">
    
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css" media="screen and (max-width:769px)">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function() {
            
        });
    </script>

</head>

<body>

    <div class="header">
        @include('inc/nav')
    </div>

    <div class="container-fluid container-lg mobile-container eb-forms">

        @yield('content')

    </div>

    <div class="footer d-none d-md-block mt-3">
        <div class="footer-top">
            <div class="container-fluid container-lg">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-logo">
                            <a class="navbar-brand w-100" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="132px" height="40px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
viewBox="0 0 1000 267"
 xmlns:xlink="http://www.w3.org/1999/xlink">
 <defs>
  <font id="FontID1" horiz-adv-x="777" font-variant="normal" class="str0" style="fill-rule:nonzero" font-weight="900">
	<font-face 
		font-family="Arial Black">
	</font-face>
   <missing-glyph><path d="M0 0z"/></missing-glyph>
   <glyph unicode="R" horiz-adv-x="777"><path d="M76.005 0l0 716.038 368.67 0c68.2967,0 120.68,-5.88479 156.651,-17.7373 36.1376,-11.6038 65.3129,-33.4853 87.5259,-65.1471 22.1301,-31.8276 33.1538,-70.6175 33.1538,-116.287 0,-39.7016 -8.53709,-74.0157 -25.5284,-102.86 -16.8255,-29.0095 -40.116,-52.3 -69.9544,-70.3688 -18.8976,-11.2723 -44.8404,-20.804 -77.6627,-28.3465 26.2743,-8.78574 45.5035,-17.4886 57.4389,-26.2743 8.03978,-5.88479 19.8923,-18.4832 35.3916,-37.7124 15.3336,-19.1463 25.6113,-33.9826 30.833,-44.5089l107.501 -206.797 -250.062 0 -118.11 218.317c-15.0021,28.3465 -28.3465,46.6639 -40.0332,55.201 -15.9967,10.9407 -34.1484,16.494 -54.2893,16.494l-19.5607 0 0 -290.012 -221.964 0zm221.964 425.031l93.4936 0c10.029,0 29.6726,3.31538 58.6821,9.78036 14.6705,2.81807 26.6888,10.3605 35.8889,22.5446 9.28305,12.184 14.0075,25.9428 14.0075,41.608 0,23.2076 -7.37671,41.0278 -22.0472,53.3775 -14.6705,12.5155 -42.1881,18.649 -82.6357,18.649l-97.3891 0 0 -145.959z"/></glyph>
   <glyph unicode="A" horiz-adv-x="777"><path d="M513.469 118.027l-250.642 0 -35.9718 -118.027 -225.86 0 269.54 716.038 242.105 0 268.38 -716.038 -231.662 0 -35.8889 118.027zm-46.8297 154.994l-78.16 257.273 -78.4915 -257.273 156.651 0z"/></glyph>
   <glyph unicode="O" horiz-adv-x="832"><path d="M45.0062 357.48c0,116.867 32.4907,207.874 97.6378,272.855 65.23,65.1471 155.823,97.6378 272.192,97.6378 119.188,0 211.024,-31.9934 275.508,-95.8143 64.484,-63.9867 96.6432,-153.668 96.6432,-268.794 0,-83.7132 -14.0075,-152.176 -42.1881,-205.719 -28.0978,-53.4604 -68.9598,-95.1513 -122.172,-124.99 -53.2947,-29.8384 -119.602,-44.6747 -199.088,-44.6747 -80.7294,0 -147.534,12.8471 -200.58,38.5412 -52.7973,25.777 -95.8143,66.4733 -128.637,122.172 -32.8222,55.4496 -49.3162,125.155 -49.3162,208.786zm220.97 -0.497306c0,-72.1094 13.5102,-124.161 40.3647,-155.657 27.0203,-31.4961 63.6552,-47.327 109.988,-47.327 47.4927,0 84.5421,15.4994 110.485,46.3324 26.1915,30.9988 39.2043,86.3655 39.2043,166.515 0,67.3021 -13.6759,116.453 -40.862,147.451 -27.3518,31.1645 -64.1525,46.6639 -110.816,46.6639 -44.6747,0 -80.6465,-15.8309 -107.667,-47.327 -27.1861,-31.4961 -40.6962,-83.7961 -40.6962,-156.651z"/></glyph>
   <glyph unicode="C" horiz-adv-x="777"><path d="M550.021 292.996l193.949 -58.5164c-12.93,-54.2893 -33.4853,-99.7928 -61.666,-136.179 -27.932,-36.4691 -62.6606,-63.9867 -104.269,-82.47 -41.5251,-18.4832 -94.4053,-27.8492 -158.558,-27.8492 -77.9942,0 -141.484,11.3552 -190.966,33.8168 -49.3162,22.7103 -91.8359,62.4948 -127.642,119.354 -35.8889,56.8587 -53.8748,129.88 -53.8748,218.483 0,118.359 31.4961,209.366 94.4882,273.021 63.1579,63.4894 152.341,95.317 267.717,95.317 90.0953,0 161.127,-18.1517 212.764,-54.6208 51.5541,-36.552 90.0124,-92.499 115.044,-168.172l-195.027 -43.1828c-6.79652,21.6328 -14.0075,37.4637 -21.4671,47.4927 -12.5155,16.8255 -27.6834,29.8384 -45.5035,38.8728 -17.9859,9.11728 -38.0439,13.6759 -60.1741,13.6759 -50.3108,0 -88.8521,-20.2238 -115.541,-60.3398 -20.1409,-29.8384 -30.3357,-76.8338 -30.3357,-140.738 0,-79.3203 12.0182,-133.444 36.2205,-162.951 24.1194,-29.3411 58.0191,-44.0116 101.616,-44.0116 42.3539,0 74.3473,11.8525 96.063,35.6403 21.6328,23.7049 37.298,58.1848 47.1612,103.357z"/></glyph>
   <glyph unicode="T" horiz-adv-x="722"><path d="M22.959 716.038l673.021 0 0 -177.041 -225.943 0 0 -538.997 -221.053 0 0 538.997 -226.026 0 0 177.041z"/></glyph>
   <glyph unicode="K" horiz-adv-x="832"><path d="M74.0157 716.038l220.97 0 0 -270.535 231.828 270.535 294.157 0 -261.334 -269.043 273.353 -446.995 -272.192 0 -150.932 293.991 -114.878 -119.685 0 -174.306 -220.97 0 0 716.038z"/></glyph>
   <glyph unicode="E" horiz-adv-x="722"><path d="M73.0211 716.038l591.96 0 0 -153.005 -369.996 0 0 -114.049 342.976 0 0 -145.959 -342.976 0 0 -140.986 381.019 0 0 -162.039 -602.984 0 0 716.038z"/></glyph>
   <glyph unicode="." horiz-adv-x="333"><path d="M61.0029 199.005l212.018 0 0 -199.005 -212.018 0 0 199.005z"/></glyph>
   <glyph unicode="M" horiz-adv-x="943"><path d="M71.0319 716.038l291.836 0 111.148 -435.723 111.479 435.723 290.51 0 0 -716.038 -181.019 0 0 545.794 -139.66 -545.794 -164.028 0 -139.329 545.794 0 -545.794 -180.937 0 0 716.038z"/></glyph>
  </font>
  <font id="FontID0" horiz-adv-x="685" font-variant="normal" style="fill-rule:nonzero" font-style="normal" font-weight="400">
	<font-face 
		font-family="Titania">
	</font-face>
   <missing-glyph><path d="M0 0z"/></missing-glyph>
   <glyph unicode="n" horiz-adv-x="562"><path d="M517 0c-16.6617,22.6713 -24.9993,49.9986 -24.9993,81.9956 0,7.33602 0,16.3369 0,27.0025 0,10.6657 0.338377,23.3345 1.0016,38.0066l0 64.9955 0 114.994c0,24.6745 -3.83043,47.6706 -11.5048,69.0019 -7.66086,21.3313 -18.5025,39.5089 -32.4978,54.5058 -13.9953,14.9969 -30.9954,26.8266 -51.0002,35.5026 -20.0049,8.66246 -42.3378,12.9937 -66.9987,12.9937 -55.9947,0 -97.6693,-16.6617 -124.997,-49.9986l0 45.0042 -190.006 0c15.3353,-44.0026 22.9961,-79.6676 22.9961,-107.008l0 -303.998c0,-36.0034 -8.32408,-63.6691 -24.9993,-82.9972l214.003 0c-15.9985,20.6681 -23.9977,46.9939 -23.9977,79.0044 0,12.6689 0,27.9906 0,45.9923 0,18.6649 0.338377,40.3346 1.0016,65.0091l0 111.989 0 69.0019c2.00319,18.6649 9.32568,34.1761 21.9945,46.5066 12.6689,12.3305 28.3425,18.5025 47.0074,18.5025 15.9985,0 29.1681,-6.172 39.4954,-18.5025 10.3273,-12.3305 15.4977,-26.5017 15.4977,-42.5002 0,-13.3321 0,-29.6689 0,-48.997 0,-19.3417 0.338377,-42.3378 1.0016,-69.0019 0.66322,-26.6777 1.0016,-49.6738 1.0016,-69.0019 0,-19.3417 0,-35.665 0,-48.997 0,-67.3371 -9.00084,-113.343 -27.0025,-138.004 11.3289,0 26.0009,0 44.0026,0 18.0017,0 38.6698,-0.338377 62.0043,-1.0016l106.995 0z"/></glyph>
   <glyph unicode="e" horiz-adv-x="545"><path d="M503 248.998c0.668278,3.99545 0.995308,8.00512 0.995308,12.0006 0,3.99545 0,7.66387 0,11.0053 0,10.664 -0.668278,21.6693 -1.99062,33.0016 -1.33656,11.3323 -3.34139,23.6599 -6.00028,36.997 -10.01,50.6612 -38.6748,90.9996 -86.0088,121.001 -43.3243,27.9966 -91.9949,42.002 -145.997,42.002 -77.3354,0 -139.329,-22.3376 -185.995,-66.9984 -47.334,-45.3434 -71.0081,-106 -71.0081,-182.013 0,-87.9994 26.6742,-154.998 80.0085,-200.995 49.9929,-43.9926 119.664,-66.0031 209,-66.0031 45.3292,0 87.3312,10.6782 125.992,32.0063 45.3434,25.3377 68.008,58.9933 68.008,100.995 0,22.0105 -6.34153,39.6701 -19.0104,53.0073 -12.6546,13.3229 -29.9872,19.9915 -51.9977,19.9915 -6.00028,0 -15.996,-2.65889 -30.0014,-7.9909 13.3371,-18.6691 20.0057,-38.0065 20.0057,-57.998 0,-28.6791 -9.32746,-51.6707 -27.9966,-69.0033 -18.6691,-17.3326 -42.9973,-26.006 -72.9987,-26.006 -44.6751,0 -75.3448,18.0009 -92.0091,54.0026 -12.0006,24.6694 -18.0009,62.3347 -18.0009,112.996l0 47.007 305.005 0.995308zm-178.999 44.0068l-124.996 0c-0.668278,4.66373 -1.00953,8.65918 -1.00953,12.0006 0,3.32717 0,6.00028 0,7.9909 0,8.00512 0.170624,15.4984 0.511873,22.5082 0.32703,6.99559 0.824684,13.8348 1.49296,20.4891 3.32717,33.3428 7.66387,57.0027 12.9959,71.0081 11.3323,25.3377 29.3331,37.9923 54.0026,37.9923 38.0065,0 57.0027,-29.6602 57.0027,-88.9947l0 -82.9945z"/></glyph>
   <glyph unicode="b" horiz-adv-x="554"><path d="M508.005 266.998c0,63.33 -14.6737,116.664 -44.0068,160.003 -33.9969,49.9929 -81.0038,75.0036 -140.992,75.0036 -39.3431,0 -81.3451,-18.0009 -126.006,-54.0026 0.668278,6.66856 1.16593,11.6593 1.50718,15.0007 0.32703,3.32717 0.497654,4.99076 0.497654,4.99076l0 193.004 -187.999 0c14.6595,-30.0014 21.9963,-52.666 21.9963,-67.9937l-3.00014 -524.001c0,-4.66373 -7.33684,-27.6696 -21.9963,-69.0033l289.99 0c69.9986,0 123.674,27.9966 160.998,84.004 32.6745,48.6563 49.0118,109.669 49.0118,182.994zm-181.999 14.0054c0,-44.0068 -2.00483,-92.0091 -6.00028,-144.007 -2.00483,-21.328 -12.6688,-41.6607 -32.0063,-60.9982 -19.3374,-19.3374 -39.3289,-28.9919 -60.0028,-28.9919l-33.0016 0 0 261.993c0,26.006 4.67795,49.9929 14.0054,72.0034 13.3371,27.3283 31.338,40.9925 54.0026,40.9925 42.002,0 63.003,-46.9927 63.003,-140.992z"/></glyph>
   <glyph unicode="a" horiz-adv-x="552"><path d="M506.998 1.0016c-15.3353,39.9962 -22.9961,70.6667 -22.9961,91.9981l0 210.999c0,78.0028 -16.3369,131.006 -48.997,158.997 -30.6705,25.3377 -85.3388,38.0066 -164.005,38.0066 -7.33602,0 -18.6649,-1.66482 -34.0002,-5.00799 -8.66246,-1.98966 -15.6601,-3.49205 -20.9929,-4.49365 -5.34636,-1.0016 -9.67759,-1.82724 -13.0072,-2.50399 -12.6689,-1.32644 -27.6657,-2.32804 -45.0042,-2.99126 -17.3249,-0.676755 -37.6682,-1.0016 -60.9891,-1.0016l-12.0056 0c-3.32963,0 -7.1736,0.825641 -11.5048,2.49046 -4.33123,1.67835 -8.50004,3.34317 -12.4929,5.00799 -4.00639,1.66482 -7.83682,3.32963 -11.5048,4.99445 -3.66801,1.66482 -5.83363,2.50399 -6.49685,2.50399 -1.33997,0 -2.00319,-2.66641 -2.00319,-7.99924 0,-36.0034 9.00084,-68.3387 27.0025,-97.006 20.6681,-34.6634 47.9955,-51.9883 81.9956,-51.9883 12.6689,0 28.0041,3.32963 46.0058,9.9889 23.3345,7.99924 35.0018,16.3369 35.0018,24.9993 0,4.66961 -1.66482,10.8416 -5.00799,18.5025 -3.32963,7.6744 -4.99445,13.8329 -4.99445,18.5025 0,22.6713 13.9953,34.0002 41.9994,34.0002 34.6634,0 52.0018,-21.9945 52.0018,-65.9971 0,-19.3417 -9.66406,-34.6634 -29.0057,-46.0058 0,0 -4.49365,-1.82724 -13.4945,-5.49525 -9.00084,-3.66801 -22.1705,-9.16326 -39.4954,-16.4993 -22.6713,-9.33922 -47.3458,-18.3401 -74.0099,-27.0025 -39.9962,-12.6689 -72.6699,-31.6721 -97.9941,-56.9963 -28.0041,-29.3306 -41.9994,-63.6691 -41.9994,-103.002 0,-43.3394 17.0001,-78.3411 51.0002,-105.005 30.657,-24.6609 68.3252,-36.9914 112.991,-36.9914 46.0058,0 89.67,18.0017 131.006,53.9915l13.9953 -38.9946 179.002 0zm-195 289.001c-0.66322,-13.3321 -1.0016,-24.9993 -1.0016,-35.0018 0,-10.0024 0,-18.6649 0,-26.0009l0 -119.001c0,-10.0024 -6.99764,-21.0065 -20.9929,-32.9986 -13.3321,-12.0056 -24.9993,-18.0017 -35.0018,-18.0017 -20.0049,0 -36.0034,8.66246 -47.9955,26.0009 -10.0024,14.672 -15.0104,32.9986 -15.0104,54.9931 0,28.0041 13.0072,59.013 39.0081,93.0132 26.6641,34.6634 53.6667,53.6667 80.994,56.9963z"/></glyph>
   <glyph unicode="o" horiz-adv-x="563"><path d="M510.002 250.995c0,69.3403 -25.3377,128.34 -75.9996,176.998 -49.3354,48.6722 -108.998,73.0083 -179.002,73.0083 -68.6635,0 -127,-24.6745 -174.995,-73.9964 -47.3458,-49.3354 -71.0051,-108.01 -71.0051,-176.01 0,-73.3332 22.6713,-135.324 68.0003,-185.999 46.669,-52.0018 106.67,-77.9892 180.003,-77.9892 74.6596,0 135.662,24.9993 182.995,74.998 46.669,50.6619 70.0035,113.668 70.0035,188.991zm-175.009 49.0106c0,-3.34317 0,-7.01118 0,-11.004 0,-3.32963 -0.324842,-7.6744 -0.988062,-13.0072l0 -22.9961c0,-3.99285 0.162421,-9.16326 0.500799,-15.4977 0.324842,-6.33443 0.487263,-13.1696 0.487263,-20.5057 0,-6.65927 0.175956,-13.1561 0.500799,-19.4905 0.338377,-6.33443 0.500799,-11.5048 0.500799,-15.4977 0,-103.34 -23.6593,-155.004 -70.9916,-155.004 -55.3315,0 -82.9972,56.9963 -82.9972,171.002 0,3.32963 0,7.32249 0,11.9921 0,4.66961 0.324842,10.3408 0.988062,17.0001l0 30.0073c0,135.324 24.0113,202.999 72.0067,202.999 53.3283,0 79.9924,-53.3418 79.9924,-159.998z"/></glyph>
  </font>
  <style type="text/css">
   <![CDATA[
    @font-face { font-family:"Arial Black";src:url("#FontID1") format(svg)}
    @font-face { font-family:"Titania";src:url("#FontID0") format(svg)}
    .str0 {stroke-width:63.1575}
    .str2 {stroke:white;stroke-width:3}
    .fil2 {fill:#F77F45}
    .fil3 {fill:white}
    .fnt2 {font-weight:900;font-size:47.5px;font-family:'Arial Black'}
    .fnt0 {font-weight:normal;font-size:276.89px;font-family:'Titania'}
    .fnt1 {font-weight:normal;font-size:290.874px;font-family:'Titania'}
   ]]>
  </style>
 </defs>
 <g id="Layer_x0020_1">
  <metadata id="CorelCorpID_0Corel-Layer"/>
  <g id="_482696368">
   <path class="fil3" d="M43 173c5,8 15,16 38,25 145,0 281,0 422,1 -25,9 -45,17 -61,26 -72,-5 -144,-11 -216,-17 -135,-6 -179,4 -224,14 8,-19 21,-35 41,-49z"/>
   <path class="fil3" d="M60 7c24,14 38,35 36,63 11,-3 23,-7 38,-9 0,-8 0,-12 0,-20 -24,-10 -49,-24 -74,-34z"/>
   <ellipse class="fil3" cx="121" cy="243" rx="33" ry="24"/>
   <ellipse class="fil3" cx="384" cy="249" rx="33" ry="24"/>
   <path class="fil2" d="M900 67c31,3 70,15 102,3 -12,13 -24,27 -36,40 -12,-29 -38,-37 -66,-43z"/>
   <g transform="matrix(0.934393 0 -0.167358 0.761815 -396.527 78.412)">
    <text x="500" y="133"  class="fil2 fnt0">e</text>
    <text x="662" y="133"  class="fil2 fnt0">b</text>
    <text x="827" y="133"  class="fil2 fnt0">e</text>
   </g>
   <g transform="matrix(0.945143 0 -0.156298 0.761801 37.7326 82.987)">
    <text x="500" y="133"  class="fil3 fnt1">ano</text>
   </g>
   <g transform="matrix(1.03864 0 0 0.761815 0.690618 127.122)">
    <text x="500" y="133"  class="fil3 str2 fnt2">M</text>
    <text x="548" y="133"  class="fil3 str2 fnt2">A</text>
    <text x="588" y="133"  class="fil3 str2 fnt2">R</text>
    <text x="628" y="133"  class="fil3 str2 fnt2">K</text>
    <text x="670" y="133"  class="fil3 str2 fnt2">E</text>
    <text x="707" y="133"  class="fil3 str2 fnt2">T</text>
    <text x="737" y="133"  class="fil3 str2 fnt2">.</text>
    <text x="756" y="133"  class="fil3 str2 fnt2">C</text>
    <text x="796" y="133"  class="fil3 str2 fnt2">O</text>
    <text x="838" y="133"  class="fil3 str2 fnt2">M</text>
   </g>
  </g>
 </g>
</svg>

                            </a>
                        </div>
                        <div class="footer-about">
                            <p>Our vision has been to take E-commerce to the next level in Nigeria and Africa at large, rendering core services and making life easier for the populace. We consider it a privilege to be able to render these services.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
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
                    <div class="col-md-3 pr-lg-5 ">
                        <div class="title text-uppercase font-weight-bold mb-2">
                            CONNECT WITH US
                        </div>
                        <div class="social-link">
                            <a href="https://www.facebook.com/Ebeano-Market-106250061337403"><i class="la la-facebook"></i></a>
                            <a href="https://twitter.com/ebeanomarket"><i class="la la-twitter"></i></a>
                            <a href="https://instagram.com/ebeanomarket"><i class="la la-instagram"></i></a>
                            <a href="https://youtube.com/ebeanomarket"><i class="la la-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-bottom mt-3 pb-2">
            <div class="container-fluid container-lg">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title text-uppercase font-weight-bold mb-3">
                            OUR SERVICES
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="#">Real estate</a></li>
                            <li><a href="/expressbills">Ebeano pay</a></li>
                            <li><a href="/expressbills">Airtime recharge</a></li>
                            <li><a href="/artisans">Ebeano Artisans</a></li>
                            <li><a href="/bookings">Hotel & Airline booking</a></li>
                            <li><a href="/eforms">Education</a></li>
                            <li><a href="/marketplace">Bulk Sales on Ebeano Marketplace</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="title text-uppercase font-weight-bold mb-3">
                           USEFUL LINKS
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="{{route('about')}}">About us</a></li>
                            <li><a href="{{route('terms')}}">Terms</a></li>
                            <li><a href="{{route('faq')}}">FAQ</a></li>
                            <li><a href="{{route('privacy') ?? '#'}}">Privacy policy</a></li>
                            <li><a href="#">Become an Ebeano Affiliate</a></li>
                            <li><a href="{{route('vendor.quick_register')}}">Sell on Ebeano</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="footer-copyright text-center justify-content-center mt-3 py-4">
                    <span class="la la-copyright text-white"></span> {{date('Y')}} <a href="/">Ebeano Market</a>
                </div>
            </div>
        </div>
    </div>
<div class="mt-5 d-block d-md-none" style="height:20px">
    
</div>   

    @include('inc/footernav')
    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- Core -->
    <script src="{{ asset('assets/js/bs/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.plugin.lazy.min.js') }}"></script>
    <script>
    $(function() {
        $('.lazy').Lazy();
    });
//         (function () {
// 	$('.hamburger-menu').on('click', function() {
		
//     var mobileNav = $('.mobile-side-menu');
//     mobileNav.toggleClass('hide show');
// 	})
// })();

</script>
<script>
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
    
    $(".nav li").click(function() {
                if($(this).hasClass("active")){
                    $(this).addClass("active");
                }else{
                    $(".nav li active").removeClass("active");
                    $(this).addClass("active");
                }
    });
</script>

@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach

@if(Session::has('success') && !empty(Session::get('success')))
    <script>
        showFrontendAlert('success', "{{Session::get('success')}}");
    </script>
@endif
            
@if(Session::has('error') && !empty(Session::get('error')))
    <script>
        showFrontendAlert('danger', '{{Session::get('error')}}');
    </script>
@endif

<script>

    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('{{ route('category.elements') }}', {_token: '{{ csrf_token()}}', id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });

    });

    $('#search').on('keyup', function(){
        search();
    });

    $('#search').on('focus', function(){
        search();
    });

    function search(){
        var search = $('#search').val();
        if(search.length > 0){
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('{{ route('search.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
                    $('.search-preloader').addClass('d-none');

                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }

    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data);
        });
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function addToWishList(id){
        @if (Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'user' || Auth::user()->user_type == 'seller'))
            $.post('{{ route('wishlists.store') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                if(data != 0){
                    $('#wishlist').html(data);
                    showFrontendAlert('success', 'Item has been added to wishlist');
                }
                else{
                    showFrontendAlert('warning', 'Something went wrong');
                }
            });
        @else
            showFrontendAlert('warning', 'Please login first');
        @endif
    }

    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }

    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });

    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '{{ route('products.variant_price') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div').removeClass('d-none');
                   $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                   $('#available-quantity').html(data.quantity);
                   $('.input-number').prop('max', data.quantity);
                   //console.log(data.quantity);
                   if(parseInt(data.quantity) < 1){
                       $('.buy-now').hide();
                       $('.add-to-cart').hide();
                   }
                   else{
                       $('.buy-now').show();
                       $('.add-to-cart').show();
                   }
               }
           });
        }
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });

        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }

        return false;
    }

    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   //$('#addToCart-modal-body').html(null);
                   //$('.c-preloader').hide();
                   //$('#modal-size').removeClass('modal-lg');
                   //$('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();

             $input.on('change', function(e) {
                 var fileName = '';

                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();

                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });

             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }

     

</script>
<script>
function openNav() {

  document.getElementById('myNav').style.display = "block";
   event.preventDefault();
    $(".hamburger-menu").toggleClass("open");
    if ($(".hamburger-menu").hasClass("open")) {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-0")
            .addClass("opacity-1");
        $(".side-menu").removeClass("closed").addClass("open");
        $("body").addClass("side-menu-open");
    } else {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-1")
            .addClass("opacity-0");
        $(".side-menu").removeClass("open").addClass("closed");
        $("body").removeClass("side-menu-open");
    }

}

function closeNav() {

  $(".side-menu-wrap,.side-menu-overlay")
        .removeClass("opacity-1")
        .addClass("opacity-0");
    $(".side-menu").removeClass("open").addClass("closed");
    if ($(".hamburger-menu").hasClass("open")) {
        $(".hamburger-menu").removeClass("open");
        $("body").removeClass("side-menu-open");
    }
}

$(window).on("load", function () {});

$(window)
    .scroll(function () {
        var scrollDistance = $(window).scrollTop();
        $(".sub-category-menu.active").each(function (i) {
            if ($(this).position().top + 120 <= scrollDistance) {
                $(".all-category-menu li.active").removeClass("active");
                $(".all-category-menu li").eq(i).addClass("active");
            }
        });

        var b = $(window).scrollTop();

        if (b > 120) {
            $(".logo-bar-area").addClass("sm-fixed-top");
        } else {
            $(".logo-bar-area").removeClass("sm-fixed-top");
        }
    })
    .scroll();

$(function () {
    $("#category-menu-icon, #category-sidebar")
        .on("mouseover", function (event) {
            $("#hover-category-menu").show();
            $("#category-menu-icon").addClass("active");
        })
        .on("mouseout", function (event) {
            $("#hover-category-menu").hide();
            $("#category-menu-icon").removeClass("active");
        });

    $(".nav-search-box a").on("click", function (e) {
        e.preventDefault();
        $(".search-box").addClass("show");
        $('.search-box input[type="text"]').focus();
    });
    $(".search-box-back button").on("click", function () {
        $(".search-box").removeClass("show");
    });
    $("#side-filter,.filter-close").on("click", function (e) {
        e.preventDefault();
        if ($(".side-filter").hasClass("open")) {
            $(".side-filter").removeClass("open");
        } else {
            $(".side-filter").addClass("open");
        }
    });
});
</script>


    @yield('script')
</body>

</html>
