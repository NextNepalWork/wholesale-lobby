@extends('frontend.layouts.app')
@section('content')
    <!-- Banner Categories Slider -->
    <section id="banner-categories-wrapper" class="position-relative">
        <div class="banner-search">
            <div class="banner-item position-relative">
                <img src="frontend/assets/images/banner/1.jpg" class="img-fluid w-100">
                <div class="description text-center text-capitalize">
                    <h4>Search for products & find verified sellers near you</h4>
                    <div class="card">
                        <form class="form-inline search_top justify-content-between" action="{{ route('search') }}" method="GET">
                            <input class="form-control border-0 search_input" type="search" aria-label="Search" id="search" name="q" placeholder="Search {{(Session::get('key'))?'for '.implode(',',array_slice(explode(',',Session::get('key')), -3)):''}}" autocomplete="off"/>
                            <div class="search_icon_top text-center">
                            </div>
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
                        {{-- <input type="text" placeholder="Enter products name">
                        <div class="card-footer">
                            <ul class="search-list-wrapper w-100">
                                <li class="mb-2 p-1">
                                    <a href="product-detail.html">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="image"> <img
                                                        src="frontend/assets/images/product-images/1.jpg"
                                                        alt="search-list-image" class="img-fluid"></div>
                                            </div>
                                            <div class="col-9 m-auto">
                                                <p class="m-0 text-left">Ham Cheese Burger</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2 p-1">
                                    <a href="product-detail.html">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="image"> <img
                                                        src="frontend/assets/images/product-images/1.jpg"
                                                        alt="search-list-image" class="img-fluid"></div>
                                            </div>
                                            <div class="col-9 m-auto">
                                                <p class="m-0 text-left">Ham Cheese Burger</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2 p-1">
                                    <a href="product-detail.html">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="image"> <img
                                                        src="frontend/assets/images/product-images/1.jpg"
                                                        alt="search-list-image" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-9 m-auto">
                                                <p class="m-0 text-left">Ham Cheese Burger</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Categories Slider Ends-->

    <!-- Navigation Starts -->
    <section id="navigation-wrapper" class="navigation-wrap">
        <nav class="navbar header-sticky px-3">
            <div class="navbar-menus d-xl-block d-lg-block d-none w-100" id="navbarmain">
                <ul class="navbar-nav py-4 py-md-0 d-flex flex-row flex-wrap justify-content-center role=" menu">
                    @foreach (\App\Category::where('featured',1)->take(6)->get() as $key => $category)

                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center"
                            href="product-listing.html">
                            <div class="image">
                                @if (!empty($category->icon))
                                    @if (file_exists($category->icon))
                                        <img src="{{$category->icon}}" class="img-fluid">
                                    @else
                                        <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid">
                                    @endif
                                @else
                                    <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid">
                                @endif

                            </div>
                            <span class="ml-1"> {{$category->name}}
                            </span>
                        </a>
                        <div class="mega-menu-wrapper">
                            <div class="row p-4">
                                <!-- /.col-md-3  -->
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link head font-weight-bold"
                                                href="product-listing.html">Common Disease Medicines</a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-3  -->
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link head font-weight-bold"
                                                href="product-listing.html">Common Disease Medicines</a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-3  -->
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link head font-weight-bold"
                                                href="product-listing.html">Common Disease Medicines</a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.col-md-3  -->
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link head font-weight-bold"
                                                href="product-listing.html">Common Disease Medicines</a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical
                                                Injectables
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Cough Syrup
                                            </a>
                                        </li>
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="product-listing.html">Pharmaceutical Tablets
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center"
                            href="product-listing.html">
                            <div class="image">
                                <img src="frontend/assets/images/a.jpg" class="img-fluid">
                            </div>
                            <span class="ml-1"> View all Categories
                                <!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->
                            </span>
                        </a> </li>
                    <!-- Popup Search Modal Anchor -->
                    <!-- <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center p-3" data-toggle="modal"
                            data-target="#searchpopupmodal" href="product-listing.html">
                            <span class="ml-1">
                                <i class="fa fa-search"></i>
                            </span>
                        </a>
                    </li> -->
                    <!-- Popup Search Modal Anchor Ends -->
                </ul>
            </div>
        </nav>
    </section>
    <!-- Navigation Ends -->

    

@endsection
