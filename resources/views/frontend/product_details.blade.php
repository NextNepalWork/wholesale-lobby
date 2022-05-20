@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->name }}@endsection

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
@endsection

@section('content')

    <!-- Breadcrumb -->
    <section id="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                @php
                $category=\App\Models\Category::where('id',$detailedProduct->category_id)->first();
                $sub_category=\App\Models\SubCategory::where('id',$detailedProduct->subcategory_id)->first();
                $sub_sub=\App\Models\SubSubCategory::where('id',$detailedProduct->subsubcategory_id)->first();

                @endphp
                <li class="breadcrumb-item">
                    <a  href="{{ route('products.category',$category->slug) }}">{{$category->name}}</a>
                </li>
                @if ($sub_category!=null)
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.subcategory',$sub_category->slug) }}">{{$sub_category->name}}</a>
                    </li>
                @endif

                <li class="breadcrumb-item">
                    <a href="{{ route('product',$detailedProduct->slug) }}">{{$detailedProduct->name}}</a>
                </li>
            </ol>
        </nav>
    </section>
    <!-- Breadcrumb Ends -->

    <section id="product-detail-wrapper" class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="product-carousel">
                        @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach (json_decode($detailedProduct->photos) as $key => $photo)

                                <div class="swiper-slide">
                                    @if (!empty($photo))
                                        @if (file_exists($photo))
                                            <img src="{{ asset($photo) }}"
                                            data-zoom="{{ asset($photo) }}" class="img-responsive">
                                        @else
                                            <img src="{{asset('frontend/images/placeholder.jpg')}}"
                                            data-zoom="{{asset('frontend/images/placeholder.jpg')}}" class="img-responsive">
                                        @endif
                                    @else
                                        <img src="{{asset('frontend/images/placeholder.jpg')}}"
                                        data-zoom="{{asset('frontend/images/placeholder.jpg')}}" class="img-responsive">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                    @if (!empty($photo))
                                        @if (file_exists($photo))
                                            <div class="swiper-slide" style="background-image:url('{{ asset($photo) }}')">
                                            </div>
                                        @else
                                        <div class="swiper-slide" style="background-image:url('{{ asset("frontend/images/placeholder.jpg") }}')">
                                        </div>
                                        @endif
                                    
                                    @else
                                    <div class="swiper-slide"
                                    style="background-image:url('{{ asset("frontend/images/placeholder.jpg") }}')">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="zoom">
                    </div>

                </div>
                <div class="col-lg-8 col-12">
                    <div class="right-side-wrapper products-seller w-100">
                        <ul class="products">
                            <li>
                                <div class="row py-3 mb-3 bg-white">
                                    <div class="col-lg-7 col-12 post">
                                        <div class="product-grid-item d-flex align-items-center">

                                            <div class="product-content ml-3">
                                                <a href="#" class="title">{{ __($detailedProduct->name) }}</a>
                                                <div class="price mb-1"> 
                                                    {{-- <span class="font-weight-bold">Npr 150</span>
                                                    /packet --}}
                                                    @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))
                                                        <div class="product-price text-dark">
                                                            <div class="font-weight-bold">{{ home_discounted_price($detailedProduct->id) }}
                                                                <span class="piece">/{{ $detailedProduct->unit }}</span>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="first-price mr-2">{{ home_price($detailedProduct->id) }}
                                                                    <span>/{{ $detailedProduct->unit }}</span>
                                                                </div>
                                                                <div class="discount">
                                                                    @if (! $detailedProduct->discount == 0)
                                                                        <div class="">
                                                                            -{{ ($detailedProduct->discount_type == 'amount')?'Rs.':'' }} {{ (intval($detailedProduct->discount,0)) }}{{ !($detailedProduct->discount_type == 'amount')?' %':'' }} off
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="product-price text-dark">
                                                            <div class="font-weight-bold">{{ home_discounted_price($detailedProduct->id) }}
                                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
                                                            </div> 
                                                        </div>
                                                    @endif
                                                </div>
                                                <ul class="other-detail">
                                                    <li>Brand: <span>@if($detailedProduct->brand)
                                                        <a href="{{route('products.brand',['brand_slug' => $detailedProduct->brand->slug])}}">{{$detailedProduct->brand->name}}</a>
                                                        @endif</span> </li>
                                                    <li>Category: <span><a href="{{route('products.category',$detailedProduct->category->slug)}}">{{$detailedProduct->category->name}}</a>
                                                        </span> </li>
                                                    {{-- <li>Weight: <span>Abc</span> </li>
                                                    <li>Type: <span>Hotel, Home, Hospital, Restaurant</span> </li> --}}
                                                </ul>
                                                <div class="enterprise mb-2">Sold by: 
                                                    <span class="font-weight-bold">
                                                    @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">{{ $detailedProduct->user->shop->name }}</a>
                                                    @else
                                                        {{ __('Inhouse product') }}
                                                    @endif
                                                    </span>
                                                </div>
                                                {{-- <p>{!! $detailedProduct->description !!}</p> --}}

                                                {{-- <form class="product-types">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label>Weight</label>
                                                            <select id="size" class="form-control">
                                                                <option selected="">Choose...</option>
                                                                <option>1kg</option>
                                                                <option>2kg</option>
                                                                <option>3kg</option>
                                                            </select>
                                                        </div>
                                                        <!-- <div class="form-group col-md-8">
                                                            <div class="quantity mb-3">
                                                                <label>Quantity <span>(Must be greater than
                                                                        6pcs)</span> </label>
                                                                <div>
                                                                    <input type="number" placeholder="1"></div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <ul class="d-flex mb-3 extralink">
                                                        <li> <a href="" class="mr-3">Add to Compare</a>
                                                        </li>
                                                        <li> <a href="" class="mr-3">Add to Wishlist</a>
                                                        </li>
                                                    </ul>
                                                    <div class="button-wrapper">
                                                        <button class="effect">Add to Cart</button>
                                                        <button class="effect">Buy Now</button>
                                                    </div>
                                                    <div class="info mt-2">
                                                        <p><span>
                                                                Estimated Delivery:
                                                            </span>1-2 days inside Valley & 2-3 days Outside valley
                                                        </p>
                                                    </div>
                                                    <div class="vendor-contact-info mb-2">
                                                        <ul class="social-links d-flex align-items-center pl-0">
                                                            <h6 class="mb-0 mr-2">Share On:</h6>
                                                            <li class="logo-bg">
                                                                <a href="https://www.facebook.com" class="text-white"><i
                                                                        class="fa fa-facebook"
                                                                        aria-hidden="true"></i></a>
                                                            </li>
                                                            <li class="feature_in_bg ml-3">
                                                                <a href="https://www.instagram.com"
                                                                    class="text-white"><i class="fa fa-instagram"
                                                                        aria-hidden="true"></i></a>
                                                            </li>
                                                            <li class="logo-bg ml-3">
                                                                <a href="https://www.google.com" class="text-white"><i
                                                                        class="fa fa-google-plus"
                                                                        aria-hidden="true"></i></a>
                                                            </li>
                                                            <li class="logo-bg ml-3">
                                                                <a href="https://np.linkedin.com" class="text-white"><i
                                                                        class="fa fa-linkedin"
                                                                        aria-hidden="true"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form> --}}
                                                <form id="option-choice-form" class="product-types image-size-wrapper">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                                    @php
                                                    $qty = 0;
                                                    if($detailedProduct->variant_product){
                                                        foreach ($detailedProduct->stocks as $key => $stock) {
                                                            $qty += $stock->qty;
                                                        }
                                                    }
                                                    else{
                                                        $qty = $detailedProduct->current_stock ;
                                                    }
                                                    @endphp
                                                    <div class="form-row">
                        
                                                        @if (count(json_decode($detailedProduct->colors)) > 0)
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <div class="image-select">
                                                                <h5>Color</h5>
                                                                <div class="my-color ml-5">
                                                                    @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                                    <label class="radio m-0" style="background: {{ $color }}; width:30px; height:30px;" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip">
                                                                        <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif style="opacity:1">
                                                                        <span style="background:{{$color}}; border:{{$color}}"></span> 
                                                                    </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                        
                                                        @if ($detailedProduct->choice_options != null)
                                                        {{-- {{dd($detailedProduct->choice_options)}} --}}
                                                        @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                                        <div class="form-group col-lg-12 col-md-6">
                                                            <div class="size-wrapper">
                                                                <div class="size-select">
                                                                    <h5>{{ \App\Attribute::find($choice->attribute_id)->name }}</h5>
                                                                    <div class="select-size ml-5">
                                                                        {{-- {{dd($choice->values)}} --}}
                                                                        @foreach ($choice->values as $key => $value)
                                                                        <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                                            <label for="{{ $choice->attribute_id }}-{{ $value }}" class="size">{{ $value }}</label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                        
                                                        <div class="form-group col-lg-4 col-md-6">
                                                            <div class="quantity">
                                                                <h5>Quantity</h5>
                                                                <div class="qty-1">
                                                                    <span class="input-group-btn minus">
                                                                        <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" style="padding:0px;">
                                                                            -
                                                                        </button>
                                                                    </span>
                                                                    <input type="text" name="quantity" class="input-number text-center" placeholder="1" value="10" min="10" max="100">
                                                                    <span class="input-group-btn plus" data-type="plus" data-field="quantity">
                                                                        <button class="btn btn-number" type="button" data-type="plus" data-field="quantity" style="padding:0px;">
                                                                            +
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                                <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{__('available')}})</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <div class="row no-gutters">
                                                        <div class="product-description-label font-weight-bold d-flex">
                                                            Shipping Cost:
                                                            @php   
                                                            $shipping_type = \App\BusinessSetting::where('type', 'shipping_type')->first()->value;
                                                            if($shipping_type == 'product_wise_shipping'){
                                                                $shipping = $detailedProduct->shipping_cost;
                                                            }elseif($shipping_type == 'flat_rate'){
                                                                $shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
                                                            }
                                                            @endphp
                                                            @if ($detailedProduct->shipping_type=='free')
                                                               <span class="cost pl-2">Free</span> 
                                                            @else
                                                                @if ($shipping <= 0)
                                                                    <span class="cost pl-2">Free</span> 
                                                                @else
                                                                    <span class="cost pl-2"> Rs. {{(intval($detailedProduct->shipping_cost,0))}} </span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div> --}}
                                                    <div class="row no-gutters py-2 d-none align-items-center" id="chosen_price_div">
                                                        <div class="col-4 m-auto">
                                                            <div class="product-description-label h5 m-0">{{__('Total Price')}}:</div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="product-price text-dark" style="background: none;">
                                                                <strong id="chosen_price" class="font-weight-bold h5">
                                                                    
                                                                </strong>
                                                            </div>
                                                        </div>
                        
                                                    </div>
                        
                        
                                                    <ul class="d-flex mb-3 extralink">
                                                        <li> <a onclick="addToCompare({{ $detailedProduct->id }})" class="mr-3">Add to Compare</a>
                                                        </li>
                                                        <li> <a onclick="addToWishList({{ $detailedProduct->id }})" class="mr-3">Add to Wishlist</a>
                                                        </li>
                                                    </ul>
                                                    <div class="button-wrapper">
                                                        @if ($qty > 0)
                                                            <button type="button" class="effect" onclick="addToCart()">
                                                                <span class=" d-md-inline-block"> {{__('Add to cart')}}</span>
                                                            </button>
                                                            <button type="button" class="effect" onclick="buyNow()">
                                                                    {{__('Buy Now')}}
                                                            </button>
                                                        @else
                                                            <button type="button" class="effect" disabled>
                                                                    {{__('Out of Stock')}}
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="info mt-2">
                                                        <p><span>
                                                                Estimated Delivery:
                                                            </span>1-2 days inside Valley & 2-3 days Outside valley
                                                        </p>
                                                    </div>
                                                    <div class="vendor-contact-info mb-2">
                                                        <ul class="social-links d-flex align-items-center pl-0">
                                                            <h6 class="mb-0 mr-2">Share On:</h6>
                                                            <li class="logo-bg">
                                                                <div id="share"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-12 seller-info">
                                        <div class="seller-info-box p-3 my-3">
                                            <div class="sold-by position-relative">
                                                <div class="position-absolute medal-badge">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
                                                        viewBox="0 0 287.5 442.2">
                                                        <polygon style="fill:#F8B517;"
                                                            points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 ">
                                                        </polygon>
                                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8">
                                                        </circle>
                                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6">
                                                        </circle>
                                                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                                                                        60,116.6 124.1,116.6 ">
                                                        </polygon>
                                                    </svg>
                                                </div>
                                                <div class="title font-weight-bold">Sold By</div>
                                                <a href="" class="name d-block font-weight-bold">
                                                    @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">{{ $detailedProduct->user->shop->name }}</a>
                                                    @else
                                                        {{ __('Inhouse product') }}
                                                    @endif
                                                    <span class="ml-2"><i class="fa fa-check-circle"
                                                            style="color:green"></i></span>
                                                </a>
                                                @php
                                                    $total = 0;
                                                    $rating = 0;
                                                    foreach ($detailedProduct->user->products as $key => $seller_product) {
                                                        $total += $seller_product->reviews->count();
                                                        $rating += $seller_product->reviews->sum('rating');
                                                    }
                                                    // echo $rating/$total;
                                                @endphp
                    
                                                <div class="rating text-center d-block">
                                                    <span class="star-rating star-rating-sm d-block">
                                                        @if ($total > 0)
                                                            {{ renderStarRating($rating/$total) }}
                                                        @else
                                                            {{ renderStarRating(0) }}
                                                        @endif
                                                    </span>
                                                    <span class="rating-count d-block ml-0">({{ $total }} {{__('customer reviews')}})</span>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center align-items-center">
                                                @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="anchor-btn2 mt-2">Visit Store</a>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="sidebar mb-5 ">
                                            <div class="popular-post">
                                                <div class="title position-relative bg-light p-3">
                                                    <h6 class="title m-0">Top Products From This Seller </h6>
                                                </div>
                                                <ul>
                                                    @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(5)->get() as $key => $top_product)
                                                    <li class="mb-2">
                                                        <div class="d-flex align-items-center px-3">
                                                            <div class="post-image mr-2 w-xl-25 w-md-0">
                                                                @if (!empty($top_product->featured_img))
                                                                    @if (file_exists($top_product->featured_img))
                                                                        <img src="{{asset($top_product->featured_img)}}" class="img-fluid ">    
                                                                    @else
                                                                        <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid ">
                                                                    @endif
                                                                @else
                                                                    <img src="{{asset('frontend/images/placeholder.jpg')}}" class="img-fluid ">
                                                                @endif
                                                            </div>
                                                            <div class="post-content w-75">
                                                                <div class="post-title">
                                                                    <a href="{{route('product',$top_product->slug)}}">
                                                                        {{$top_product->name}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="first-tab" data-toggle="tab" href="#first"
                            role="tab" aria-controls="first" aria-selected="true"
                            style="color: rgb(72, 77, 103);">Product Details</a>
                            
                            @if($detailedProduct->specs != null)
                            <a class="nav-item nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fourth" aria-selected="false"
                            style="color: rgb(72, 77, 103);">Specification</a>
                            @endif
    
                            
                            @if($detailedProduct->pdf != null)
                            <a class="nav-item nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false"
                            style="color: rgb(72, 77, 103);">Downloads</a>
                            @endif
    
                            @if($detailedProduct->video_link != null)
                            
                            <a class="nav-item nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false"
                            style="color: rgb(72, 77, 103);">Video</a>
    
                            @endif
    
                            <a class="nav-item nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="false"
                            style="color: rgb(72, 77, 103);">Reviews <span>({{count($detailedProduct->reviews)}})</span>
                            </a>
                            
                           
                            
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade p-3 w-75 active show" id="first" role="tabpanel"
                            aria-labelledby="first-tab">{!! $detailedProduct->description !!}
                        </div>
                        
                        <div class="tab-pane fade p-3 w-75" id="fifth" role="tabpanel"
                            aria-labelledby="fifth-tab">{!! $detailedProduct->specs !!}
                        </div>
                        
                        <div class="tab-pane fade p-3" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                            <div class="py-2 px-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-success" href="{{ asset($detailedProduct->pdf) }}"><i class="fa fa-download"></i> {{ __('Download PDF') }}</a>
                                    </div>
                                </div>
                                <span class="space-md-md"></span>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade p-3" id="third" role="tabpanel" aria-labelledby="third-tab">
                            <div class="fluid-paragraph py-2">
                                <!-- 16:9 aspect ratio -->
                                {{-- {{dd($detailedProduct)}} --}}
                                <div class="embed-responsive embed-responsive-16by9 mb-5">
                                    @php
                                        $url = $detailedProduct->video_link;
                                    @endphp
                                        @if(!filter_var($url, FILTER_VALIDATE_URL) === false)
                                            @if ($detailedProduct->video_provider == 'youtube' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'dailymotion' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'vimeo' && $detailedProduct->video_link != null)
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="second" role="tabpanel" aria-labelledby="second-tab">
                            
                            <div class="row align-items-center justify-content-center">
                                <!-- people Comments -->
                                @if(count($detailedProduct->reviews) > 0)
                                <div class="col-xl-8 col-lg-8 col-12 mb-4">
                                    <div class="d-flex people-comment">
                                        <ul class="comment-wrapper">
                                            @foreach ($detailedProduct->reviews as $key => $review)

                                            <li class="d-md-flex d-block mb-2 p-4">
                                                <div class="image mr-3">
                                                    <a href="#">
                                                        @php
                                                            $user_img=\App\User::where('id',$review->user_id)->first();
                                                        @endphp
                                                        @if (empty($user_img->avatar_original))
                                                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                                        @else
                                                            @if (file_exists(asset($user_img->avatar_original)))
                                                                <img class="img-responsive user-photo" src="{{asset($user_img->avatar_original)}}">
                                                            @else
                                                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
    
                                                            @endif
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5>{{$user_img->name}}</h5>
                                                    <div class="comment-date mb-2">
                                                        <p class="m-0 text-uppercase"> {{ date('D, d M Y', strtotime($review->created_at)) }} </p>
                                                    </div>
                                                    <p>{{ $review->comment }}</p>
                                                    <!-- Comment Reply -->
                                                    {{-- <ul>
                                                        <li>
                                                            <div class="comment-reply">
                                                                <div class="d-flex">
                                                                    <div class="image mr-3">
                                                                        <a href="#">
                                                                            <img class="img-responsive user-photo"
                                                                                src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h5>Azar Hank</h5>
                                                                        <div class="comment-date mb-2">
                                                                            <p class="m-0 text-uppercase"> 12 March,
                                                                                2021 AT 10:50 </p>
                                                                        </div>
                                                                        <p>Lorem ipsum, dolor sit amet consectetur
                                                                            adipisicing elit. Sed consequuntur
                                                                            repudiandae, ducimus error animi neque
                                                                            recusandae optio tempora non sequi
                                                                            cupiditate ipsum perspiciatis
                                                                            porro maxime praesentium doloribus amet
                                                                            delectus velit.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <!-- Comment Reply Ends -->
                                                    <div class="button">
                                                        <a href="#"> Reply</a>
                                                    </div> --}}
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @else
                                <div class="col-xl-8 col-lg-8 col-12 mb-4">
                                    <div class="d-flex people-comment">
                                        <ul class="comment-wrapper">

                                            <li class="d-md-flex d-block mb-2 p-4">
                                                <p>There has been no review yet..</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <!-- people Comments Ends -->
                                @if(Auth::check())
                                    @php
                                        $commentable = false;
                                    @endphp
                                    @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                        @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                            @php
                                                $commentable = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{-- @if ($commentable) --}}
                                    <div class="col-lg-4 col-12 mx-auto">
                                        <!-- User Comment -->
                                        <div class="user-comment py-4 px-3">
                                            <div class="title mb-3 text-center">
                                                <h2 class="font-weight-bold mb-2">Add a comment</h2>
                                            </div>
                                            <div class="col-12">
                                                <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <input type="text" class="form-control rounded-0" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                           
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <input type="text" class="form-control rounded-0" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                            
                                                        </div>
                                                        <div class="col-12 my-2">
                                                            <div class="col-text-area d-flex justify-content-center">
                                                                <textarea class="w-100 p-3 rounded-0" rows="4" name="comment" placeholder="{{__('Your review')}}" required></textarea>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                                                    <input type="radio" id="star1" name="rating" value="5" required/>
                                                                    <label class="tf-ion-android-star" for="star1" title="Awesome" aria-hidden="true"></label>
                                                                    <input type="radio" id="star2" name="rating" value="4" required/>
                                                                    <label class="tf-ion-android-star" for="star2" title="Great" aria-hidden="true"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" required/>
                                                                    <label class="tf-ion-android-star" for="star3" title="Very good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star4" name="rating" value="2" required/>
                                                                    <label class="tf-ion-android-star" for="star4" title="Good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star5" name="rating" value="1" required/>
                                                                    <label class="tf-ion-android-star" for="star5" title="Bad" aria-hidden="true"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="button-wrapper mx-auto mb-3">
                                                            <button type="submit" class="btn-custom px-4 color-white">Send</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- User Comment Ends-->
                                    </div>
                                    {{-- @endif --}}
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </section>
@php
    $products=filter_products(\App\Product::where('subcategory_id', $detailedProduct->subcategory_id)->where('id', '!=', $detailedProduct->id))->get();
