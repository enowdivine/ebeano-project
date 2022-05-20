<a href="{{ route('wishlists.index') }}" class="nav-box-link">
    <i class="la la-heart-o d-inline-block nav-box-icon"></i>
    <span class="nav-box-text d-none d-lg-inline-block">{{__('Wishlist')}}</span>
    @if(Auth::check())
        @php
            $wishlists = \App\Wishlist::where('user_id',Auth::user()->id)->get();
        @endphp
        <span class="nav-box-number">{{ $wishlists !=null ? count($wishlists): '0'}}</span>
    @else
        <span class="nav-box-number">0</span>
    @endif
</a>
