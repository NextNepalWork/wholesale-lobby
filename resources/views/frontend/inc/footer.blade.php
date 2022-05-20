<!-- Footer -->
<section id="footer-wrapper" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mb-2">
                <div class="image">
                    <a href="{{route('home')}}" class="justify-content-center"> 
                        @php
                        $generalsetting = \App\GeneralSetting::first();
                        
                        @endphp
                        @if($generalsetting->logo != null)
                            <img src="{{ asset($generalsetting->logo) }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
                        @else
                            <img src="{{ asset('frontend/assets/images/comingsoon.png') }}"  class="img-fluid" alt="{{ env('APP_NAME') }}">
                        @endif
                    </a>
                </div>
                <div class="content mt-3 text-center">
                    <p class="font-weight-normal m-0">
                        {{$generalsetting->description}}
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mb-2">
                <ul class="footer-nav-list">
                    <div class="heading">
                        <div class="head">
                            <a href="">
                                <h2 class="mb-3">Find Us</h2>
                            </a>
                        </div>
                    </div>
                    <li>
                        <a href=" mailto:{{$generalsetting->email}}"><span class="mr-2"><i
                                    class="fa fa-envelope-square"
                                    aria-hidden="true"></i></span>{{$generalsetting->email}}</a>
                        </h5>
                    </li>
                    <li>
                        <a href="tel:{{$generalsetting->phone}}"><span class="mr-2"><i class="fa fa-phone"
                                    aria-hidden="true"></i></span>{{$generalsetting->phone}}</a></h5>
                    </li>
                    <li>
                        <a href=""><span class="mr-2"><i class="fa fa-map"
                                    aria-hidden="true"></i></span>{{$generalsetting->address}}</a></h5>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mb-2">
                <ul class="footer-nav-list">
                    <div class="heading">
                        <div class="head">
                            <a href="">
                                <h2 class="mb-3">Quick Links</h2>
                            </a>
                        </div>
                    </div>
                    <li>
                        <a href="{{route('home')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Home</a>
                        </h5>
                    </li>
                    {{-- <li>
                        <a href="about-us.html"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>About Us</a></h5>
                    </li> --}}

                    <li>
                        <a href="{{route('wishlists.index')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Wishlists</a></h5>
                    </li>
                    <li>
                        <a href="{{route('contact')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Contact Us</a></h5>
                    </li>

                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mb-2">
                <ul class="footer-nav-list">
                    <div class="heading">
                        <div class="head">
                            <a href="">
                                <h2 class="mb-3">Quick Links</h2>
                            </a>
                        </div>
                    </div>
                    @auth
                    <li>
                        <a href="{{route('dashboard')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Dashboard</a>
                        </h5>
                    </li>
                    <li>
                        <a href="{{route('profile')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Manage Profile</a></h5>
                    </li>
                    <li>
                        <a href="{{route('logout')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Logout</a>
                        </h5>
                    </li>
                    @else
                    <li>
                        <a href="{{route('user.login')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Login</a>
                        </h5>
                    </li>
                    <li>
                        <a href="{{route('user.registration')}}"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Register</a>
                        </h5>
                    </li>
                    @endauth
                    {{-- <li>
                        <a href="cart.html"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Cart</a></h5>
                    </li>
                    <li>
                        <a href="order.html"><span class="mr-2"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></span>Order</a></h5>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Footer Ends -->
<!-- Copyright -->
<section id="copyright" class="py-2">
    <div class="container">
        <div class="row justify-content-center mx-2">
            <p class="m-0 text-center">Copyright © 2022 Wholesale Lobby. All rights reserved.</p>
        </div>
    </div>
</section>
<!-- Copyright Ends -->