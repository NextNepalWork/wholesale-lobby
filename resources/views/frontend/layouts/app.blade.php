<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="en">
@else
<html lang="en">
@endif
<head>

    @php
    $seosetting = \App\SeoSetting::first();
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>@yield('meta_title', config('app.name', 'Laravel'))</title>
    <meta name="description" content="@yield('meta_description', $seosetting->description)" />
    <meta name="keywords" content="@yield('meta_keywords', $seosetting->keyword)">
    <meta name="author" content="{{ $seosetting->author }}">
    <meta name="sitemap_link" content="{{ $seosetting->sitemap_link }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">

    @yield('meta')

    @if(!isset($detailedProduct))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    @endif

    <!-- Favicon -->
    <link type="image/x-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />



    <!-- Custom Links -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&family=Readex+Pro:wght@200&display=swap" rel="stylesheet" /> --}}


    <!-- Font Link Ends -->

    <!-- Bootstrap link Starts -->
    <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap-4.3.1/css/bootstrap.min.css.map')}}">
    <!-- Bootstrap link Ends -->
    <!-- Font Awesome Link Starts -->
    <link rel="stylesheet" href="{{asset('frontend/assets/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Font Awesome Link Ends -->
    <!-- Slick Css -->
    <link rel="stylesheet" href="{{asset('frontend/assets/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/slick/slick-theme.css')}}">
    <!-- Slick Css Ends-->
    <!-- Custom Links -->
    <!-- Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ledger&display=swap" rel="stylesheet">
    <!-- Font Link Ends -->
    <!-- Bootstrap range slider -->
    <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap-range-slider-js/css/bootstrap-slider.min.css')}}">
    <!-- Bootstrap range slider Ends -->

    <link rel="stylesheet" href="{{asset('frontend/assets/swiper/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/swiper/drift-basic.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/responsive.css')}}">
    <!-- Custom Links Ends -->
    <!-- Countdown start -->
    <link rel="stylesheet" href="{{asset('frontend-old/assets/countdown/css/flipclock.css')}}" />
    <!-- Countdown end -->

    

    {{-- <link rel="stylesheet" href="{{ asset('frontend-old/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-old/css/dashboard-responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-old/css/dashboard-two.css') }}" /> --}}


    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('frontend-old/css/line-awesome.min.css') }}" type="text/css" media="none" onload="if(media!='all')media='all'">

    <link type="text/css" href="{{ asset('frontend-old/css/bootstrap-tagsinput.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('frontend-old/css/jodit.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('frontend-old/css/sweetalert2.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    {{-- <link type="text/css" href="{{ asset('frontend-old/css/slick.css') }}" rel="stylesheet" media="all"> --}}
    <link type="text/css" href="{{ asset('frontend-old/css/xzoom.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('frontend-old/css/jssocials.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('frontend-old/css/jssocials-theme-flat.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('frontend-old/css/intlTelInput.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <link type="text/css" href="{{ asset('css/spectrum.css')}}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

    <!-- Global style (main) -->
    <link type="text/css" href="{{ asset('frontend-old/css/active-shop.css') }}" rel="stylesheet" media="all">




    <link type="text/css" href="{{ asset('frontend-old/css/main.css') }}" rel="stylesheet" media="all">


    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <!-- RTL -->
    <link type="text/css" href="{{ asset('frontend-old/css/active.rtl.css') }}" rel="stylesheet" media="all">
    @endif
    <style>
        .nav-link{
            color:#666 !important;
        }
        .nav-link:hover{
            color:#666 !important;
        }
    </style>
</head>

