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
@foreach ($flash_deals as $flash_deal)
    
@if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)
    
<section id="product-listing-wrapper" class="product-listing position-relative pt-5">
    <div class="container">
    <div class="product-lists">
    <div class="row">
       <div class="col-12">
          <div class="col-12">
             <div class="section_title_block d-flex justify-content-between align-item-center h-100 pb-3">
                <h2 class="position-relative mb-0">{{$flash_deal->title}}</h2>
                <div class="flash-deal-box float-left d-flex">
                   Sale Ends in : <div class="countdown countdown--style-1 countdown--style-1-v1 " data-countdown-date="{{ date('m/d/Y', $flash_deal->end_date) }}" data-countdown-label="show"></div>
                </div>     
             </div>
          </div>
          <div class="col-12">
             <div class="row">
                 @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                     @php
                         $product = \App\Product::find($flash_deal_product->product_id);
                     @endphp
                     @if ($product != null && $product->published != 0)
                         {{-- <div class="grid-item mb-4">
                             <div class="product-grid-item">
                                 <div class="product-grid-image">
                                     <a href="{{ route('product', $product->slug) }}">
                                         @php
                                             $filepath = $product->featured_img;
                                         @endphp
                                         @if(isset($filepath))
                                             @if (file_exists(public_path($filepath)))
                                                 <img src="{{ asset($product->featured_img) }}" alt="{{ $product->name }}" data-src="{{ asset($product->featured_img) }}" class="img-fluid pic-1">
                                             @else
                                                 <img src="{{ asset('uploads/No_Image.jpg') }}" alt="{{ $product->name }}" data-src="{{ asset('uploads/No_Image.jpg') }}" class="img-fluid pic-1">
                                             @endif
                                         @else
                                             <img src="{{ asset('uploads/No_Image.jpg') }}" alt="{{ $product->name }}" data-src="{{ asset('uploads/No_Image.jpg') }}" class="img-fluid pic-1">
                                         @endif
                                     </a>
                                 </div>
                                 <div class="category-title mt-2">
                                     <h6 class="title">
                                     <a href="{{ route('product', $product->slug) }}" class="">{{ __($product->name) }}</a>
                                     </h6>
                                     <div class="category">
                                     <a class="m-0">{{ $product->category->name }}</a>
                                     </div>
                                 </div>
                                 <div class="price-cart text-center py-2 min-height-20">
                                     <div class="price d-flex flex-column align-items-center w-100">
                                         <div class="prices align-items-center d-flex justify-content-between w-100">
                                             <div>
                                                 @php
                                                     $qty = 0;
                                                     if($product->variant_product){
                                                         foreach ($product->stocks as $key => $stock) {
                                                             $qty += $stock->qty;
                                                         }
                                                     }
                                                     else{
                                                         $qty = $product->current_stock ;
                                                     }
                                                 @endphp
 
                                                 @if($qty > 0)
                                                     <h6 class="m-0 gray text-left cus-price">{{ home_discounted_base_price($product->id) }}&nbsp;</h6>
                                                     <div class="d-flex justify-content-between w-100 align-items-center">
                                                         @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                             <span class="ml-0">{{ home_base_price($product->id) }}</span>&nbsp;&nbsp;
                                                         @endif
                                                         @if (! intval(($product->discount),0) == 0)
                                                             <div>
                                                                 {{ ($flash_deal_product->discount_type == 'amount')?'  Rs.':'' }} -{{ (intval($flash_deal_product->discount,0)) }}{{ !($product->discount_type == 'amount')?' %':'' }}
                                                             </div>
                                                         @endif
                                                     </div>
                                                 @endif
 
                                                 <div class="d-flex w-100 mt-2">
                                                     @if($qty <= 0) 
                                                         <div class="stock mr-1">
                                                             Out of Stock
                                                         </div>
                                                     @endif
                                                 </div>
                                             </div>
                                             @if($qty > 0)
                                                 <div class="d-flex justify-content-between">
                                                    
                                                     <a class="all-deals ico effect" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-placement="right" title="Add to Cart"><i class="fa fa-shopping-cart icon"></i> </a>
                                                 </div>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div> --}}
                         <div class="col-lg-3">
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
    </div>
 </section>
@endif
@endforeach


{{-- @php
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

@endif --}}
@endsection
