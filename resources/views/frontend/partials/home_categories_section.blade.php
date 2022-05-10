<!-- Product Listing -->
@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)

    @if ($homeCategory->category != null)
        @if(\App\Product::where('published', 1)->where('category_id', $homeCategory->category->id))
            @if ($loop->odd)
                <section class="product-listing position-relative py-5 bg-white ">
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
                                <div class="slick-item position-relative pt-3 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative pt-3 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative pt-3 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative pt-3 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative pt-3 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="product-listing position-relative pt-5 bg-light">
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
                                <div class="slick-item position-relative py-4 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative py-4 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative py-4 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative py-4 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-item position-relative py-4 mx-2">
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="https://hm.imimg.com/imhome_gifs/cvid03.png" alt="img"
                                                    class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-grid-item2 d-flex align-items-center">
                                        <div class="product-grid-image2">
                                            <a href="{{ route('products.category', $homeCategory->category->slug) }}">
                                                <img src="http://3.imimg.com/data3/TH/GC/GLADMIN-56254/oxygen-cylinders-125x125.jpg"
                                                    alt="img" class="img-fluid pic-1"> </a>
                                        </div>
                                        <div class="product-content">
                                            <ul>
                                                <li class="title mb-2"><a href="" class=" font-weight-bold">Medical
                                                        Essential ,
                                                        Safety &
                                                        Protective Clothing
                                                        and Apparel</a></li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                                <li>
                                                    <a href="product-detail.html">3 Ply Face Mask</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endif
    @endif
@endforeach
<!-- Product Listing Ends -->