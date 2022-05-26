<section id="product-listing-wrapper" class="position-relative py-5">
    <div class="container">
        <div class="product-lists">
            <div class="row">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                        <div class="head">
                            <h4 class="font-weight-bold">
                                Featured Products</h4>
                        </div>
                        {{-- <div class="navigator"> <a href="product-list.html">See all</a> </div> --}}
                    </div>
                </div>
            </div>
            <div class="slick-slider-listing2">
                @foreach (\App\Product::where('published',1)->where('featured',1)->get() as $product)
                <div class="slick-item position-relative py-4">
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
                @endforeach
            </div>
        </div>
    </div>
</section>