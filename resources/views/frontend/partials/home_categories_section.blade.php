<!-- Product Listing -->
@php
    $i=0;
@endphp
@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
    @if ($homeCategory->category != null)
        @if (count($homeCategory->category->products()->where('published',1)->get())>0)
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
                                
                                    @if (count($sub->products()->where('published',1)->get())>0)  

                                        <div class="slick-item position-relative">
                                            
                                            <div class="product-grid-item2 d-flex align-items-center mx-2">
                                                <div class="product-grid-image2 w-50">
                                                    <a href="{{ route('products.subcategory', $sub->slug) }}">
                                                        @if (!empty($sub->icon))
                                                            @if (file_exists($sub->icon))
                                                                <img src="{{asset($sub->icon)}}" alt="img" class="img-fluid pic-1">
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
                                                        <li class="title mb-2"><a href="{{ route('products.subcategory', $sub->slug) }}" class=" font-weight-bold" title="{{$sub->name}}">{{$sub->name}}</a></li>

                                                        @foreach ($sub->products()->where('published',1)->get() as $product)
                                                        @if ($product->expiry_date==null || date('Y-m-d H:i:s') <= $product->expiry_date) 
                                                        <li>
                                                            <a href="{{route('product',$product->slug)}}" title="{{$product->name}}">{{$product->name}}</a>
                                                        </li>
                                                        @endif
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
