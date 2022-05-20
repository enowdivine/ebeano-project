<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ebeano Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
  rel="stylesheet" media="none" onload="if(media!='all')media='all'">

{{-- icons --}}
<link rel="stylesheet" href="{{ asset('assets/icons/la/css/line-awesome.min.css') }}" type="text/css" media="all">
  <link rel="stylesheet" href="{{ asset('assets/css/login.css')}}">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            @if ($type=='artisan')
                <img src="{{asset('assets/images/login-artisan.png')}}" alt="login" class="login-card-img">
            @elseif ($type=='booking')
                <img src="{{asset('assets/images/hotelbooking.jpg')}}" alt="login" class="login-card-img">
            @elseif ($type=='eforms')
                <img src="{{asset('assets/images/ebeano-eform-login.png')}}" alt="login" class="login-card-img">
            @elseif ($type=='estate')
                <img src="{{asset('assets/images/ebeano-estate-login.png')}}" alt="login" class="login-card-img">
            @else
                <img src="{{asset('assets/images/login.jpg')}}" alt="login" class="login-card-img">
            @endif
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="{{asset('assets/images/ebeano-logo.png')}}" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="{{url('post-login')}}"  method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="row">
                    <div class="col-sm-12">
                      @if(Session::has('success') && !empty(Session::get('success')))
                      <div class="alert alert-success">
                        {!!Session::get('success')!!}
                      </div>
                      @endif
                
                      @if(Session::has('error') && !empty(Session::get('error')))
                      <div class="alert alert-warning">
                        {!!Session::get('error')!!}
                      </div>
                      @endif
                
                      @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                  </div>
                  @if ($type)
                  <input name="user_type" type="hidden" value="{{ $type }}">
                  @endif
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                  {{-- <hr class="my-4">
                  <button class="btn btn-google btn-block text-uppercase" type="submit"><i class="la la-google mr-2"></i> Sign in with Google</button>
                  <button class="btn btn-facebook btn-block text-uppercase" type="submit"><i class="la la-facebook-f mr-2"></i> Sign in with Facebook</button>
                     --}}
                </form>
                <a href="{{route('user.password.request')}}" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account?
                @if ($type=='artisan')
                <a href="{{route('vendor.register')}}" class="text-reset">Register here</a>
                @else
                <a href="/register" class="text-reset">Register here</a>
                @endif
                </p>
             
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
