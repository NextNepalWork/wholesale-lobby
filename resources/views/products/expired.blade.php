@extends('layouts.app')

@section('content')

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ __('Expired Products') }}</h3>
        <div class="pull-right clearfix d-flex">

            <form class="" id="sort_products" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"
                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="Type & Enter">
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 200px;">
                        <select class="form-control sortSelect demo-select2" data-placeholder="{{__('All Sellers')}}" name="seller" onchange="sort_products()">
                            <option value=""></option>
                            @foreach (\App\Seller::all() as $key => $seller)
                                @if ($seller->user != null && $seller->user->shop != null)
                                    <option value="{{ $seller->user->id }}" @if ($vendor_id == $seller->user->id) selected @endif>{{ $seller->user->shop->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            @isset($vendor_id)
                
            
            <form action="{{route('expired-mail',$vendor_id)}}" method="post">
                @csrf
                <button class="btn btn-primary" id="send-mail" onclick="sendMail();">Send Mail</button>
            </form>
            @endisset
            <button class="btn btn-primary" id="bulkDelBtn" onclick="deleteBulkData();">Delete</button>

        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%" id="productTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>#</th>
                    <th width="20%">{{ __('Name') }}</th>
                    <th>Seller Name</th>
                    <th>Days Left</th>
                    {{-- <th>Mail Notification</th> --}}
                    <th>{{ __('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    @php
                        $remaining_days= now()->diffInDays(Carbon\Carbon::parse($product->expiry_date), false);
                    @endphp
                    @if ($remaining_days <= 10 )
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $product->id }}" data-id="{{ $product->id }}"
                            name="productID[]" class="rowCheck">
                        </td>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <a href="{{ route('product', $product->slug) }}" target="_blank" class="media-block">
                                <div class="media-left">
                                    @if ($product->photos != null)
                                        <img loading="lazy"  class="img-md" src="{{ asset(isset(json_decode($product->photos)[0]) ? json_decode($product->photos)[0] : 'img/nothing-found.jpg')}}" alt="Image">
                                    @endif 
                                </div>
                                <div class="media-body">{{ __($product->name) }}</div>
                            </a>
                        </td>

                        <td>{{ $product->user->name }}</td>
                        <td>
                            @if ($remaining_days<0)
                                <span class="badge badge-danger">Expired</span>    
                            @else
                                <span class="badge badge-danger">{{$remaining_days}} days left</span>
                            @endif
                        </td>
                        {{-- <td>
                            <form action="{{route('expired-mail',encrypt($product->id))}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mail" data-id="{{$product->id}}">  {{ __('Send Mail') }}  </button>
                            </form>
                        </td> --}}
                        
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                    data-toggle="dropdown" type="button">
                                    {{ __('Actions') }} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if($product->added_by=='admin')
                                        <li><a
                                                href="{{ route('products.admin.edit', encrypt($product->id)) }}">{{ __('Edit') }}</a>
                                        </li>
                                    @endif
                                    <li><a
                                            onclick="confirm_modal('{{ route('products.destroy', $product->id) }}');">{{ __('Delete') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">


        function sort_products(el) {
            $('#sort_products').submit();
        }
        function sendMail(el) {
            $('#send-mail').submit();
        }

        $("#checkAll").click(function() {
            $(".rowCheck").prop('checked', $(this).prop('checked'));
        });

        function deleteBulkData() {
            var allIds = [];
            $(".rowCheck:checked").each(function() {
                allIds.push($(this).val());
            });
            if (allIds.length <= 0) {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to perform bulk delete?");
                if (check == true) {
                    var join_checked_values = allIds.join(",");
                    $.ajax({
                        url: "{{ route('products.bulkDelete') }}",
                        type: 'get',
                        data: {
                            'ids': join_checked_values
                        },
                        beforeSend: function()
                        {
                            $(".myoverlay").css('display', 'block');
                        },
                        success: function(data) {
                            if (data['success']) {
                                $(".rowCheck:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                $(".myoverlay").css('display', 'none');
                                alert(data['success']);
                                location.href = data.redirectTo;
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops something went wrong');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    // $.each(allIds, function(index, value) {
                    //     $('table tr').filter("[data-row-id='" + value + "']").remove();
                    // });
                }
            }
        }
    </script>
@endsection
