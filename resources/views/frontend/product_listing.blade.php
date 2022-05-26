@extends('frontend.layouts.app')
@if(isset($subsubcategory_id))
    @php
        $meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
        $meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
    @endphp
@elseif (isset($subcategory_id))
    @php
        $meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
        $meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
    @endphp
@elseif (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title = env('APP_NAME');
        $meta_description = \App\SeoSetting::first()->description;
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

    <!-- Breadcrumbs -->
    <section id="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">{{__('All Categories')}}</a></li>
                @if(isset($category_id))
                    <li class="active breadcrumb-item"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{ \App\Category::find($category_id)->name }}</a></li>
                @endif
                @if(isset($subcategory_id))
                    <li class="breadcrumb-item"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                    <li class="active breadcrumb-item"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                @endif
                @if(isset($subsubcategory_id))
                    <li class="breadcrumb-item"><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                    <li class="active breadcrumb-item"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                @endif

            </ol>
        </nav>
    </section>
    <!-- Breadcrumbs Ends -->
    <section id="product-listing-wrapper" class="py-5">
        <div class="container-fluid">
            <form class="" id="search-form" action="{{ route('search') }}" method="GET">
                <div class="product-lists">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="left-side-wrapper d-lg-block d-none">
                                <!-- Content -->
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap  p-2">
                                                <div class="head">
                                                    <h5 class="text-uppercase m-0 text-white">Categories</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-content1">
                                            <div class="card-body p-3">
                                                <ul class="mb-0">
                                                    @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                                                        @foreach(\App\Category::all() as $category)
                                                            <li><div class="item"><a href="{{ route('products.category', $category->slug) }}" class="category-item py-1">{{ __($category->name) }}</a></div></li>
                                                        @endforeach
                                                    @endif
                                                    @if(isset($category_id))
                                                        <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}" class="active">{{ __(\App\Category::find($category_id)->name) }}</a></div></li>
                                                        @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                                                            <li class="child"><div class="item"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{ __($subcategory->name) }}</a></div></li>
                                                        @endforeach
                                                    @endif
                                                    @if(isset($subcategory_id))
                                                        <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->category->name) }}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->name) }}</a></div></li>
                                                        @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                                                            <li class="child"><div class="item"><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></div></li>
                                                        @endforeach
                                                    @endif
                                                    @if(isset($subsubcategory_id))
                                                        <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}" class="active">{{ __(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}" class="active">{{ __(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</a></div></li>
                                                        <li><div class="item"><a href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}" class="current">{{ __(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a></div></li>
                                                    @endif
                                                </ul>
                                                {{-- <div class="collapse" id="expand1" style="">
                                                    <ul>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="item">
                                                                <a href="" class="category-item py-1 ">Cheese Category
                                                                    1</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                            <!-- card-body.// -->
                                        </div>
                                        {{-- <div class="expand">
                                            <a data-toggle="collapse" href="#expand1" role="button" aria-expanded="false"
                                                aria-controls="expand1" class="collapsed">View more</a>
                                        </div> --}}
                                    </div>
                                    <!-- card-group-item.// -->
                                </div>
                                <!-- Content Ends -->
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap  p-2">
                                                <div class="head">
                                                    <h5 class="text-uppercase m-0 text-white">Price Range</h5>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="filter-content1">
                                                <div class="card-body px-3 py-2">
                                                    <div class="range-slider-wrapper mt-3">
                                                        <!-- Range slider container -->
                                                        <div id="input-slider-range" data-range-value-min="{{ filter_products(\App\Product::query())->get()->min('unit_price') }}" data-range-value-max="{{ filter_products(\App\Product::query())->get()->max('unit_price') }}"></div>
            
                                                        <!-- Range slider values -->
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <span class="range-slider-value value-low"
                                                                    @if (isset($min_price))
                                                                        data-range-value-low="{{ $min_price }}"
                                                                    @elseif($products->min('unit_price') > 0)
                                                                        data-range-value-low="{{ $products->min('unit_price') }}"
                                                                    @else
                                                                        data-range-value-low="0"
                                                                    @endif
                                                                    id="input-slider-range-value-low">
                                                                </span>
                                                            </div>
            
                                                            <div class="col-6 text-right">
                                                                <span class="range-slider-value value-high"
                                                                    @if (isset($max_price))
                                                                        data-range-value-high="{{ $max_price }}"
                                                                    @elseif($products->max('unit_price') > 0)
                                                                        data-range-value-high="{{ $products->max('unit_price') }}"
                                                                    @else
                                                                        data-range-value-high="0"
                                                                    @endif
                                                                    id="input-slider-range-value-high">
                                                                </span>
                                                            </div>
                                                            <input class="hidden" type="text" name="min_price">
                                                            <input class="hidden" type="text" name="max_price">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                                @if (!empty($all_colors))
                                    <div class="card-wrapper mt-4 mb-2">
                                        <div class="card-group-item">
                                            <div class="card-head">
                                                <div class="heading d-flex align-items-center text-center flex-wrap p-2">
                                                    <div class="head">
                                                        <h5 class="text-uppercase m-0 text-white">Color</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="colors_block px-3 py-2">
                                                <ul class="list-inline checkbox-color checkbox-color-circle mb-0">
                                                    @foreach ($all_colors as $key => $color)
                                                        <li>
                                                            <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif onchange="filter()">
                                                            <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- card-group-item.// -->
                                    </div>
                                @endif
                                @foreach ($attributes as $key => $attribute)
                                    @if (\App\Attribute::find($attribute['id']) != null)
                                        <div class="card-wrapper mt-4 mb-2">
                                            <div class="card-group-item">
                                                <div class="card-head">
                                                    <div
                                                        class="heading d-flex align-items-center text-center flex-wrap p-2">
                                                        <div class="head">
                                                            <h6 class="text-capitalize m-0 text-white">Choose {{ \App\Attribute::find($attribute['id'])->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="colors_block px-3 py-2">
                                                    @if(array_key_exists('values', $attribute))
                                                        @foreach ($attribute['values'] as $key => $value)
                                                            @php
                                                                $flag = false;
                                                                if(isset($selected_attributes)){
                                                                    foreach ($selected_attributes as $key => $selected_attribute) {
                                                                        if($selected_attribute['id'] == $attribute['id']){
                                                                            
                                                                            if(in_array($value, $selected_attribute['values'])){
                                                                                $flag = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <div class="checkbox">
                                                                <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                                                <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- card-group-item.// -->
                                        </div>
                                    @endif
                                @endforeach
                                <!-- Content -->
                                {{-- <div class="card-wrapper mt-4 mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap p-2">
                                                <div class="head">
                                                    <h5 class="text-uppercase m-0 text-white">Product</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-content2">
                                            <div class="card-body">
                                                <form>
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Chopsop
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Den
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Locus
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Tangi
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Erangi
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <label class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            Brand 3
                                                        </span>
                                                    </label>
                                                    <!-- form-check.// -->
                                                    <div class="collapse show" id="expand2" style="">
                                                        <!-- form-check.// -->
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 3
                                                            </span>
                                                        </label>
                                                        <!-- form-check.// -->
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 3
                                                            </span>
                                                        </label>
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 1
                                                            </span>
                                                        </label>
                                                        <!-- form-check.// -->
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 2
                                                            </span>
                                                        </label>
                                                        <!-- form-check.// -->
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 3
                                                            </span>
                                                        </label>
                                                        <!-- form-check.// -->
                                                        <!-- form-check.// -->
                                                        <label class="form-check d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                Brand 3
                                                            </span>
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- card-body.// -->
                                        </div>
                                        <div class="expand">
                                            <a data-toggle="collapse" href="#expand2" role="button" aria-expanded="true"
                                                aria-controls="expand2" class="">View more</a>
                                        </div>
                                    </div>
                                    <!-- card-group-item.// -->
                                </div> --}}
                                <!-- Content Ends -->
                            </div>
                            <!-- Mobile Filter  -->
                            <!-- Button trigger modal -->
                            <button type="button" class="effect d-xl-none d-lg-none d-md-block mb-4" data-toggle="modal"
                                data-target="#leftsidebarfilter">
                                Product Filter
                                <span class="ml-2">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </span>
                            </button>
                            <!-- Mobile Filter Ends -->
                        </div>
                        
                        <div class="col-lg-9 col-12">
                            
                            <div class="sort-by-bar row no-gutters bg-light mb-3 px-3 pt-2">
                                <div class="col-xl-6 offset-xl-1 ml-auto">
                                    <div class="row no-gutters">
                                        <div class="col-5">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Sort by')}}</label>
                                                    <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                        <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                        <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                        <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                        <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="sort-by-box flex-grow-1">
                                                <div class="form-group">
                                                    <label>{{__('Search')}}</label>
                                                    <div class="search-widget">
                                                        <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
                                                        <button type="submit" class="btn-inner">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-3">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Brands')}}</label>
                                                    <select class="form-control sortSelect" data-placeholder="{{__('All Brands')}}" name="brand" onchange="filter()">
                                                        <option value="">{{__('All Brands')}}</option>
                                                        @foreach (\App\Brand::all() as $brand)
                                                            <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Sellers')}}</label>
                                                    <select class="form-control sortSelect" data-placeholder="{{__('All Sellers')}}" name="seller_id" onchange="filter()">
                                                        <option value="">{{__('All Sellers')}}</option>
                                                        @foreach (\App\Seller::all() as $key => $seller)
                                                            @if ($seller->user != null && $seller->user->shop != null)
                                                                <option value="{{ $seller->id }}" @isset($seller_id) @if ($seller_id == $seller->id) selected @endif @endisset>{{ $seller->user->shop->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Locations')}}</label>
                                                    <select class="form-control sortSelect" data-placeholder="{{__('All Locations')}}" name="location" onchange="filter()">
                                                        <option value="">{{__('All Locations')}}</option>
                                                        @foreach (\App\Location::all() as $location)
                                                            <option value="{{ $location->id }}" @isset($location_id) @if ($location_id == $location->id) selected @endif @endisset>{{ $location->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="right-side-wrapper products-seller w-100">
                                <ul class="products">
                                    @if (isset($products) && !($products->isEmpty()))
                                    @foreach ($products as $key => $product)
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
                                        <li>
                                            <div class="row py-3 mb-3">
                                                <div class="col-lg-12 col-12 post">
                                                    <div
                                                        class="product-grid-item d-flex align-items-center flex-wrap">
                                                        <div class="product-grid-image">
                                                            <a href="{{route('product',$product->slug)}}"> 
                                                                @if(!empty($product->featured_img))
                                                                    @if (file_exists($product->featured_img)) 
                                                                        <img class="img-fluid pic-1" src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                                                    @else
                                                                        <img class="img-fluid pic-1" src="{{ asset('frontend/images/placeholder.jpg') }}"  alt="{{ __($product->name) }}">
                                                                            
                                                                    @endif
                                                                    
                                                                @else
                                                                    <img class="img-fluid pic-1" src="{{ asset('frontend/images/placeholder.jpg') }}"  alt="{{ __($product->name) }}">
                                                                @endif
                                                            </a>
                                                            <ul class="social d-flex">
                                                                <li>
                                                                    @if ($qty > 0)
                                                                        <a class="fa fa-shopping-bag" onclick="showAddToCartModal({{ $product->id }})">
                                                                        </a>

                                                                    @else
                                                                        <a class="fa fa-shopping-bag" disabled>
                                                                        </a>
                                                                    @endif
                                                                    {{-- <a href="" class="fa fa-shopping-bag"></a> --}}
                                                                </li>
                                                                <li>
                                                                    {{-- <a class="fa fa-heart" onclick="successMsg();"></a> --}}
                                                                    <a onclick="addToWishList({{ $product->id }})" class="fa fa-heart"></a>
                                                                </li>
                                                            </ul>
                                                            <!-- <span class="product-discount-label">-20%</span> -->
                                                        </div>
                                                        <div class="product-content ml-3 mt-2">
                                                            <a href="{{route('product',$product->slug)}}" class="title">{{$product->name}}</a>
                                                            <div class="price mb-1">
                                                                @if(home_price($product->id) != home_discounted_price($product->id))
                                                                    <div class="product-price text-dark">
                                                                        <div class="font-weight-bold">{{ home_discounted_price($product->id) }}
                                                                            <span class="piece">/{{ $product->unit }}</span>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <div class="first-price mr-2">{{ home_price($product->id) }}
                                                                                <span>/{{ $product->unit }}</span>
                                                                            </div>
                                                                            <div class="discount">
                                                                                @if (! $product->discount == 0)
                                                                                    <div class="">
                                                                                        -{{ ($product->discount_type == 'amount')?'Rs.':'' }} {{ (intval($product->discount,0)) }}{{ !($product->discount_type == 'amount')?' %':'' }} off
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="product-price text-dark">
                                                                        <div class="font-weight-bold">{{ home_discounted_price($product->id) }}
                                                                        <span class="piece">/{{ $product->unit }}</span>
                                                                        </div> 
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <ul class="other-detail">
                                                                <li>Brand: <span>@if($product->brand)
                                                                    <a href="{{route('products.brand',['brand_slug' => $product->brand->slug])}}">{{$product->brand->name}}</a>
                                                                    @endif</span> </li>
                                                                <li>Category: <span> <a href="{{route('products.category',$product->category->slug)}}">{{$product->category->name}}</a>
                                                                    </span> </li>
                                                                {{-- <li>Weight: <span>Abc</span> </li>
                                                                <li>Type: <span>Hotel, Home, Hospital, Restaurant</span> </li> --}}
                                                            </ul>
                                                            <div class="enterprise mb-2">Sold by: <span
                                                                    class="font-weight-bold">@if ($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                                    <a href="{{ route('shop.visit', $product->user->shop->slug) }}">{{ $product->user->shop->name }}</a>
                                                                @else
                                                                    {{ __('Inhouse product') }}
                                                                @endif</span>
                                                            </div>
                                                            <a href="{{route('product',$product->slug)}}" class="anchor-btn2 mb-3">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-4 col-12 seller-info">
                                                    <div class="seller-info-box p-4">
                                                        <div class="sold-by position-relative">
                                                            <div class="position-absolute medal-badge">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    xml:space="preserve" viewBox="0 0 287.5 442.2">
                                                                    <polygon style="fill:#F8B517;"
                                                                        points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 ">
                                                                    </polygon>
                                                                    <circle style="fill:#FBD303;" cx="143.8" cy="143.8"
                                                                        r="143.8">
                                                                    </circle>
                                                                    <circle style="fill:#F8B517;" cx="143.8" cy="143.8"
                                                                        r="93.6">
                                                                    </circle>
                                                                    <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                                                                                    60,116.6 124.1,116.6 ">
                                                                    </polygon>
                                                                </svg>
                                                            </div>
                                                            <div class="title font-weight-bold">Sold By</div>
                                                            <a href="" class="name d-block font-weight-bold">
                                                                @if ($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                                    <a href="{{ route('shop.visit', $product->user->shop->slug) }}">{{ $product->user->shop->name }}</a>
                                                                @else
                                                                    {{ __('Inhouse product') }}
                                                                @endif
                                                                <span class="ml-2"><i class="fa fa-check-circle"
                                                                        style="color:green"></i></span>
                                                            </a>
                                                            @php
                                                            $total = 0;
                                                            $rating = 0;
                                                            foreach ($product->user->products as $key => $seller_product) {
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
                                                            @if ($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                                <a href="{{ route('shop.visit', $product->user->shop->slug) }}" class="anchor-btn2 mt-2">Visit Store</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </li>
                                    @endforeach
                                    @else
                                    <div class="nothing-wrap d-flex justify-content-center w-100 align-items-center flex-column">
                                        <p class="pt-3">Sorry, Nothing to show here.</p>
                                    </div>
                                    @endif

                                </ul>
                            </div>
                            <div class="col-12 mx-auto text-center">
                                {{-- <button type="button" class="effect mx-auto mt-4">View More</button> --}}
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{-- <section id="product-listing-wrapper" class="py-5">
        <div class="container-fluid">
            <form class="" id="search-form" action="{{ route('search') }}" method="GET">
                <div class="product-lists">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="left-side-wrapper d-lg-block d-none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-wrapper mb-2">
                                            <div class="card-group-item">
                                                <div class="card-head">
                                                    <div
                                                        class="heading d-flex align-items-center text-center flex-wrap">
                                                        <div class="head">
                                                            <h6 class="text-capitalize m-0">Choose Category</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="filter-content1">
                                                    <div class="card-body px-3 py-2">
                                                        <ul class="mb-0">
                                                            @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                                                                @foreach(\App\Category::all() as $category)
                                                                    <li><div class="item"><a href="{{ route('products.category', $category->slug) }}" class="category-item py-1">{{ __($category->name) }}</a></div></li>
                                                                @endforeach
                                                            @endif
                                                            @if(isset($category_id))
                                                                <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}" class="active">{{ __(\App\Category::find($category_id)->name) }}</a></div></li>
                                                                @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                                                                    <li class="child"><div class="item"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{ __($subcategory->name) }}</a></div></li>
                                                                @endforeach
                                                            @endif
                                                            @if(isset($subcategory_id))
                                                                <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->category->name) }}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->name) }}</a></div></li>
                                                                @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                                                                    <li class="child"><div class="item"><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></div></li>
                                                                @endforeach
                                                            @endif
                                                            @if(isset($subsubcategory_id))
                                                                <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}" class="active">{{ __(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}" class="active">{{ __(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</a></div></li>
                                                                <li><div class="item"><a href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}" class="current">{{ __(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a></div></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <!-- card-body.// -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-wrapper my-2">
                                            <div class="card-group-item">
                                                <div class="card-head">
                                                    <div class="heading d-flex align-items-center text-center flex-wrap">
                                                        <div class="head">
                                                            <h6 class="text-capitalize m-0">{{__('Price range')}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="filter-content1">
                                                    <div class="card-body px-3 py-2">
                                                        <div class="range-slider-wrapper mt-3">
                                                            <!-- Range slider container -->
                                                            <div id="input-slider-range" data-range-value-min="{{ filter_products(\App\Product::query())->get()->min('unit_price') }}" data-range-value-max="{{ filter_products(\App\Product::query())->get()->max('unit_price') }}"></div>
                
                                                            <!-- Range slider values -->
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <span class="range-slider-value value-low"
                                                                        @if (isset($min_price))
                                                                            data-range-value-low="{{ $min_price }}"
                                                                        @elseif($products->min('unit_price') > 0)
                                                                            data-range-value-low="{{ $products->min('unit_price') }}"
                                                                        @else
                                                                            data-range-value-low="0"
                                                                        @endif
                                                                        id="input-slider-range-value-low">
                                                                </div>
                
                                                                <div class="col-6 text-right">
                                                                    <span class="range-slider-value value-high"
                                                                        @if (isset($max_price))
                                                                            data-range-value-high="{{ $max_price }}"
                                                                        @elseif($products->max('unit_price') > 0)
                                                                            data-range-value-high="{{ $products->max('unit_price') }}"
                                                                        @else
                                                                            data-range-value-high="0"
                                                                        @endif
                                                                        id="input-slider-range-value-high">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-wrapper my-2">
                                            <div class="card-group-item">
                                                <div class="card-head">
                                                    <div
                                                        class="heading d-flex align-items-center text-center flex-wrap">
                                                        <div class="head">
                                                            <h6 class="text-capitalize m-0">Product Rating</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="px-3 py-2">
                                                    <ul class="mb-0">
                                                        @for ($i = 1; $i <= 5; $i++)     
                                                        <li>
                                                            <input type="radio" name="rating" value="{{$i}}" onchange="filter()" title="{{$i}} star" />
                                                            
                                                            @for ($j = 1; $j <= $i; $j++)   
                                                                <label class="fa fa-star fa-2x" for="star{{$i}}" title="{{$i}} star" aria-hidden="true"></label>
                                                            @endfor

                                                        </li>
                                                        @endfor

                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- card-group-item.// -->
                                        </div>
                                    </div>

                                    @if (!empty($all_colors))
                                        <div class="col-12">
                                            <div class="card-wrapper my-2">
                                                <div class="card-group-item">
                                                    <div class="card-head">
                                                        <div
                                                            class="heading d-flex align-items-center text-center flex-wrap">
                                                            <div class="head">
                                                                <h6 class="text-capitalize m-0">Choose Color</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="colors_block px-3 py-2">
                                                        <ul class="list-inline checkbox-color checkbox-color-circle mb-0">
                                                            @foreach ($all_colors as $key => $color)
                                                                <li>
                                                                    <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif onchange="filter()">
                                                                    <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- card-group-item.// -->
                                            </div>
                                        </div>
                                    @endif


                                    @foreach ($attributes as $key => $attribute)
                                        @if (\App\Attribute::find($attribute['id']) != null)
                                            <div class="col-12">
                                                <div class="card-wrapper my-2">
                                                    <div class="card-group-item">
                                                        <div class="card-head">
                                                            <div
                                                                class="heading d-flex align-items-center text-center flex-wrap">
                                                                <div class="head">
                                                                    <h6 class="text-capitalize m-0">Choose {{ \App\Attribute::find($attribute['id'])->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="colors_block px-3 py-2">
                                                            @if(array_key_exists('values', $attribute))
                                                                @foreach ($attribute['values'] as $key => $value)
                                                                    @php
                                                                        $flag = false;
                                                                        if(isset($selected_attributes)){
                                                                            foreach ($selected_attributes as $key => $selected_attribute) {
                                                                                if($selected_attribute['id'] == $attribute['id']){
                                                                                    if(in_array($value, $selected_attribute['values'])){
                                                                                        $flag = true;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <div class="checkbox">
                                                                        <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                                                        <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- card-group-item.// -->
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn-custom d-xl-none d-lg-none d-md-block mb-4"
                            data-toggle="modal" data-target="#leftsidebarfilter">
                                Product Filter
                                <span class="ml-2">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                        <div class="col-lg-9 col-12">
                            <!-- <div class="bg-white"> -->
                                @isset($category_id)
                                    <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">
                                @endisset
                                @isset($subcategory_id)
                                    <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">
                                @endisset
                                @isset($subsubcategory_id)
                                    <input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">
                                @endisset

                                <div class="sort-by-bar row no-gutters bg-white mb-3 px-3 pt-2">
                                    <div class="col-xl-4 d-flex d-xl-block justify-content-between align-items-end ">
                                        <div class="sort-by-box flex-grow-1">
                                            <div class="form-group">
                                                <label>{{__('Search')}}</label>
                                                <div class="search-widget">
                                                    <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
                                                    <button type="submit" class="btn-inner">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 offset-xl-1">
                                        <div class="row no-gutters">
                                            <div class="col-3">
                                                <div class="sort-by-box px-1">
                                                    <div class="form-group">
                                                        <label>{{__('Sort by')}}</label>
                                                        <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                            <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                            <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                            <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                            <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="sort-by-box px-1">
                                                    <div class="form-group">
                                                        <label>{{__('Brands')}}</label>
                                                        <select class="form-control sortSelect" data-placeholder="{{__('All Brands')}}" name="brand" onchange="filter()">
                                                            <option value="">{{__('All Brands')}}</option>
                                                            @foreach (\App\Brand::all() as $brand)
                                                                <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="sort-by-box px-1">
                                                    <div class="form-group">
                                                        <label>{{__('Sellers')}}</label>
                                                        <select class="form-control sortSelect" data-placeholder="{{__('All Sellers')}}" name="seller_id" onchange="filter()">
                                                            <option value="">{{__('All Sellers')}}</option>
                                                            @foreach (\App\Seller::all() as $key => $seller)
                                                                @if ($seller->user != null && $seller->user->shop != null)
                                                                    <option value="{{ $seller->id }}" @isset($seller_id) @if ($seller_id == $seller->id) selected @endif @endisset>{{ $seller->user->shop->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="sort-by-box px-1">
                                                    <div class="form-group">
                                                        <label>{{__('Locations')}}</label>
                                                        <select class="form-control sortSelect" data-placeholder="{{__('All Locations')}}" name="location" onchange="filter()">
                                                            <option value="">{{__('All Locations')}}</option>
                                                            @foreach (\App\Location::all() as $location)
                                                                <option value="{{ $location->id }}" @isset($location_id) @if ($location_id == $location->id) selected @endif @endisset>{{ $location->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="min_price" value="">
                                <input type="hidden" name="max_price" value="">
                                <!-- <hr class=""> -->
                                <div class="row right-side-wrapper">
                                    <div class="grid-container">
                                        @foreach ($products as $key => $product)
                                        <div class="grid-item">
                                            <div class="product-grid-item">
                                                <div class="product-grid-image">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        @if(!empty($product->photos))
                                                            @if (count(json_decode($product->photos))>0)
                                                                @if (file_exists(json_decode($product->photos)[0]))
                                                                        
                                                                    <img class="pic-1 img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset(json_decode($product->photos)[0]) }}" alt="{{ __($product->name) }}">
                                                                @else
                                                                    <img class="pic-1 img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}"  alt="{{ __($product->name) }}">
                                                                        
                                                                @endif
                                                                
                                                            @else
                                                            <img class="pic-1 img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}"  alt="{{ __($product->name) }}">

                                                            @endif
                                                        @else
                                                        <img class="pic-1 img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}"  alt="{{ __($product->name) }}">

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
                                                
                                                <div class="price-cart text-center py-2">
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
                                                                            {{ ($product->discount_type == 'amount')?'  Rs.':'' }} -{{ intval(($product->discount)) }}{{ !($product->discount_type == 'amount')?' %':'' }}
                                        
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
                                                                
                                                                <a class="all-deals ico effect" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-placement="right"
                                                                    title="Add to Cart"><i class="fa fa-shopping-cart icon"></i> </a>

                                                            </div>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cart-compare">
                                                    <a class="all-deals effect gray" href="javasctipy:void(0);" onclick="addToWishList({{$product->id}})"
                                                        ><i class="fa fa-heart icon mr-2"></i>Wishlist
                                                    </a>
                                                    <a class="all-deals effect gray" onclick="addToCompare({{$product->id}})">
                                                    <i class="fa fa-exchange icon mr-2"></i>Compare
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="products-pagination bg-white p-3">
                                    <nav aria-label="Center aligned pagination">
                                        <ul class="pagination justify-content-center">
                                            {{ $products->links() }}
                                        </ul>
                                    </nav>
                                </div>

                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section> --}}

               <!-- Mobile Filter Pop Up -->
   <!-- Modal -->
    <div class="modal fade" id="leftsidebarfilter" tabindex="-1" role="dialog" aria-labelledby="leftsidebarfilterlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftsidebarfilterlabel">
                    Filter Products 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="left-side-wrapper px-4 py-4">
                        <!-- Content -->
                        <div class="card-wrapper mb-2">
                            <div class="card-group-item">
                                <div class="card-head">
                                    <div class="heading d-flex align-items-center text-center flex-wrap">
                                    <div class="head">
                                        <h5 class="text-uppercase pl-5 m-0">Categories</h5>
                                    </div>
                                    </div>
                                </div>
                                <div class="filter-content1">
                                    <div class="card-body p-3">
                                    <ul class="mb-0">
                                        @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                                            @foreach(\App\Category::all() as $category)
                                                <li><div class="item"><a href="{{ route('products.category', $category->slug) }}" class="category-item py-1">{{ __($category->name) }}</a></div></li>
                                            @endforeach
                                        @endif
                                        @if(isset($category_id))
                                            <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}" class="active">{{ __(\App\Category::find($category_id)->name) }}</a></div></li>
                                            @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                                                <li class="child"><div class="item"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{ __($subcategory->name) }}</a></div></li>
                                            @endforeach
                                        @endif
                                        @if(isset($subcategory_id))
                                            <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->category->name) }}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}" class="active">{{ __(\App\SubCategory::find($subcategory_id)->name) }}</a></div></li>
                                            @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                                                <li class="child"><div class="item"><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></div></li>
                                            @endforeach
                                        @endif
                                        @if(isset($subsubcategory_id))
                                            <li><div class="item"><a href="{{ route('products') }}" class="active">{{__('All Categories')}}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}" class="active">{{ __(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}" class="active">{{ __(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</a></div></li>
                                            <li><div class="item"><a href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}" class="current">{{ __(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a></div></li>
                                        @endif

                                    </ul>
                                    </div>
                                    <!-- card-body.// -->
                                </div>
                            </div>
                            <!-- card-group-item.// -->
                        </div>
                        <!-- Content -->

                        
                        <!-- Content -->
                        @if (!empty($all_colors))
                            <div class="card-wrapper mb-2">
                                <div class="card-group-item">
                                    <div class="card-head">
                                        <div class="heading d-flex align-items-center text-center flex-wrap">
                                        <div class="head">
                                            <h5 class="text-uppercase pl-5 m-0">Choose Color</h5>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="colors_block px-3 py-2">
                                        <ul class="list-inline checkbox-color checkbox-color-circle mb-0">
                                            @foreach ($all_colors as $key => $color)
                                                <li>
                                                    <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif onchange="filter()">
                                                    <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- card-group-item.// -->
                            </div>
                        @endif
                        <!-- Content -->
                        {{-- @foreach ($attributes as $key => $attribute)
                            @if (\App\Attribute::find($attribute['id']) != null)
                                <div class="card-wrapper mt-4 mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div
                                                class="heading d-flex align-items-center text-center flex-wrap">
                                                <div class="head">
                                                    <h6 class="text-capitalize m-0">Choose {{ \App\Attribute::find($attribute['id'])->name }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colors_block px-3 py-2">
                                            @if(array_key_exists('values', $attribute))
                                                @foreach ($attribute['values'] as $key => $value)
                                                    @php
                                                        $flag = false;
                                                        if(isset($selected_attributes)){
                                                            foreach ($selected_attributes as $key => $selected_attribute) {
                                                                if($selected_attribute['id'] == $attribute['id']){
                                                                    if(in_array($value, $selected_attribute['values'])){
                                                                        $flag = true;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                                        <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!-- card-group-item.// -->
                                </div>
                            @endif
                        @foreach --}}
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    </div> -->
            </div>
        </div>
    </div>
<!-- Mobile Filter Pop Up Ends -->

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            console.log(arg[0],arg[1]);
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
        
    </script>
@endsection
