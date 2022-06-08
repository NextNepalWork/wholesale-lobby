@extends('frontend.layouts.app')

@section('content')


<!-- Breadcrumb -->
<section id="breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('flash-deals') }}">{{__('Flash Deals')}}</a>
            </li>
        </ol>
    </nav>
</section>
<!-- Breadcrumb Ends -->



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
                            <h4 class="font-weight-bold">{{$flash_deal->title}}</h4>
                        </div>
                        <div class="flash-deal-box float-left d-flex">
                            <span class="d-flex align-items-center">Offer Ends in : </span> 
                           <div class="countdown countdown--style-1 countdown--style-1-v1 " data-countdown-date="{{ date('Y-m-d H:i:s', $flash_deal->end_date) }}" data-countdown-label="show"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                @php
                    $product = \App\Product::find($flash_deal_product->product_id);
                @endphp
                @if ($product != null && $product->published != 0)
                
                <div class="col-lg-3 position-relative py-4">
                    <div class="product-grid-item">
                        <div class="product-grid-image">
                            <a href="{{route('product',$product->slug)}}"> 
                                @if (!empty($product->featured_img))
                                    @if(file_exists($product->featured_img))
                                        <img src="{{asset($product->featured_img)}}" alt="img" class="img-fluid pic-1">
                                    @else
                                    <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="img" class="img-fluid pic-1">

                                    @endif
                                @else
                                <img src="{{asset('frontend/images/placeholder.jpg')}}" alt="img" class="img-fluid pic-1">
                                    
                                @endif
 
                            </a>
                        </div>
                        <div class="product-content mx-auto text-center">
                            <h3 class="title text-center"> <a href="{{route('product',$product->slug)}}" class="">{{$product->name}} </a></h3>
                            <div class="price text-center mb-1"> 
                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                    <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                @endif
                                <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>    
                            </div>
                            <div class="enterprise text-center mb-2">Sold by: <span
                                    class="font-weight-bold">
                                    @if ($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <a href="{{ route('shop.visit', $product->user->shop->slug) }}">{{ $product->user->shop->name }}</a>
                                    @else
                                        {{ __('Inhouse product') }}
                                    @endif
                                </span>
                            </div>
                            <a href="{{route('product',$product->slug)}}" class="anchor-btn2 mb-3">View</a>
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
@endsection


