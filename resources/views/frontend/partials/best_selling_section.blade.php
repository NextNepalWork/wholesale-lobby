
<section class="product-listing position-relative pt-5 bg-white">
    <div class="container">
        <div class="product-lists">
            <div class="row">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                        <div class="head">
                            <h4 class="font-weight-bold">Best Selling Products</h4>
                            <!-- <p class="m-0">THERE'S SOMETHING FOR EVERYONE</p> -->
                        </div>
                        {{-- <div class="navigator"> <a href="product-list.html">See all</a> </div> --}}
                    </div>
                </div>
            </div>
            <div class="slick-slider-bestselling">
                @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get() as $key => $product)
                @if ($product->expiry_date==null || date('Y-m-d H:i:s') <= $product->expiry_date)   

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
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>