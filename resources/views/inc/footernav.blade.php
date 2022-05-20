
<footer class="icon-bar d-md-none">
  <a href="/" class="active"><i class="la la-home"></i><br>Home</a> 
  <a href="/cart"><i class="la  la-shopping-basket"></i><br>Cart</a>
  @if(Auth::check())
    @if(Auth::user()->user_type == 'artisan')
        <a href="{{route('create-job')}}"><i class="la la-plus-circle"></i><br>Create Job</a>
    @else
        <a href="/user/orders"><i class="la la-box-open"></i><br>My Orders</a>
    @endif
  @else
  <a href="/login"><i class="la la-sign-in-alt"></i><br>Login</a>
  @endif
  
  <a href="/dashboard"><i class="la la-user-alt"></i><br>My Ebeano</a>
</footer>