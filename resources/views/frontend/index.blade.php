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
                <ul class="navbar-nav py-4 py-md-0 d-flex flex-row flex-wrap justify-content-center" role=" menu">
                    @foreach (\App\Category::where('top',1)->get()->take(6) as $key => $category)

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
                                        @foreach ($sub->products()->where('published',1)->get() as $product)
                                            
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
    @php
$flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
if($flash_deal!=null){
    $time = date('Y-m-d H:i:s',$flash_deal->end_date);
}
@endphp

@if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
<section class="product-listing position-relative pt-5 bg-white">
    <div class="container">
        <div class="product-lists">
            <div class="row">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                        <div class="head">
                            <h4 class="font-weight-bold">Flash Sale</h4>
                        </div>
                        <div class="flash-deal-box float-left d-flex">
                            <span class="d-flex align-items-center">Offer Ends in : </span> 
                           <div class="countdown countdown--style-1 countdown--style-1-v1 " data-countdown-date="{{ date('Y-m-d H:i:s', $flash_deal->end_date) }}" data-countdown-label="show"></div>
                        </div>
                        <div class="navigator">
                            <a href="{{route('flash-deals')}}">See All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slick-slider-flash">
                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                @php
                    $product = \App\Product::find($flash_deal_product->product_id);
                @endphp
                @if ($product != null && $product->published != 0)
                
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
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>  

@endif
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
                            <div class="product-grid-image2 w-50">
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
                            <div class="product-content w-50">
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
@php
$today = date('Y-m-d H:i:s');
// dd($today);
@endphp
@endsection
    


@section('script')
@if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
@php
    $time = '';
@endphp
<script>
    $(document).ready(function() {
        // flash counter
        var data = @json($time);
        var today = @json($today);
        // console.log(data);
        var countDownDate = new Date(data).getTime();
        // console.log('countDownDate'+countDownDate)
        // Update the count down every 1 second
        var x = setInterval(function() {
        // Get today's date and time
        var now = new Date(today).getTime();
        // console.log('now'+now)
        //   alert(countDownDate);
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // console.log('distance'+distance)
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // console.log(document.getElementsByClassName("demo"));
        // Output the result in an element with id="demo"
        $('.demo').text(days + " days : " + hours + " hours : " + minutes + " minutes : " + seconds + " seconds");
        //document.getElementsByClassName("demo").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
        // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                $('.demo').text("EXPIRED");
                //document.getElementsByClassName("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
        // flash counter
    });
</script>
@endif
<script>

    $(document).ready(function() {
        
        $.post('{{ route('home.section.featured')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                // console.log(data);
                $('#section_featured').html(data);
                $(document).ajaxStop(function(){
                    $('.slick-slider-listing2').slick({
                        infinite: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                        autoplay:true,
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
            });
        $.post('{{ route('home.section.best_selling')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                $('#section_best_selling').html(data);
                $(document).ajaxStop(function(){
                    $('.slick-slider-bestselling').slick({
                        infinite: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                        rows:2,
                        autoplay:true,
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
            });
        $.post('{{ route('home.section.home_categories')}}', {_token:'{{ csrf_token() }}'
            },
            function(data) {
                $('#section_home_categories').html(data);
                
            });
            $(document).ajaxStop(function(){
                $('.slick-slider-listing-home').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    rows:2,
                    autoplay:true,
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
                $(document).ajaxStop(function(){

                    $(".slider_feature2").slick({
                        autoplay: true,
                        slidesToShow: 5,
                        slidesToScroll: 7,
                        arrows: true,
                        dots: false,
                        autoplay:true,
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
    });
</script>
@endsection