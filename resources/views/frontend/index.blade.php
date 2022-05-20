@extends('frontend.layouts.app')
@section('content')

    <!-- Banner Categories Slider -->
    
    <section id="banner-categories-wrapper" class="position-relative">
        <div class="banner-search">
            @foreach (\App\Slider::where('published',1)->get() as $slider)  
                <div class="banner-item position-relative">
                    @if (file_exists($slider->photo))
                        <img src="{{asset($slider->photo)}}" class="img-fluid w-100">
                    @else
                        <img src="{{asset('frontend/assets/images/banner/1.jpg')}}" class="img-fluid w-100">
                    @endif
                    {{-- <div class="description text-center text-capitalize">
                        <h3>Search for products &amp; find verified sellers near you</h3>
                    </div> --}}
                </div>
            @endforeach
            
        </div>
    </section>
    <!-- Banner Categories Slider Ends-->


    <!-- Navigation Starts -->
    <section id="navigation-wrapper" class="navigation-wrap">
        <nav class="navbar header-sticky px-3">
            <div class="navbar-menus d-xl-block d-lg-block d-none w-100" id="navbarmain">
                <ul class="navbar-nav py-4 py-md-0 d-flex flex-row flex-wrap justify-content-center role=" menu">
                    @foreach (\App\Category::all()->take(6) as $key => $category)

                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center"
                            href="{{ route('products.category', $category->slug) }}">
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
                                <!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->
                            </span>
                        </a>
                        <div class="mega-menu-wrapper">
                            <div class="row p-4">
                                @foreach ($category->subcategories as $sub)
                                    
                                
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link head font-weight-bold"
                                                href="{{ route('products.subcategory', $sub->slug) }}">{{$sub->name}}</a>
                                        </li>
                                        @foreach ($sub->products as $product)
                                            
                                        <li class="nav-item p-0">
                                            <a class="nav-link" href="{{route('product',$product->slug)}}">{{$product->name}}
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-items-center"
                            href="{{ route('categories.all') }}">
                            <div class="image">
                                <img src="frontend/assets/images/a.jpg" class="img-fluid">
                            </div>
                            <span class="ml-1"> View all Categories
                                <!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->
                            </span>
                        </a> 
                    </li>

                </ul>
            </div>
        </nav>
    </section>
    <!-- Navigation Ends -->
    <!-- Product Listing -->
    <section class="product-listing position-relative pt-5 bg-light">
        <div class="container">
            <div class="product-lists">
                <div class="row">
                    <div class="col-12">
                        <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                            <div class="head">
                                <h4 class="font-weight-bold">Latest Products</h4>
                                <!-- <p class="m-0">THERE'S SOMETHING FOR EVERYONE</p> -->
                            </div>
                            {{-- <div class="navigator"> <a href="product-list.html">See all</a> </div> --}}
                        </div>
                    </div>
                </div>
                <div class="slick-slider-listing">
                    @foreach (filter_products(\App\Product::where('published', 1)->orderBy('created_at', 'desc'))->limit(20)->get() as $key => $product)
                        
                    
                    <div class="slick-item position-relative">
                        <div class="product-grid-item2 d-flex align-items-center mx-2">
                            <div class="product-grid-image2">
                                <a href="{{route('product',$product->slug)}}">
                                    @if (!empty($product->featured_img))
                                        @if (file_exists($product->featured_img))
                                            <img src="{{asset($product->featured_img)}}" alt="img" class="img-fluid pic-1">
                                        @else
                                            <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="img" class="img-fluid pic-1">
                                        @endif
                                    @else 
                                        <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="img" class="img-fluid pic-1">
                                    @endif 
                                </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="{{ route('products.subcategory', $product->subcategory->slug) }}" class=" font-weight-bold" title="{{$product->subcategory->name}}">{{$product->subcategory->name}}</a></li>
                                    <li>
                                        <a href="{{route('product',$product->slug)}}" title="{{$product->name}}">{{$product->name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="slick-item position-relative py-4 mx-2">
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                        class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                        alt="img" class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                            Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="slick-item position-relative py-4 mx-2">
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                        class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                        alt="img" class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                            Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="slick-item position-relative py-4 mx-2">
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                        class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                        alt="img" class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                            Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="slick-item position-relative py-4 mx-2">
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                        class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-grid-item2 d-flex align-items-center">
                            <div class="product-grid-image2">
                                <a href="product-list.html">
                                    <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                        alt="img" class="img-fluid pic-1"> </a>
                            </div>
                            <div class="product-content">
                                <ul>
                                    <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                            Essential ,
                                            Safety &
                                            Protective Clothing
                                            and Apparel</a></li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">3 Ply Face Mask</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>  
    <div id="section_best_selling">

    </div>  

    <!-- Product Listing Ends -->

    <!-- Full Ads Banner -->
    <section id="full-ads-banner-wrapper" class="position-relative py-5 bg-light">
        <div class="container">
            {{-- <div class="row mb-3">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                        <div class="head">
                            <h4 class="font-weight-bold">Medical Essential , Safety & Protective Clothing and
                                Apparel</h4>
                            <!-- <p class="m-0">THERE'S SOMETHING FOR EVERYONE</p> -->
                        </div>
                        <div class="navigator"> <a href="product-list.html">See all</a> </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                @foreach (\App\Banner::where('position', 1)->where('published', 1)->take(2)->get() as $key => $banner)
                <div class="col-lg-6 col-12 mb-2">
                    <div class="image">
                        <a href="{{$banner->url}}">
                            <img src="{{ asset($banner->photo) }}" class="img-fluid banner-img" alt="{{ env('APP_NAME') }} promo">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
    </section>
    <!-- Full Ads Banner Ends -->
   

    <div id="section_home_categories">

    </div>

    <!-- Brands -->
    {{-- <section id="categories-wrapper" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                        <div class="head">
                            <h4 class="font-weight-bold">
                                Recommended Categories</h4>
                            <!-- <p class="m-0">THERE'S SOMETHING FOR EVERYONE</p> -->
                        </div>
                        <div class="navigator"> <a href="product-list.html">See all</a> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Content in col -->
                <div class="col-lg-3 col-md-6 col-sm-10 col-12 mx-auto mt-4">
                    <div class="blog-content">
                        <div class="image">
                            <img src="frontend/assets/images/product-images/1.jpg" alt="blog-image"
                                class="img-fluid">
                        </div>
                        <div class="blog-content px-4 py-3">
                            <h5 class="title">
                                Hardware Essential </h5>
                            <div class="button-wrapper">
                                <a href="product-detail.html" class="anchor-btn2">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content in col ends -->
                <!-- Content in col -->
                <div class="col-lg-3 col-md-6 col-sm-10 col-12 mx-auto mt-4">
                    <div class="blog-content">
                        <div class="image">
                            <img src="frontend/assets/images/product-images/5.jpg" alt="blog-image"
                                class="img-fluid">
                        </div>
                        <div class="blog-content px-4 py-3">
                            <h5 class="title">
                                Saftey Essential </h5>
                            <div class="button-wrapper">
                                <a href="product-detail.html" class="anchor-btn2">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content in col ends -->
                <!-- Content in col -->
                <div class="col-lg-3 col-md-6 col-sm-10 col-12 mx-auto mt-4">
                    <div class="blog-content">
                        <div class="image">
                            <img src="frontend/assets/images/product-images/6.jpg" alt="blog-image"
                                class="img-fluid">
                        </div>
                        <div class="blog-content px-4 py-3">
                            <h5 class="title">
                                Household
                            </h5>
                            <div class="button-wrapper">
                                <a href="product-detail.html" class="anchor-btn2">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content in col ends -->
                <!-- Content in col -->
                <div class="col-lg-3 col-md-6 col-sm-10 col-12 mx-auto mt-4">
                    <div class="blog-content">
                        <div class="image">
                            <img src="frontend/assets/images/product-images/1.jpg" alt="blog-image"
                                class="img-fluid">
                        </div>
                        <div class="blog-content px-4 py-3">
                            <h5 class="title">
                                Cup Board
                            </h5>
                            <div class="button-wrapper">
                                <a href="product-detail.html" class="anchor-btn2">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content in col ends -->
            </div>
        </div>
    </section> --}}
    <!-- Brands Ends -->

    <div id="section_featured">

    </div>
@endsection
    


@section('script')
<script>
    $(document).ready(function() {
        
        $.post('{{ route('home.section.featured')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                // console.log(data);
                $('#section_featured').html(data);
                $('.slick-slider-listing2').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 1080,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 780,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: true
                            }
                        }
                    ]
                });
            });
        $.post('{{ route('home.section.best_selling')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                $('#section_best_selling').html(data);
                $('.slick-slider-bestselling').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    rows:2,
                    responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 1080,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 780,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        $.post('{{ route('home.section.home_categories')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                $('#section_home_categories').html(data);
                $('.slick-slider-listing-home').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    rows:2,
                    responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 1080,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 780,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        $.post('{{ route('home.section.best_sellers')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                $('#section_best_sellers').html(data);
                // slickInit();

                $(".slider_feature2").slick({
                    autoplay: true,
                    slidesToShow: 5,
                    slidesToScroll: 7,
                    arrows: true,
                    dots: false,
                    responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 4,
                            },
                        },
                        {
                            breakpoint: 1080,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 780,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                dots: true,
                            },
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                dots: true,
                            },
                        },
                    ],
                });
            });
    });
</script>
@endsection