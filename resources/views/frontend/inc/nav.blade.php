{{-- <!-- Top Header Navigation -->
<header id="top-header-navigation-wrapper">
    <div class="container">
        <div class="top-header d-flex justify-content-between py-1">
            <div class="image">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="frontend/assets/images/comingsoon.png" alt="navigation-logo" class="img-fluid">
                </a>
            </div>
            <ul class="d-lg-flex d-none justify-content-end align-items-center m-0">
                @auth
                <li>
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class=" mr-2">
                            <i class=" fa fa-sign-in" aria-hidden="true"></i></span>Dashboard</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('logout')}}">
                        <span class="mr-2">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i></span>Logout</a>
                </li>
                
                @else
                <li>
                    <a class="nav-link" href="{{route('user.login')}}">
                        <span class=" mr-2">
                            <i class=" fa fa-sign-in" aria-hidden="true"></i></span>Login</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('user.registration')}}">
                        <span class="mr-2">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i></span>Register</a>
                </li>
                @endauth
                <li>
                    <a class="nav-link" href="">Save more on Purchase</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('orders.track') }}">Track my Order</a>
                </li>
                <li>
                    <div class="cart-wishlist desk-nav d-xl-block d-lg-block d-none">
                        <ul class="d-flex align-items-center justify-content-between m-0">
                            <li>
                                <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                                    data-target="#nav-cart">
                                    <span class="mr-1"><i class="fa fa-shopping-bag"
                                            aria-hidden="true"></i></span>
                                    <sup class="cart-items text-white">2</sup>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                                    data-target="#nav-cart">
                                    <span class="mr-1"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                    <sup class="cart-items text-white">2</sup>
                                </a>
                            </li>
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
<!-- Top Header Navigation Ends --> --}}

        <!-- Top Header Navigation -->
        <header id="top-header-navigation-wrapper">
            <div class="container">
                <div class="top-header d-flex justify-content-between py-1">
                    <div class="image">
                        <a class="navbar-brand" href="index.html">
                            <img src="frontend/assets/images/comingsoon.png" alt="navigation-logo" class="img-fluid">
                        </a>
                    </div>
                    <ul class="d-lg-flex d-none justify-content-end align-items-center m-0">
                        <li>
                            <a class="nav-link" href="login-register.html">
                                <span class=" mr-2">
                                    <i class=" fa fa-sign-in" aria-hidden="true"></i></span>Login</a>
                        </li>
                        <li>
                            <a class="nav-link" href="register.html">
                                <span class="mr-2">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i></span>Register</a>
                        </li>
                        <!-- <li>
                            <a class="nav-link" href="">Save more on Purchase</a>
                        </li>
                        <li>
                            <a class="nav-link" href="">Track my Order</a>
                        </li> -->
                        <li>
                            <div class="cart-wishlist desk-nav d-xl-block d-lg-block d-none">
                                <ul class="d-flex align-items-center justify-content-between m-0">
                                    <li>
                                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                                            data-target="#nav-cart">
                                            <span class="mr-1"><i class="fa fa-shopping-bag"
                                                    aria-hidden="true"></i></span>
                                            <sup class="cart-items text-white">2</sup>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                                            data-target="#nav-cart">
                                            <span class="mr-1"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                            <sup class="cart-items text-white">2</sup>
                                        </a>
                                    </li>
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