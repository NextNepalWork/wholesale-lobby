@php
$generalsetting = \App\GeneralSetting::first();
@endphp
  <!-- Popup Search Modal -->
    <!-- Modal -->
    <div class="modal fade" id="searchpopupmodal" tabindex="-1" role="dialog" aria-labelledby="searchpopupmodallabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchpopupmodallabel">Search your favourite item here !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('search') }}" method="GET" class="d-flex">
                        <input class="input_box" type="text" aria-label="Search" id="search_mob" name="q" placeholder="Search..." autocomplete="off"/>
                        
                    </form>
                    <div class="type-search-box d-none">
                        <div class="search-preloader">
                            <div class="loader">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="search-nothing d-none">
                        </div>
                        <div id="mob_search-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup Search Modal Ends-->
    <!-- Nav Cart Pop Up -->
    <div class="modal fade" id="nav-cart" tabindex="-1" role="dialog" aria-labelledby="navcartlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-auto" id="navcartlabel"> <span class="mr-2"><i class="fa fa-opencart"
                                aria-hidden="true"></i></span> Cart List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if (Session::has('cart'))
                    
                    @if(count($cart = Session::get('cart')) > 0)
                    @php
                        $total = 0;
                    @endphp

                    <div class="modal-body">
                        <table class="w-100">
                            <tbody>
                                @foreach($cart as $key => $cartItem)
                                <tr>
                                    @php
                                    $product = \App\Product::find($cartItem['id']);
                                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                                    @endphp
                                    <td class="pr-4 py-3">
                                        @if (file_exists($product->featured_img)) 
                                            <img src="{{ asset($product->featured_img) }}" data-src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}">
                                        @else
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name) }}">
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{route('product',$product->slug)}}">
                                            <div class="head font-weight-bold">
                                                {{$product->name}} x <span class="cart-quantity">{{ $cartItem['quantity'] }}</span>
                                            </div>
                                            <div class="price">
                                                {{ single_price($cartItem['price']*$cartItem['quantity']) }}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a class="btn"> 
                                          <span><i class="fa fa-trash" aria-hidden="true" onclick="removeFromCart({{ $key }})"></i></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer flex-column">
                        <div class="total-amount pb-3 text-center d-block">
                            Total : <span class="font-weight-bold">{{ single_price($total) }}</span>
                        </div>
                        <div class="d-flex justify-content-around align-items-center w-100">
                            <a href="{{ route('cart') }}" type="button" class="effect m-auto">View Cart</a>
                            @if (Auth::check())
                            <a href="{{ route('checkout.shipping_info') }}" type="button" class="effect m-auto ">Proceed Checkout</a>
                            </a>
                            @endif

                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <h6 class="">{{__('Your Cart is empty')}}</h6>
                    </div>
                    @endif
                @else
                <div class="text-center">
                    <h6 class="">{{__('Your Cart is empty')}}</h6>
                 </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Nav Cart Pop Up Ends -->


    <!-- Mobile Filter Pop Up -->
    <!-- Modal -->
    <div class="modal fade" id="leftsidebarfilter" tabindex="-1" role="dialog" aria-labelledby="leftsidebarfilterlabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leftsidebarfilterlabel">Product Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="left-side-wrapper px-4 py-4">
                        <div class="row">
                            <!-- Content -->
                            <div class="col-12">
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap">
                                                <div class="head">
                                                    <h5 class="text-capitalize">Range</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-content2 mt-3">
                                            <div class="card-body">
                                                <div class="slider slider-horizontal" id="range-slider">
                                                    <div class="tooltip tooltip-min bs-tooltip-top show">
                                                        <div class="arrow"></div>
                                                        <div class="tooltip-inner">0</div>
                                                    </div>
                                                    <div class="tooltip tooltip-max bs-tooltip-top show"
                                                        style="left: 95.5%;">
                                                        <div class="arrow"></div>
                                                        <div class="tooltip-inner">10000</div>
                                                    </div>
                                                    <input type="range" class="slider d-block w-100" value="5"
                                                        data-slider-min="1" data-slider-max="1000" data-slider-step="1"
                                                        data-slider-value="5" data-slider-orientation="horizontal"
                                                        data-slider-enabled="true" data-slider-selection="after"
                                                        data-slider-tooltip="always" data-slider-range="true" />
                                                </div>
                                                <!-- card-body.// -->
                                            </div>
                                        </div>
                                        <!-- card-group-item.// -->
                                    </div>
                                </div>
                            </div>
                            <!-- Content Ends -->
                            <div class="col-12">
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap">
                                                <div class="head">
                                                    <h5 class="text-capitalize">Brands</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="our_brand-2 pt-3">
                                            <div class="our_brand_item">
                                                <img src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div class="our_brand_item">
                                                <img src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                                                    class="img-fluid" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card-group-item.// -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap">
                                                <div class="head">
                                                    <h5 class="text-capitalize">Choose Color</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colors_block p-3">
                                            <label class="color_single"><small class="round"></small>
                                                <span class=""> Red</span>
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <small class="round bg-warning"></small>
                                                <span> Yellow</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <small class="round bg-primary"></small>
                                                <span>Blue</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <small class="round bg-success"></small>
                                                <span> Green</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- card-group-item.// -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card-wrapper mb-2">
                                    <div class="card-group-item">
                                        <div class="card-head">
                                            <div class="heading d-flex align-items-center text-center flex-wrap">
                                                <div class="head">
                                                    <h5 class="text-capitalize">Choose Size</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colors_block p-3">
                                            <label class="color_single">
                                                <span> Small</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <span> Medium</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <span>Large</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <span> XL</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="color_single">
                                                <span> XXL</span>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- card-group-item.// -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
        </div> -->
            </div>
        </div>
    </div>
    <!-- Mobile Filter Pop Up Ends -->
    <!-- Mobile Nav -->
    <div class="modal fade" id="rightsidebarfilter" tabindex="-1" role="dialog"
        aria-labelledby="rightsidebarfilterlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content h-100">
                <div class="modal-header px-3 py-3 align-items-center">
                    <div class="cart-wishlist">
                        <div class="image">
                            <a class="navbar-brand" href="{{route('home')}}">
                                @if($generalsetting->logo != null)
                                    <img src="{{ asset($generalsetting->logo) }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
                                @else
                                    <img src="{{ asset('frontend/assets/images/comingsoon.png') }}"  class="img-fluid" alt="{{ env('APP_NAME') }}">
                                @endif
                            </a>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body d-flex justify-content-between h-100 px-4">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link {{ areActiveRoutesHome(['home'])}}" href="{{route('home')}}"> <span class="nav-indication mr-2"><i
                                        class="fa fa-eercast" aria-hidden="true"></i></span> Home</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link add-on {{ areActiveRoutesHome(['cart'])}}" href="{{route('cart')}}">
                                <span class="nav-indication mr-2">
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                </span>
                                My Cart
                                <span class="mx-2">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                </span>
                                @if(Session::has('cart'))
                                    <sup class="cart-items text-white" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</sup>
                                @else
                                    <sup class="cart-items text-white" id="cart_items_sidenav">0</sup>
                                @endif
                            </a>
                        </li>
                        <li class=" nav-item d-flex align-items-center">
                            <a class="nav-link add-on {{ areActiveRoutesHome(['wishlists.index'])}}" href="{{route('wishlists.index')}}">
                                <span class="nav-indication mr-2"><i class="fa fa-eercast"
                                        aria-hidden="true"></i></span>Wishlist <span class="mx-2"><i
                                        class="fa fa-heart-o" aria-hidden="true"></i></span> 
                                    @if(Auth::check())
                                        <sup class="cart-items text-white">{{ count(Auth::user()->wishlists)}}</sup>
                                    @else
                                        <sup class="cart-items text-white">0</sup>
                                    @endif
                            </a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link {{ areActiveRoutesHome(['profile'])}}" href="{{route('profile')}}"> <span class="nav-indication mr-2">
                                <i class="fa fa-eercast" aria-hidden="true"></i></span> Manage Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ areActiveRoutesHome(['purchase_history.index'])}}" href="{{route('purchase_history.index')}}"> <span class="nav-indication mr-2">
                                <i class="fa fa-eercast" aria-hidden="true"></i></span>Purchase History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])}}" href="{{route('support_ticket.index')}}"> <span class="nav-indication mr-2">
                                <i class="fa fa-eercast" aria-hidden="true"></i></span>Support Ticket</a>
                        </li>
                        @endauth
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="nav-indication mr-2"><i class="fa fa-eercast"
                                        aria-hidden="true"></i></span>Products<span class="ml-1">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="container d-block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 29</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 27</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 39</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 4</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 2</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 3</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 4</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                    </div>
                                </div>
                                <!--  /.container  -->
                            </div>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="nav-indication mr-2"><i class="fa fa-eercast"
                                        aria-hidden="true"></i></span>Category<span class="ml-1">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="container d-block">
                                    <div class="row">
                                        @foreach (\App\Category::all() as $key => $category)
                                            
                                        
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="dropdown-submenu">
                                                    <a class="test nav-link head font-weight-bold" tabindex="-1" href="#">{{$category->name}}<span class="caret"></span></a>
                                                    {{-- <a class="nav-link head font-weight-bold"
                                                        href="{{ route('products.category', $category->slug) }}">{{$category->name}}</a> --}}
                                                    <ul class="dropdown-menu">
                                                        @foreach ($category->subcategories as $sub)
                                                        <li class="nav-item p-0">
                                                            <a class="nav-link" href="{{ route('products.subcategory', $sub->slug) }}">{{$sub->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                                <!--  /.container  -->
                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="nav-indication mr-2"><i class="fa fa-eercast"
                                        aria-hidden="true"></i></span> Recipes<span class="ml-1">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="container d-block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 29</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 27</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 39</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 4</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 2</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 3</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                        <div class="col-md-12">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="under-construction.html">Heading 4</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 1</a>
                                                </li>
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="under-construction.html">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.col-md-12  -->
                                    </div>
                                </div>
                                <!--  /.container  -->
                            </div>
                        </li> --}}
                    </ul>
                </div>
                <div class="modal-footer py-3">
                    @auth
                        <a class="w-50 text-center text-white" href="{{route('dashboard')}}"> <span class="mr-2"><i class="fa fa-home" aria-hidden="true"></i></span>Dashboard</a>
                        <a class="w-50 text-center text-white" href="{{route('logout')}}"> <span class="mr-2"><i class="fa fa-sign-in" aria-hidden="true"></i></span>Logout</a>
                    @else
                        <a class="w-50 text-center text-white" href="{{route('user.login')}}"> <span class="mr-2"><i class="fa fa-sign-in" aria-hidden="true"></i></span>Login</a>
                        <a class="w-50 text-center text-white" href="{{route('user.registration')}}"> <span class="mr-2"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>Register</a>
                    @endauth

                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Nav -->
    <!-- Mobile Profile Nav Pop Up -->
    <div class="modal fade" id="profilemobilenav" tabindex="-1" role="dialog" aria-labelledby="profilemobilenavtitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content h-100  border-0">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="profilemobilenavtitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body d-flex align-items-center justify-content-around h-100 w-100 p-0">
                    <div class="dashboard-list2 px-2 py-0">
                        <div class="d-user-avater text-center mb-4">
                            <img src="frontend/assets/images/product-images/1.jpg" class="img-fluid avater"
                                alt="profile-image">
                            <h5>Adam Harshvardhan</h5>
                            <a href=""> <span class="mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                Upload
                                Image
                            </a>
                        </div>
                        <ul class="sidebar">
                            <li class="active mb-3 p-2">
                                <a href="dashboard-profile.html"><span class="mr-2"><i class="fa fa-user"
                                            aria-hidden="true"></i></span>Profile</a>
                            </li>
                            <li class="mb-3 p-2">
                                <a href="dashboard-order-status.html"><span class="mr-2"><i class="fa fa-sort"
                                            aria-hidden="true"></i></span>Order Status</a>
                            </li>
                            <li class="mb-3 p-2">
                                <a href="dashboard-cart.html"><span class="mr-2"><i class="fa fa-shopping-bag"
                                            aria-hidden="true"></i></span>My Cart</a>
                            </li>
                            <li class="mb-3 p-2">
                                <a href="dashboard-wishlist.html"><span class="mr-2"><i class="fa fa-shopping-bag"
                                            aria-hidden="true"></i></span>Wishlist</a>
                            </li>
                            <li class="mb-3 p-2">
                                <a href="dashboard-change-password.html"><span class="mr-2"><i class="fa fa-lock"
                                            aria-hidden="true"></i></span>Change Password</a>
                            </li>
                            <li class="mb-3 p-2">
                                <a href="index.html"><span class="mr-2"><i class="fa fa-sign-out"
                                            aria-hidden="true"></i></span>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Mobile Profile Nav Pop Up Ends -->
    <!-- CREATE TICKET MODAL START  -->
    <!-- Modal -->
    <div class="modal fade" id="suport_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">Create a Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body px-3 pt-3">
                    <form class="" action="/support_ticket" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="SOUEs7EpD3Sp4seTV9xMj87IxCMKkbRA1I3iF59R">
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-3" name="subject" placeholder="Subject"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Provide a detailed description <span class="text-danger">*</span></label>
                            <div contenteditable="false"
                                class="jodit_container jodit_default_theme jodit_toolbar_size-middle jodit_wysiwyg_mode"
                                style="min-height: 200px; min-width: 200px; max-width: 100%; height: auto; width: auto;">
                                <ul class="jodit_toolbar">
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-bold">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_bold">
                                                    <path
                                                        d="M747 1521q74 32 140 32 376 0 376-335 0-114-41-180-27-44-61.5-74t-67.5-46.5-80.5-25-84-10.5-94.5-2q-73 0-101 10 0 53-.5 159t-.5 158q0 8-1 67.5t-.5 96.5 4.5 83.5 12 66.5zm-14-746q42 7 109 7 82 0 143-13t110-44.5 74.5-89.5 25.5-142q0-70-29-122.5t-79-82-108-43.5-124-14q-50 0-130 13 0 50 4 151t4 152q0 27-.5 80t-.5 79q0 46 1 69zm-541 889l2-94q15-4 85-16t106-27q7-12 12.5-27t8.5-33.5 5.5-32.5 3-37.5.5-34v-65.5q0-982-22-1025-4-8-22-14.5t-44.5-11-49.5-7-48.5-4.5-30.5-3l-4-83q98-2 340-11.5t373-9.5q23 0 68.5.5t67.5.5q70 0 136.5 13t128.5 42 108 71 74 104.5 28 137.5q0 52-16.5 95.5t-39 72-64.5 57.5-73 45-84 40q154 35 256.5 134t102.5 248q0 100-35 179.5t-93.5 130.5-138 85.5-163.5 48.5-176 14q-44 0-132-3t-132-3q-106 0-307 11t-231 12z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-underline">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_underline">
                                                    <path
                                                        d="M176 223q-37-2-45-4l-3-88q13-1 40-1 60 0 112 4 132 7 166 7 86 0 168-3 116-4 146-5 56 0 86-2l-1 14 2 64v9q-60 9-124 9-60 0-79 25-13 14-13 132 0 13 .5 32.5t.5 25.5l1 229 14 280q6 124 51 202 35 59 96 92 88 47 177 47 104 0 191-28 56-18 99-51 48-36 65-64 36-56 53-114 21-73 21-229 0-79-3.5-128t-11-122.5-13.5-159.5l-4-59q-5-67-24-88-34-35-77-34l-100 2-14-3 2-86h84l205 10q76 3 196-10l18 2q6 38 6 51 0 7-4 31-45 12-84 13-73 11-79 17-15 15-15 41 0 7 1.5 27t1.5 31q8 19 22 396 6 195-15 304-15 76-41 122-38 65-112 123-75 57-182 89-109 33-255 33-167 0-284-46-119-47-179-122-61-76-83-195-16-80-16-237v-333q0-188-17-213-25-36-147-39zm1488 1409v-64q0-14-9-23t-23-9h-1472q-14 0-23 9t-9 23v64q0 14 9 23t23 9h1472q14 0 23-9t9-23z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-italic">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_italic">
                                                    <path
                                                        d="M384 1662l17-85q6-2 81.5-21.5t111.5-37.5q28-35 41-101 1-7 62-289t114-543.5 52-296.5v-25q-24-13-54.5-18.5t-69.5-8-58-5.5l19-103q33 2 120 6.5t149.5 7 120.5 2.5q48 0 98.5-2.5t121-7 98.5-6.5q-5 39-19 89-30 10-101.5 28.5t-108.5 33.5q-8 19-14 42.5t-9 40-7.5 45.5-6.5 42q-27 148-87.5 419.5t-77.5 355.5q-2 9-13 58t-20 90-16 83.5-6 57.5l1 18q17 4 185 31-3 44-16 99-11 0-32.5 1.5t-32.5 1.5q-29 0-87-10t-86-10q-138-2-206-2-51 0-143 9t-121 11z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-separator"></li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-ul">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_ul">
                                                    <path
                                                        d="M384 1408q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm0-512q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm1408 416v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5zm-1408-928q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm1408 416v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5zm0-512v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-ol">
                                        <a>
                                            <span>
                                                <svg role="img" viewBox="0 0 1792 1792"
                                                    class="jodit_icon jodit_icon_ol">
                                                    <path
                                                        d="M381 1620q0 80-54.5 126t-135.5 46q-106 0-172-66l57-88q49 45 106 45 29 0 50.5-14.5t21.5-42.5q0-64-105-56l-26-56q8-10 32.5-43.5t42.5-54 37-38.5v-1q-16 0-48.5 1t-48.5 1v53h-106v-152h333v88l-95 115q51 12 81 49t30 88zm2-627v159h-362q-6-36-6-54 0-51 23.5-93t56.5-68 66-47.5 56.5-43.5 23.5-45q0-25-14.5-38.5t-39.5-13.5q-46 0-81 58l-85-59q24-51 71.5-79.5t105.5-28.5q73 0 123 41.5t50 112.5q0 50-34 91.5t-75 64.5-75.5 50.5-35.5 52.5h127v-60h105zm1409 319v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-14 9-23t23-9h1216q13 0 22.5 9.5t9.5 22.5zm-1408-899v99h-335v-99h107q0-41 .5-122t.5-121v-12h-2q-8 17-50 54l-71-76 136-127h106v404h108zm1408 387v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-14 9-23t23-9h1216q13 0 22.5 9.5t9.5 22.5zm0-512v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-separator"></li>
                                    <li class="jodit_toolbar_btn jodit_with_dropdownlist jodit_toolbar_btn-paragraph">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_paragraph">
                                                    <path
                                                        d="M1534 189v73q0 29-18.5 61t-42.5 32q-50 0-54 1-26 6-32 31-3 11-3 64v1152q0 25-18 43t-43 18h-108q-25 0-43-18t-18-43v-1218h-143v1218q0 25-17.5 43t-43.5 18h-108q-26 0-43.5-18t-17.5-43v-496q-147-12-245-59-126-58-192-179-64-117-64-259 0-166 88-286 88-118 209-159 111-37 417-37h479q25 0 43 18t18 43z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="jodit_with_dropdownlist-trigger"></span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-separator"></li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-undo jodit_disabled"
                                        disabled="disabled">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_undo">
                                                    <path
                                                        d="M1664 896q0 156-61 298t-164 245-245 164-298 61q-172 0-327-72.5t-264-204.5q-7-10-6.5-22.5t8.5-20.5l137-138q10-9 25-9 16 2 23 12 73 95 179 147t225 52q104 0 198.5-40.5t163.5-109.5 109.5-163.5 40.5-198.5-40.5-198.5-109.5-163.5-163.5-109.5-198.5-40.5q-98 0-188 35.5t-160 101.5l137 138q31 30 14 69-17 40-59 40h-448q-26 0-45-19t-19-45v-448q0-42 40-59 39-17 69 14l130 129q107-101 244.5-156.5t284.5-55.5q156 0 298 61t245 164 164 245 61 298z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="jodit_toolbar_btn jodit_toolbar_btn-redo jodit_disabled"
                                        disabled="disabled">
                                        <a>
                                            <span>
                                                <svg viewBox="0 0 1792 1792" class="jodit_icon jodit_icon_redo">
                                                    <path
                                                        d="M1664 256v448q0 26-19 45t-45 19h-448q-42 0-59-40-17-39 14-69l138-138q-148-137-349-137-104 0-198.5 40.5t-163.5 109.5-109.5 163.5-40.5 198.5 40.5 198.5 109.5 163.5 163.5 109.5 198.5 40.5q119 0 225-52t179-147q7-10 23-12 14 0 25 9l137 138q9 8 9.5 20.5t-7.5 22.5q-109 132-264 204.5t-327 72.5q-156 0-298-61t-245-164-164-245-61-298 61-298 164-245 245-164 298-61q147 0 284.5 55.5t244.5 156.5l130-129q29-31 70-14 39 17 39 59z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div contenteditable="false" class="jodit_workplace" style="min-height: 200px;">
                                    <div class="jodit_progress_bar">
                                        <div></div>
                                    </div>
                                    <div class="jodit_error_box_for_messages"></div>
                                    <div class="jodit_wysiwyg" contenteditable="" aria-disabled="false" tabindex="-1"
                                        spellcheck="true" style="min-height: 198px;"></div>
                                    <span
                                        style="display: block; font-size: 14px; line-height: 21px; margin-top: 0px; margin-left: 0px;"
                                        class="jodit_placeholder">Type your reply</span>
                                    <div class="jodit_source">
                                        <div class="jodit_source_mirror-fake ace_editor ace-idle-fingers ace_dark">
                                            <textarea class="ace_text-input" wrap="off" autocorrect="off"
                                                autocapitalize="off" spellcheck="false" style="opacity: 0;"></textarea>
                                            <div class="ace_gutter" aria-hidden="true">
                                                <div class="ace_layer ace_gutter-layer ace_folding-enabled"></div>
                                                <div class="ace_gutter-active-line"></div>
                                            </div>
                                            <div class="ace_scroller">
                                                <div class="ace_content">
                                                    <div class="ace_layer ace_print-margin-layer">
                                                        <div class="ace_print-margin"
                                                            style="left: 4px; visibility: visible;"></div>
                                                    </div>
                                                    <div class="ace_layer ace_marker-layer"></div>
                                                    <div class="ace_layer ace_text-layer" style="padding: 0px 4px;">
                                                    </div>
                                                    <div class="ace_layer ace_marker-layer"></div>
                                                    <div class="ace_layer ace_cursor-layer ace_hidden-cursors">
                                                        <div class="ace_cursor"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ace_scrollbar ace_scrollbar-v"
                                                style="display: none; width: 20px;">
                                                <div class="ace_scrollbar-inner" style="width: 20px;"></div>
                                            </div>
                                            <div class="ace_scrollbar ace_scrollbar-h"
                                                style="display: none; height: 20px;">
                                                <div class="ace_scrollbar-inner" style="height: 20px;"></div>
                                            </div>
                                            <div
                                                style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font: inherit; overflow: hidden;">
                                                <div
                                                    style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font: inherit; overflow: visible;">
                                                </div>
                                                <div
                                                    style="height: auto; width: auto; top: 0px; left: 0px; visibility: hidden; position: absolute; white-space: pre; font: inherit; overflow: visible;">
                                                    XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                                                </div>
                                            </div>
                                        </div>
                                        <textarea class="jodit_source_mirror" placeholder="Type your reply"
                                            style="min-height: 198px; height: 0px; display: none;"></textarea>
                                    </div>
                                    <div class="jodit_search">
                                        <div class="jodit_search_box">
                                            <div class="jodit_search_inputs"><input tabindex="0"
                                                    class="jodit_search-query" placeholder="Search for"
                                                    type="text"><input tabindex="0" class="jodit_search-replace"
                                                    placeholder="Replace with" type="text"></div>
                                            <div class="jodit_search_counts"><span>0/0</span></div>
                                            <div class="jodit_search_buttons">
                                                <button tabindex="0" type="button" class="jodit_search_buttons-next">
                                                    <svg viewBox="0 0 1792 1792">
                                                        <path
                                                            d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button tabindex="0" type="button" class="jodit_search_buttons-prev">
                                                    <svg viewBox="0 0 1792 1792">
                                                        <path
                                                            d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button tabindex="0" type="button" class="jodit_search_buttons-cancel">
                                                    <svg viewBox="0 0 16 16">
                                                        <g transform="translate(0,-1036.3622)">
                                                            <path d="m 2,1050.3622 12,-12"
                                                                style="fill:none;stroke:#000000;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-opacity:1;stroke-dasharray:none">
                                                            </path>
                                                            <path d="m 2,1038.3622 12,12"
                                                                style="fill:none;stroke:#000000;stroke-width:2;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-opacity:1;stroke-dasharray:none">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </button>
                                                <button tabindex="0" type="button"
                                                    class="jodit_search_buttons-replace">Replace</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jodit_statusbar" style="display: block;">
                                    <div class="jodit_statusbar_item jodit_statusbar_item-right"><span>Chars:
                                            0</span>
                                    </div>
                                    <div class="jodit_statusbar_item jodit_statusbar_item-right"><span>Words:
                                            0</span>
                                    </div>
                                </div>
                                <div role="button" tabindex="-1" title="Break" class="jodit-add-new-line"
                                    style="display: none;">
                                    <span>
                                        <svg viewBox="0 0 128 128" xml:space="preserve">
                                            <g>
                                                <polygon
                                                    points="112.4560547,23.3203125 112.4560547,75.8154297 31.4853516,75.8154297 31.4853516,61.953125     16.0131836,72.6357422 0.5410156,83.3164063 16.0131836,93.9990234 31.4853516,104.6796875 31.4853516,90.8183594     112.4560547,90.8183594 112.4560547,90.8339844 127.4589844,90.8339844 127.4589844,23.3203125   ">
                                                </polygon>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <textarea class="form-control editor" name="details" placeholder="Type your reply"
                                data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"
                                style="display: none;"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachments[]" id="file-2"
                                class="custom-input-file custom-input-file--2"
                                data-multiple-caption="{count} files selected" multiple="">
                            <label for="file-2" class=" mw-100 mb-0">
                                <i class="fa fa-upload"></i>
                                <span>Attach files.</span>
                            </label>
                        </div>
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-base-1">Send Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CREATE TICKET MODAL END  -->
{{-- <script>
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{__('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{__('Delete confirmation message')}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{__('Delete')}}</a>
            </div>
        </div>
    </div>
</div> --}}
