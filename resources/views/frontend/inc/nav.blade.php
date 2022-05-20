
@php
$generalsetting = \App\GeneralSetting::first();
@endphp
<div class="track-header top-header-bg d-md-block d-none py-1">
    <div class="container px-0">
        <div class="top-header d-flex justify-content-end align-items-center">
            <div class="top-social-icon">
                <ul class="mb-0 d-flex">
                    <li>
                        <a href="" class="text-white">Check Our App</a>
                    </li>
                    <li>
                        <a href="{{route('shops.create')}}" class="text-white">Sell Here</a>
                    </li>
                    <li class="d-flex align-items-center top_head_right">
                        <div class="dropdown user_login_mobile">
                            <button
                                class="text-light btn_account pb-0 btn bg-transparent dropdown-toggle pt-0 font-weight-normal"
                                type="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                Track Your Order
                                <span class="caret"></span>
                            </button>
                            <ul class="my_account dropdown-menu pl-3" x-placement="bottom-start">
                                <div class="input_track_blo d-flex flex-column pb-2">
                                    <label><small class="font-weight-bold">Track Your Order</small></label>
                                    <form class="" action="{{ route('orders.track') }}" method="GET"
                                        enctype="multipart/form-data">
                                        <div class="track_input_btn d-flex">
                                            <input name="order_code" type="text" class="form-control"
                                                placeholder="Enter order id">
                                            <button type="submit" class="btn_custom_go">Go</button>
                                        </div>
                                    </form>
                                </div>
                            </ul>
                        </div>

                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                My Account
                            </button>
                            <div class="dropdown-menu p-0">
                                @auth
                                <a class="dropdown-item p-2" href="{{route('dashboard')}}">
                                    <span class=" mr-2">
                                        <i class="fa fa-home" aria-hidden="true"></i></span>Dashboard</a>
                                <a class="dropdown-item p-2" href="{{route('logout')}}">
                                    <span class="mr-2">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i></span>Logout</a>
                                @else
                                <a class="dropdown-item p-2" href="{{route('user.login')}}">
                                    <span class=" mr-2">
                                        <i class=" fa fa-sign-in" aria-hidden="true"></i></span>Login</a>
                                <a class="dropdown-item p-2" href="{{route('user.registration')}}">
                                    <span class="mr-2">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i></span>Register</a>
                                @endauth
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Top Header Navigation -->
<header id="top-header-navigation-wrapper" class="position-relative">
    <div class="container">
        <div class="top-header d-flex justify-content-between align-items-center py-1">
            <div class="image">
                <a class="navbar-brand" href="{{route('home')}}">
                    
                    @if($generalsetting->logo != null)
                        <img src="{{ asset($generalsetting->logo) }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
                    @else
                        <img src="{{ asset('frontend/assets/images/comingsoon.png') }}"  class="img-fluid" alt="{{ env('APP_NAME') }}">
                    @endif
    
                    </a>
            </div>
            <div class="search d-lg-block d-none">
                <div class="description text-center text-capitalize">
                    <div class="card">
                        <form class="form-inline search_top justify-content-between" action="{{ route('search') }}" method="GET">
                        <input class="form-control border-0 search_input" type="search" aria-label="Search" id="search" name="q" placeholder="Search {{(Session::get('key'))?'for '.implode(',',array_slice(explode(',',Session::get('key')), -3)):''}}" autocomplete="off"/>
                        <div class="typed-search-box d-none">
                            <div class="search-preloader">
                                <div class="loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none">
       
                            </div>
                            <div id="search-content">
       
                            </div>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <ul class="d-lg-flex d-none justify-content-end align-items-center m-0">
                <li>
                    <div class="cart-wishlist desk-nav d-xl-block d-lg-block d-none">
                        <ul class="d-flex align-items-center justify-content-between m-0">
                            
                            <div class="d-none d-lg-inline-block" data-hover="dropdown">
                                <div class="nav-cart-box dropdown" id="cart_items">
                                    <li>
                                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                                            data-target="#nav-cart">
                                            <span class="mr-1"><i class="fa fa-shopping-bag"
                                                    aria-hidden="true"></i></span>
                                            @if(Session::has('cart'))
                                                <sup class="cart-items text-white" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</sup>
                                            @else
                                                <sup class="cart-items text-white" id="cart_items_sidenav">0</sup>
                                            @endif
                                        </a>
                                    </li>
                                </div>
                            </div>
                            <div class="d-none d-lg-inline-block">
                                <div class="nav-wishlist-box" id="wishlist">
                                    <li>
                                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" href="{{ route('wishlists.index') }}">
                                            <span class="mr-1"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                            @if(Auth::check())
                                                <sup class="cart-items text-white">{{ count(Auth::user()->wishlists)}}</sup>
                                            @else
                                                <sup class="cart-items text-white">0</sup>
                                            @endif
                                        </a>
                                    </li>
                                </div>
                            </div>

                        </ul>
                    </div>
                </li>
            </ul>
            <div class="d-lg-none d-flex justify-content-end align-items-center">
                <!-- Mobile Popup Search Modal Anchor -->
                <a class="btn d-xl-none d-lg-none d-md-block search-button" data-toggle="modal"
                    data-target="#searchpopupmodal">
                    <i class="fa fa-search text-white"></i>
                </a>
                <!-- Mobile Popup Search Modal Anchor Ends -->
                <!-- Button trigger modal -->
                <div class="mobile-menu d-lg-none d-md-block mr-4 position-absolute" data-toggle="modal"
                    data-target="#rightsidebarfilter">
                    <span class="mr-2">
                        <i class="fa fa-bars fa-2x" aria-hidden="true">
                        </i>
                    </span>
                </div>
                <!-- Button trigger modal -->
            </div>
        </div>
    </div>
</header>
<!-- Top Header Navigation Ends -->