@endphp
@if (count($products)>0)
    

    <section id="product-listing-wrapper" class="position-relative py-5">
        <div class="container">
            <div class="product-lists">
                <div class="row">
                    <div class="col-12">
                        <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                            <div class="head">
                                <h4 class="font-weight-bold">
                                    Related Products</h4>
                                <!-- <p class="m-0">THERE'S SOMETHING FOR EVERYONE</p> -->
                            </div>
                            {{-- <div class="navigator"> <a href="">See all</a> </div> --}}
                        </div>
                    </div>
                </div>
                <div class="slick-slider-listing">
                    @foreach ($products as $key => $related_product)
                    <div class="slick-item position-relative py-4">
                        <div class="product-grid-item">
                            <div class="product-grid-image">
                                <a href="{{ route('product', $related_product->slug) }}"> 
                                    @php
                                        $filepath = $related_product->featured_img;
                                    @endphp
                                    @if(isset($filepath))
                                        @if (file_exists(public_path($filepath)))
                                            <img src="{{ asset($related_product->featured_img) }}" alt="{{ $related_product->name }}" data-src="{{ asset($related_product->featured_img) }}" class="img-fluid pic-1">
                                        @else
                                            <img src="{{ asset('uploads/No_Image.jpg') }}" alt="{{ $related_product->name }}" data-src="{{ asset('uploads/No_Image.jpg') }}" class="img-fluid pic-1">
                                        @endif
                                    @else
                                        <img src="{{ asset('uploads/No_Image.jpg') }}" alt="{{ $related_product->name }}" data-src="{{ asset('uploads/No_Image.jpg') }}" class="img-fluid pic-1">
                                    @endif
                            </div>
                            <div class="product-content mx-auto text-center">
                                <h3 class="title text-center"> <a href="{{ route('product', $related_product->slug) }}" class="">{{ __($related_product->name) }}</a></h3>
                                <div class="price text-center mb-1"> 
                                    @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                        <del class="old-product-price strong-400">{{ home_base_price($related_product->id) }}</del>
                                    @endif
                                    <span class="product-price strong-600">{{ home_discounted_base_price($related_product->id) }}</span>    
                                </div>
                                <div class="enterprise text-center mb-2">Sold by: <span
                                    class="font-weight-bold">
                                    @if ($related_product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <a href="{{ route('shop.visit', $related_product->user->shop->slug) }}">{{ $related_product->user->shop->name }}</a>
                                    @else
                                        {{ __('Inhouse product') }}
                                    @endif
                                </span>
                                </div>
                                <a href="{{ route('product', $related_product->slug) }}" class="anchor-btn2 mb-3">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

    <!-- Product Detail Ends -->
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Question">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-person"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                                <span class="input-group-addon">
                                                    <i class="text-md ion-locked"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <a href="#" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-4">
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                            <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                        </a>
                                    @endif
                                    @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                        <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
    		$('#share').jsSocials({
    			showLabel: false,
                showCount: false,
                shares: ["email", "twitter", "facebook", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
    		});
            getVariantPrice();
    	});

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }


    </script>

    
@endsection
