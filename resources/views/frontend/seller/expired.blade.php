@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Products')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('products.expired') }}">{{__('Expired Products')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                    <i class="la la-dropbox"></i>
                                    <span class="d-block title heading-3 strong-400">{{ max(0, Auth::user()->seller->remaining_uploads) }}</span>
                                    <span class="d-block sub-title">{{ __('Remaining Uploads') }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4 mx-auto">
                                <a class="dashboard-widget text-center plus-widget mt-4 d-block" href="{{ route('seller.products.upload')}}">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New Product') }}</span>
                                </a>
                            </div>
                            @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                            @php
                                $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                            @endphp
                            <div class="col-md-4">
                                <a href="{{ route('seller_packages_list') }}" class="dashboard-widget text-center red-widget text-white mt-4 d-block">
                                    @if($seller_package != null)
                                    <img src="{{ asset($seller_package->logo) }}" height="44" class="img-fit mw-100 mx-auto mb-1">
                                    <span class="d-block sub-title mb-2">{{__('Current Package')}}: {{ $seller_package->name }}</span>
                                    @else
                                        <i class="la la-frown-o mb-1"></i>
                                        <div class="d-block sub-title mb-2">{{__('No Package Found')}}</div>
                                    @endif
                                    <div class="btn btn-styled btn-white btn-outline py-1">{{__('Upgrade Package')}}</div>
                                </a>
                            </div>
                            @endif
                        </div> --}}

                        <div class="card no-border mt-4">
                            <div class="card-header py-2">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-xl-3">
                                        <h6 class="mb-0">All Expired Products</h6>
                                    </div>
                                    <div class="col-md-6 col-xl-3 ml-auto">
                                        <form class="" action="" method="GET">
                                            <input type="text" class="form-control" id="search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search product">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-sm table-hover ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Category')}}</th>
                                            <th>{{__('Current Qty')}}</th>
                                            <th>{{__('Base Price')}}</th>
                                            {{-- <th>{{__('Expiry Date')}}</th> --}}
                                            <th>{{__('Days Left')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $key => $product)
                                        @php
                                            $remaining_days= now()->diffInDays(Carbon\Carbon::parse($product->expiry_date), false);
                                            
                                        @endphp
                                        @if ($remaining_days <= 10 )
                                            <tr>
                                                <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                                                <td><a href="{{ route('product', $product->slug) }}" target="_blank">{{ __($product->name) }}</a></td>
                                                <td>
                                                    @if ($product->subsubcategory != null)
                                                        {{ $product->subsubcategory->name }}
                                                    @elseif($product->subcategory != null)
                                                        {{ $product->subcategory->name }}                                                        
                                                    @elseif($product->category != null)
                                                        {{ $product->category->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $qty = 0;
                                                        if($product->variant_product){
                                                            foreach ($product->stocks as $key => $stock) {
                                                                $qty += $stock->qty;
                                                            }
                                                        }
                                                        else{
                                                            $qty = $product->current_stock;
                                                        }
                                                        echo $qty;
                                                    @endphp
                                                </td>
                                                <td>{{ $product->unit_price }}</td>
                                                {{-- <td>{{$product->expiry_date}}</td> --}}
                                                <td>
                                                    @if ($remaining_days<0)
                                                        <span class="badge badge-danger">Expired</span>    
                                                    @else
                                                        <span class="badge badge-danger">{{$remaining_days}} days left</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn" type="button" id="dropdownMenuButton-{{ $key }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-{{ $key }}">
                                                            <a href="{{route('seller.products.edit', encrypt($product->id))}}" class="dropdown-item">{{__('Edit')}}</a>
        					                                <button onclick="confirm_modal('{{route('products.destroy', $product->id)}}')" class="dropdown-item">{{__('Delete')}}</button>
                                                            <a href="{{route('products.duplicate', $product->id)}}" class="dropdown-item">{{__('Duplicate')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $products->links() }}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

