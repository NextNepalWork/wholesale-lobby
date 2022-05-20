{{-- <a href="{{ route('wishlists.index') }}" class="nav-box-link">
    <img data-toggle="tooltip" data-placement="top" title="Wishlist" src="{{asset('frontend/images/hort.svg')}}" alt="cart-logo" class="img-fluid img_sag">
    @if(Auth::check())
        <sup class="nav-box-number">{{ count(Auth::user()->wishlists)}}</sup>
    @else
        <sup class="nav-box-number">0</sup>
    @endif
</a> --}}

<a href="{{ route('wishlists.index') }}" class="position-relative">
    <img data-toggle="tooltip" data-placement="top" title=""
       data-original-title="Wishlist" src="{{asset('./frontend/assets/images/logo/wishlist.svg')}}"
       class="img-fluid" alt="" />
       @if(Auth::check())
       <sup class="sub_block">{{ count(Auth::user()->wishlists)}}</sup>
    @else
       <sup class="sub_block">0</sup>
       @endif
</a>
