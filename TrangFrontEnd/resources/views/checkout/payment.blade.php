@extends('layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('home/home.js')}}">
@endsection

@section('content')

    <!--/slider-->
    @include('home.components.slider')
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    <section id="cart_items">
                        <div class="container">


                            <div class="review-payment">
                                <h2>Xem lại giỏ hàng</h2>
                            </div>
                            <div class="cart_wrapper" data-url="{{route('deletedCart')}}">

                                <div class="container col-md-10">
                                    <div class="row">
                                        <table class="table update_cart_url" data-url="{{route('updateCart')}}">
                                            <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Ảnh đại diện</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Sub Total</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total =0;
                                            @endphp

                                            @foreach($carts as $id => $cartItem)
                                                @php
                                                    $total +=$cartItem['price']*$cartItem['quantity'];
                                                @endphp
                                                <tr>
                                                    <th scope="row">SPO{{$id}}</th>
                                                    <td><img style="width: 100px;height: 100px;object-fit: contain"
                                                             src="{{config('app.base_url').$cartItem['image']}}" alt="">
                                                    </td>
                                                    <td>{{$cartItem['name']}}</td>
                                                    <td>{{number_format($cartItem['price'])}} VND</td>
                                                    <td>
                                                        <input type="number" value="{{$cartItem['quantity']}}" min="1"
                                                               class="quantity">
                                                    </td>
                                                    <td>{{number_format($cartItem['price']*$cartItem['quantity'])}}</td>
                                                    <td>
                                                        <a href="" data-id="{{$id}}" style="margin-top: 0"
                                                           class="btn btn-primary cart_update">Cập nhật</a>
                                                        <a href="" data-id="{{$id}}"
                                                           class="btn btn-danger cart_deleted">Xoá</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-md-6">
                                            <h2>Tổng tiền: {{number_format($total)}} VND</h2>
                                        </div>
                                        <div class="col-md-12">
                                            @php
                                                $customer_id = session()->get('id');
                                                if($customer_id !=NULL){
                                            @endphp
                                            <h2><a class="btn btn-default check_out" href="{{route('add.checkout')}}">Thanh
                                                    toán</a></h2>
                                            @php
                                                }else{
                                            @endphp
{{--                                            <h2><a class="btn btn-default check_out" href="{{route('login.checkout')}}">Thanh--}}
{{--                                                    toán</a></h2>--}}


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                     <h4 style="margin: 40px 340px; font-size: 20px;">Chọn hình thức thanh toán</h4>
                <form action="{{route('order.place')}}" method="post" style="margin-left: 340px;">

                    @csrf
                            <div class="payment-options">
					            <span>
						                <label><input name="payment_options" value="1"
                                      type="checkbox">Thanh toán bằng thẻ Thẻ ATM</label>
					            </span>
                                <span>
						                <label><input name="payment_options" value="2"
                                                      type="checkbox"> Thanh toán trực tiếp khi nhận hàng</label>
					            </span>
                                <span>
                                    <label><input name="payment_options" value="3" type="checkbox"> Thanh toán bằng Paypal</label>
                                </span>
                                <input type="submit" value="Đặt hàng" name="send_order" class="btn btn-primary btn-sm">
                            </div>
                </form>
                @php
                    }
                @endphp
            </div>
        </div>
    </section>
    @yield('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <script>

        function cartUpdate(event) {
            event.preventDefault();
            let urlUpdateCart = $('.update_cart_url').data('url');
            let id = $(this).data('id');
            let quantity = $(this).parents('tr').find('input.quantity').val();

            $.ajax({
                type: "GET",
                url: urlUpdateCart,
                data: {id: id, quantity: quantity},
                success: function (data) {
                    if (data.code === 200) {
                        $('.cart_wrapper').html(data.cart_component);
                        alert('Cập nhật thành công !')
                    }
                },
                error: function () {

                }
            });
        }

        function cartDeleted(event) {
            event.preventDefault();
            let urlDelete = $('.cart_wrapper').data('url');
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: urlDelete,
                data: {id: id},
                success: function (data) {
                    if (data.code === 200) {
                        $('.cart_wrapper').html(data.cart_component);
                        alert('Xoá thành công !')
                    }
                },
                error: function () {

                }
            });
        }

        $(function () {
            $(document).on('click', '.cart_update', cartUpdate);
            $(document).on('click', '.cart_deleted', cartDeleted);
        })
    </script>


@endsection






