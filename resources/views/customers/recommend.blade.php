@extends('layouts.app')

@section('content')


<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Customers')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Recommended For')}}</th>
                    <th>{{__('Recommended Products')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($recommends as $recommend)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{\App\User::where('id',$recommend->user_id)->first()->name}}</td>
                        <td>
                            @php
                                $product=\App\Product::where('id',$recommend->product_id)->first();
                            @endphp
                            @isset($product)
                                <a href="{{route('product',$product->slug)}}" target="_blank">{{$product->name}}</a>
                            @endisset
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a onclick="confirm_modal('{{route('recommend.destroy', $recommend->id)}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('script')

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