<body onload="myFunction()">
    <div id="loading">
        <div class="d-flex justify-content-center align-items-center h-75"> <img
                src="{{asset('frontend/assets/images/comingsoon.png')}}" alt="">
        </div>
    </div>
    <section id="index-wrapper">
    @php
        $generalsetting = \App\GeneralSetting::first();
    @endphp
    @if ($generalsetting->pop_status == 1)
        <div class="modal fade coming-soon-modal height-95vh" id="abc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="z-index: 99999;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="p-0 modal-header w-100">
                        <img src="{{asset($generalsetting->pop_img)}}" class="w-100 height-95vh">
                        <button type="button" class="close m-0 custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                </div>
            </div>
        </div>

    @endif
    <!-- MAIN WRAPPER -->

        <!-- Header -->
        @include('frontend.inc.nav')

        @yield('content')

        @include('frontend.inc.footer')

        @include('frontend.partials.modal')

                <div class="modal fade" id="addToCart">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                        <div class="modal-content position-relative">
                            <div class="c-preloader">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div id="addToCart-modal-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- END: body-wrap -->


    </section>
    <!-- Scroll Button -->
    <section id="scroll-btn">
        <a href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
    </section>
    <!-- Scroll Button Ends -->
    <!-- Whole Body Wrapper Ends -->
    <!-- 1st Jquery Link Starts-->
    <script src="{{asset('frontend/assets/jquery-3.5.1/jquery-3.5.1.js')}}"></script>
    <!-- Jquery Link Ends-->
    <!-- 2nd Popper Js Starts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <!-- Popper Js Ends -->
    <!-- 3rd Bootstrap Js Link Starts -->
    <script src="{{asset('frontend/assets/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/bootstrap-4.3.1/js/bootstrap.min.js.map')}}"></script>
    <!-- Bootstrap Js Link Ends -->


    <!-- Slick Js -->
    <script src="{{asset('frontend/assets/slick/slick.min.js')}}"></script>
    <!-- Slick Js Ends-->
    <!-- Isotope Js -->
    <script src="{{asset('frontend/assets/isotope-js/isotope.pkgd.min.js')}}"></script>
    <!-- Isotope Js Ends-->
    <!-- Bootstrap range slider js -->
    <script src="{{asset('frontend/assets/bootstrap-range-slider-js/bootstrap-slider.min.js')}}"></script>
    <!-- Bootstrap range slider js Ends-->
    <!-- Toastr -->
    <script src="{{asset('frontend/assets/toastr/toastr.min.js')}}"></script>
    <!-- Toastr Ends -->
    <!-- Magnific Popup -->
    <script src="{{asset('frontend/assets/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <!-- Magnific Popup Ends-->
    <!-- Custom Js Starts -->
    <script src="{{asset('frontend/assets/swiper/swiper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/swiper/drift.min.js')}}"></script>
    <!-- Countdown start -->
    <script src="{{asset('frontend/assets/countdown/js/flipclock.js')}}"></script>
    <!-- Countdown end -->
    <!-- Custom Js  -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <!-- Custom Js Ends -->



    <!-- Plugins: Sorted A-Z -->
    <script src="{{ asset('frontend-old/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/jssocials.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/jodit.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/xzoom.min.js') }}"></script>
    <!-- <script src="{{ asset('frontend-old/js/fb-script.js') }}"></script> -->
    <script src="{{ asset('frontend-old/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('frontend-old/js/intlTelInput.min.js') }}"></script>
    <!-- rating star -->
    <script src="{{asset('plugins/rating/rating.js')}}"></script>

    <script src="https://use.fontawesome.com/79d6e010ae.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App JS -->
    <script src="{{ asset('frontend-old/js/active-shop.js') }}"></script>
    {{-- <script src="{{ asset('frontend-old/js/main.js') }}"></script> --}}

    @if ($generalsetting->pop_status == 1)
    <script type="text/javascript">
        $(window).on('load', function() {
            $('.coming-soon-modal').modal('show');
        });
    </script>
    @endif

    <script>
        function showFrontendAlert(type, message) {
            if (type == 'danger') {
                type = 'error';
            }
            swal({
                position: 'top-end',
                type: type,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>

    @foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
    @endforeach
    <script>
        $(document).ready(function () {
            // product Gallery and Zoom
            // activation carousel plugin
            var galleryThumbs = new Swiper(".gallery-thumbs", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });
            var galleryTop = new Swiper(".gallery-top", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: galleryThumbs,
                },
            });

            var paneContainer = document.querySelector(".zoom");

            $(".swiper-slide").each(function () {
                new Drift($(this).find("img")[0], {
                    paneContainer: paneContainer,
                    inlinePane: false,
                });
            });
        });

        $(document).ready(function() {
            $('.view-seller-policy').on('click',function(){
                $('#exampleModal222').modal('show');
            });
            $('.multi-level').css('min-height','80vh!important');

            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function() {
                    if (!$(el).find('.sub-cat-menu').hasClass('loaded')) {
                        $.post('{{ route('category.elements') }}', {
                                _token: '{{ csrf_token()}}',
                                id: $(el).data('id')
                            },
                            function(data) {
                                $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                            });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-item a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}', {
                                _token: '{{ csrf_token() }}',
                                locale: locale
                            },
                            function(data) {
                                location.reload();
                            });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-item a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('{{ route('currency.change')     }}', {
                                _token: '{{ csrf_token() }}',
                                currency_code: currency_code
                            },
                            function(data) {
                                location.reload();
                            });

                    });
                });
            }
            $('.address_id').on('change',function(e){    
    var location_id = $(this).data('location')
    var taxTotal = $('.tax-total').text();
    var subTotal = $('.sub-total').text();
    var shippingBeforeLocation = $('.shipping-before-location').text();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var ajaxurl = '/location/getLocationCharge';
    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            "deliveryLocation": location_id,
            "taxTotal": taxTotal,
            "subTotal": subTotal,
            "shippingBeforeLocation": shippingBeforeLocation,
        },
        dataType: 'json',
        beforeSend: function() {},
        success: function(data) {

            if (data != 'false') {
                console.log(data);
                $('.delivery-charge-span').text('Rs.'+data.location_charge);
                $('.shipping-total-span').text('Rs.'+data.total_shipping);
                $('.grand-total-span').text('Rs.'+data.total);
                // optionLoop = '';
                // options = data;
                // options.forEach(function(index) {
                //     optionLoop +=
                //         '<option value="'+index.id+'">'+index.name+'</option>';
                // });
            } 
            // else {
            //     optionLoop = '<option disabled>No Locations</option>';
            // }
            // $(".address-location").html(optionLoop);

        },
        error: function(data) {
            showFrontendAlert('error',data.responseText);
        }
    });
});
$(".flash_feature").slick({
    infinite: true,
    autoplay: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 1080,
            settings: {
                slidesToShow: 4,
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
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            },
        },
    ],
});
$('.address-district').on('change',function(e){
    var district_id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var ajaxurl = '/location/getLocation';
    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            "district_id": district_id,
        },
        dataType: 'json',
        beforeSend: function() {},
        success: function(data) {

            if (data != 'false') {
                optionLoop = '';
                options = data;
                options.forEach(function(index) {
                    optionLoop +=
                        '<option value="'+index.id+'">'+index.name+'</option>';
                });
            } else {
                optionLoop = '<option disabled>No Locations</option>';
            }
            $(".address-location").html(optionLoop);

        },
        error: function(data) {
            showFrontendAlert('error',data.responseText);
        }
    });
});
        });

        $('#search').on('keyup', function() {
            search();
        });

        $('#search').on('focus', function() {
            search();
        });

        function search() {
            var search = $('#search').val();
            if (search.length > 0) {
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route('search.ajax') }}', {
                        _token: '{{ @csrf_token() }}',
                        search: search
                    },
                    function(data) {
                        if (data == '0') {
                            // $('.typed-search-box').addClass('d-none');
                            $('#search-content').html(null);
                            $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"' + search + '"</strong>');
                            $('.search-preloader').addClass('d-none');

                        } else {
                            $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                            $('#search-content').html(data);
                            $('.search-preloader').addClass('d-none');
                        }
                    });
            } else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart() {
            $.post('{{ route('cart.nav_cart') }}', {
                    _token: '{{ csrf_token() }}'
                },
                function(data) {
                    $('#cart_items').html(data);
                });
        }

        function removeFromCart(key) {
            $.post('{{ route('cart.removeFromCart') }}', {
                    _token: '{{ csrf_token() }}',
                    key: key
                },
                function(data) {
                    updateNavCart();
                    $('#cart-summary').html(data);
                    showFrontendAlert('success', 'Item has been removed from cart');
                    $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) - 1);
                });
        }

        function addToCompare(id) {
            $.post('{{ route('compare.addToCompare') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                function(data) {
                    if(data == 'false'){
                        showFrontendAlert('error', 'Products to compare must be of same category. Or you can reset compare list.');

                    }else{
                        $('#compare').html(data);
                        showFrontendAlert('success', 'Item has been added to compare list');
                        $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);

                    }
                });
        }

        function addToWishList(id) {
            @if(Auth::check() && (Auth::user() -> user_type == 'customer' || Auth::user() -> user_type == 'seller'))
            $.post('{{ route('wishlists.store') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                function(data) {
                    if (data != 0) {
                        $('#wishlist').html(data);
                        showFrontendAlert('success', 'Item has been added to wishlist');
                    } else {
                        showFrontendAlert('warning', 'Please login first');
                    }
                });
            @else
            showFrontendAlert('warning', 'Please login first');
            @endif
        }

        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                function(data) {
                    $('.c-preloader').hide();
                    $('#addToCart-modal-body').html(data);
                    $('.xzoom, .xzoom-gallery').xzoom({
                        Xoffset: 20,
                        bg: true,
                        tint: '#000',
                        defaultScale: -1
                    });
                    getVariantPrice();
                });
        }

        $('#option-choice-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {
            if ($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('products.variant_price') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        $('#option-choice-form #chosen_price_div').removeClass('d-none');
                        $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                        $('#available-quantity').html(data.quantity);
                        $('.input-number').prop('max', data.quantity);
                        //console.log(data.quantity);
                        if (parseInt(data.quantity) < 1 && data.digital != 1) {
                            $('.buy-now').hide();
                            $('.add-to-cart').hide();
                        } else {
                            $('.buy-now').show();
                            $('.add-to-cart').show();
                        }
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if ($('#option-choice-form input:radio:checked').length == count) {
                return true;
            }

            return false;
        }

        function addToCart() {
            if (checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        $('#addToCart-modal-body').html(null);
                        $('.c-preloader').hide();
                        $('#modal-size').removeClass('modal-lg');
                        $('#addToCart-modal-body').html(data);
                        updateNavCart();
                        $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                    }
                });
            } else {
                showFrontendAlert('warning', 'Please choose all the options');
            }
        }

        function buyNow() {
            if (checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        //$('#addToCart-modal-body').html(null);
                        //$('.c-preloader').hide();
                        //$('#modal-size').removeClass('modal-lg');
                        //$('#addToCart-modal-body').html(data);
                        updateNavCart();
                        $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) + 1);
                        window.location.replace("{{ route('cart') }}");
                    }
                });
            } else {
                showFrontendAlert('warning', 'Please choose all the options');
            }
        }

        function show_purchase_history_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('purchase_history.details') }}', {
                    _token: '{{ @csrf_token() }}',
                    order_id: order_id
                },
                function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal();
                    $('.c-preloader').hide();
                });
        }

        function show_order_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', {
                    _token: '{{ @csrf_token() }}',
                    order_id: order_id
                },
                function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal();
                    $('.c-preloader').hide();
                });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function imageInputInitialize() {
            $('.custom-input-file').each(function() {
                var $input = $(this),
                    $label = $input.next('label'),
                    labelVal = $label.html();

                $input.on('change', function(e) {
                    var fileName = '';

                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else if (e.target.value)
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        $label.find('span').html(fileName);
                    else
                        $label.html(labelVal);
                });

                // Firefox bug fix
                $input
                    .on('focus', function() {
                        $input.addClass('has-focus');
                    })
                    .on('blur', function() {
                        $input.removeClass('has-focus');
                    });
            });
        }




        //Calculate and output the new amount

        function exchangeCurrency() {
            var amount = $(".amount").val();
            var rateFrom = $(".currency-list")[0].value;
            //    console.log(rateFrom);
            var rateTo = $(".currency-list")[1].value;
            if ((amount - 0) != amount || ('' + amount).trim().length == 0) {
                //    console.log('hi');
                $(".results").html("0");
                $(".error").show()
            } else {

                $(".error").hide()
                if (amount == undefined || rateFrom == "--Select--" || rateTo == "--Select--") {
                    $(".results").html("0");

                } else {
                    $(".results").html((amount * (rateTo * (1 / rateFrom))).toFixed(5));
                }
            }
        }

        $("#categories-list").hover(
            function() {
                $('.category-list').collapse('show');
            },
            function() {
                $('.category-list').collapse('hide');
            }
        );
        //  $(".multi-level").hover(
        //   function () {
        //     $('.category-list').collapse('show');
        //   },
        //   function () {
        //     $('.category-list').collapse('hide');
        //   }
        // );
    </script>

    @yield('script')

</body>

</html>