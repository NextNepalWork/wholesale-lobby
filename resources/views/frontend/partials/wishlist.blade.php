<a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" href="{{ route('wishlists.index') }}">
    <span class="mr-1"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
    @if(Auth::check())
        <sup class="cart-items text-white">{{ count(Auth::user()->wishlists)}}</sup>
    @else
        <sup class="cart-items text-white">0</sup>
    @endif
</a>