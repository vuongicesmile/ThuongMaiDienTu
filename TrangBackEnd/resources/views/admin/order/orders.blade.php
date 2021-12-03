@extends('layouts.admin')

@section('title')
    <title>Trang chủ </title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' =>'Chi tiết','key'=> 'Danh sách'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Thông tin khách hàng</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $customer_item)
                                <tr>
                                    <td>{{$customer_item->name}}</td>
                                    <td>{{$customer_item->phone}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <h3>Thông tin vận chuyển </h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên người vận chuyển</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                            </tr>
                            </thead>
                            <tbody>
                                                        @foreach($shipping as $shipping_item)

                                                            <tr>
                                                                <td>{{$shipping_item->name}}</td>
                                                                <td>{{$shipping_item->address}}</td>
                                                                <td>{{$shipping_item->phone}}</td>
                                                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <h3>Chi tiết đơn hàng </h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                                                        @foreach($listDetail as $listDetail_item)

                                                            <tr>

                                                                <td>{{$listDetail_item->product_name}}</td>
                                                                <td>{{$listDetail_item->product_sales_quantity}}</td>
                                                                <td>{{$listDetail_item->product_price}}</td>
                                                                <td>{{$listDetail_item->product_price * $listDetail_item->product_sales_quantity}}</td>
                                                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                    <div class="col-md-12">
{{--                        {{$order->links()}}--}}
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection


