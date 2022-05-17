<!-- Product Listing -->
@php
    $i=0;
@endphp
@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
    @if ($homeCategory->category != null)
        @if (count($homeCategory->category->products)>0)
            <section class="product-listing position-relative py-5 @if(($i%2)==0) bg-white @else bg-light @endif">
                <div class="container">
                    <div class="product-lists">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="head">
                                        <h4 class="font-weight-bold">{{$homeCategory->category->name}}</h4>
                                    </div>
                                    <div class="navigator"> <a href="{{ route('products.category', $homeCategory->category->slug) }}">See all</a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slider-listing-home">
                                @foreach ($homeCategory->category->subcategories as $sub)
                                
                                    @if (count($sub->products)>0)
                                        <div class="slick-item position-relative">
                                            
                                            <div class="product-grid-item2 d-flex align-items-center mx-2">
                                                <div class="product-grid-image2">
                                                    <a href="{{ route('products.subcategory', $sub->slug) }}">
                                                        <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                            class="img-fluid pic-1"> </a>
                                                </div>


                                                <div class="product-content">
                                                    <ul>
                                                        <li class="title mb-2"><a href="{{ route('products.subcategory', $sub->slug) }}" class=" font-weight-bold" title="{{$sub->name}}">{{$sub->name}}</a></li>
                                                        @foreach ($sub->products as $product)
                                                        <li>
                                                            <a href="{{route('product',$product->slug)}}" title="{{$product->name}}">{{$product->name}}</a>
                                                        </li>
                                                        @endforeach
                                                        
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
        @php
            $i++;
        @endphp
        @endif
    @endif

@endforeach
<!-- Product Listing Ends -->
