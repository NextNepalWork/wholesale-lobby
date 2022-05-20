<a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
data-target="#nav-cart">
<span class="mr-1"><i class="fa fa-shopping-bag"
        aria-hidden="true"></i></span>
{{-- <sup class="cart-items text-white">2</sup> --}}
@if(Session::has('cart'))
    <sup class="cart-items text-white">{{ count(Session::get('cart'))}}</sup>
@else
    <sup class="cart-items text-white">0</sup>
@endif
</a>
{{-- <ul class="dropdown-menu dropdown-menu-right px-0">
    <li>
        <div class="dropdown-cart px-0">
            @if(Session::has('cart'))
                @if(count($cart = Session::get('cart')) > 0)
                    <div class="dropdown-cart-items c-scrollbar" id="cart_header_table">
                        <h6 class="text-center font-weight-bold pt-1">Cart Items</h6>
                        <div class="table-responsive">
                            <table class="table mb-0">
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($cart as $key => $cartItem)
                                    <tr>
                                    @php
                                    $product = \App\Product::find($cartItem['id']);
                                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                                    @endphp
                                        <td class="img_header_cart">
                                        <div>
                                            <a href="{{ route('product', $product->slug) }}">
                                                @if (file_exists($product->thumbnail_img)) 
                                                    <img src="{{ asset($product->thumbnail_img) }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                                @else
                                                    <img src="{{ asset('frontend/images/placeholder.jpg') }}" alt="{{ __($product->name) }}">
                                                @endif
                                            </a>
                                        </div>
                                        </td>
                                        <td class="cart_header_title"> 
                                        <a href="{{ route('product', $product->slug) }}" class="text-dark">{{ __($product->name) }}</a> <br><br>
                                        <span class="font-weight-bold" style="font-size: smaller">x{{ $cartItem['quantity'] }}</span>
                                        <span class="font-weight-bold" style="font-size: smaller">({{ single_price($cartItem['price']*$cartItem['quantity']) }})</span>
                                        </td>
                                        <td> 
                                        <a href="#" class="header_cart_icon">
                                            <button onclick="removeFromCart({{ $key }})" style="border:none; background-color:transparent">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                        </a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="cart_header_price d-flex justify-content-between px-2">
                        <div>
                            <h6>Subtotal</h6>
                        </div>
                        <div>
                            <h6>{{ single_price($total) }}</h6>
                        </div>
                    </div>
                    <div class="top_cartmodal_btn d-flex justify-content-around align-items-center w-100 pt-2">
                        <a href="{{ route('cart') }}" class="btn-custom rounded-0 py-2">
                            <img src="{{asset('frontend/assets/images/logo/cart.svg')}}" class="img-fluid" alt="">&nbsp; View Cart
                        </a>
                        @if (Auth::check())
                        <a href="{{ route('checkout.shipping_info') }}" class="btn-custom rounded-0 py-2"> 
                            <img src="{{asset('frontend/assets/images/logo/cart.svg')}}" class="img-fluid" alt="">&nbsp; Proceed Checkout
                        </a>
                        @endif
                    </div>
                @else
                    <div class="dc-header">
                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                    </div>
                @endif
            @else
                <div class="dc-header">
                    <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                </div>
            @endif
        </div>
    </li>
</ul> --}}


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
                                    {{-- <img src="frontend/assets/images/product-images/1.jpg" class="img-fluid"> --}}
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

