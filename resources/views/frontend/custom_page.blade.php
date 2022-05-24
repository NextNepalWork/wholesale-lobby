@extends('frontend.layouts.app')

@foreach ($pages as $page)
    

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($page->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($page->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $page->slug) }}" />
    <meta property="og:image" content="{{ asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($page->unit_price) }}" />
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section id="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item text-capitalize"><a href="#">{{$page->slug}}</a></li>

            </ol>
        </nav>
    </section>
    <!-- Breadcrumb Ends -->
    <!-- Whole Body Wrapper Starts -->
    <!-- About Us -->
    <section id="about-us-wrapper" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="about-us-image">
                        @if (!empty($page->meta_image))
                            @if (file_exists($page->meta_image))
                                <img src="{{asset($page->meta_image)}}" class="img-fluid">
                            @else
                                <img src="frontend/assets/images/banner/2.jpg" class="img-fluid">
                            @endif
                        @else
                            <img src="frontend/assets/images/banner/2.jpg" class="img-fluid">
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-10 col-12 mx-auto mb-2">
                    <div
                        class="about-us-image-discription d-flex h-100 justify-content-center align-items-start flex-column py-3">
                            {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Ends -->
@endsection
@endforeach