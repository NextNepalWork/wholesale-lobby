@extends('layouts.app')

@section('content')

{{-- <div class="row">
    <div class="col-lg-12 pull-right">
        <a href="{{ route('products.create') }}"
            class="btn btn-rounded btn-info pull-right">{{ __('Add New Product') }}</a>
    </div>
</div> --}}

<br>
<div class="panel">    
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">Shop : {{$shop->name}}<br>Seller : {{$user->name}}</h3>
    </div>
</div>
<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">Dues Left</h3>
        <div class="pull-right d-flex clearfix">
            <button class="btn btn-primary" id="bulkPayBtn" onclick="payBulkData();">Pay</button>
            <form class="" id="sort_products" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"
                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="Type & Enter">
                    </div>
                </div>
            </form>
            <button class="btn btn-primary" id="bulkDelBtn" onclick="deleteBulkData();">Delete</button>
        </div>
    </div>


        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%" id="productTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>{{ __('Order Code') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Paid Date') }}</th>
                        <th>{{ __('Method') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dues as $key => $product)                    
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $product->id }}" data-amount="{{ $product->amount }}" data-id="{{ $product->id }}"
                                name="productID[]" class="rowCheck">
                            </td>
                            <td>{{ $product->orderDetail->order->code }}</td>
                            <td>
                                @php
                                    $product_detail = \App\Product::find($product->id);
                                @endphp
                                {{$product_detail->name}}
                            </td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ date('D d M Y',strtotime($product->paid_date)) }}</td>
                            <td>{{ ($product->payment_type == 'bank_payment')?'Bank Payment':ucwords($product->payment_type) }}</td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="clearfix">
                <div class="pull-right">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div> --}}
        </div>
    </div>
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <form class="form-horizontal" action="{{ route('dues.bulkPay') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">{{__('Pay to seller')}}</h4>
                    </div>
                
                    <div class="modal-body">             
                        <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                        <input type="hidden" id="due-id" name="due_id" value="">
                        <input type="hidden" class="due-amount" name="amount" value="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="amount">{{__('Amount')}}</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" step="0.01" name="amount" class="due-amount" value="" disabled class="form-control" required>
                            </div>
                        </div>  
            
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="payment_option">{{__('Payment Method')}}</label>
                            <div class="col-sm-9">
                                <select name="payment_option" id="payment_option" class="form-control demo-select2-placeholder" required>
                                    <option value="">{{__('Select Payment Method')}}</option>
                                    {{-- @if($seller->cash_on_delivery_status == 1) --}}
                                        <option value="cash">{{__('Cash')}}</option>
                                    {{-- @endif --}}
                                    {{-- @if($seller->bank_payment_status == 1) --}}
                                        <option value="bank_payment">{{__('Bank Payment')}}</option>
                                    {{-- @endif --}}
                                </select>
                            </div>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="panel-footer text-right">
                            <button class="btn btn-purple" type="submit">{{__('Pay')}}</button>
                            <button class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });


        $("#checkAll").click(function() {
            $(".rowCheck").prop('checked', $(this).prop('checked'));
        });

        function payBulkData() {
            var allIds = [];
            var amount = 0;
            // if($(".rowCheck:checked").length == 0){
            //     alert('Please Select At least one item');
            // }
            $(".rowCheck:checked").each(function() {
                allIds.push($(this).val());
                amount += $(this).data('amount');
            });
            $('.due-amount').val(amount);
            $('#due-id').val(allIds.toString());
            
            if (allIds.length <= 0) {
                alert("Please select row.");
            } else {

                $('#payment_modal').modal('show');
                exit;
                var check = confirm("Are you sure you want to pay?");
                if (check == true) {
                    var join_checked_values = allIds.join(",");
                    $.ajax({
                        url: "{{ route('dues.bulkPay') }}",
                        type: 'get',
                        data: {
                            'ids': join_checked_values
                        },
                        beforeSend: function()
                        {
                            $(".myoverlay").css('display', 'block');
                        },
                        success: function(data) {
                            location.reload();
                            // if (data['success']) {
                            //     $(".rowCheck:checked").each(function() {
                            //         $(this).parents("tr").remove();
                            //     });
                            //     $(".myoverlay").css('display', 'none');
                            //     alert(data['success']);
                            //     location.href = data.redirectTo;
                            // } else if (data['error']) {
                            //     alert(data['error']);
                            // } else {
                            //     alert('Whoops something went wrong');
                            // }
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
