<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')

    <link href="{{asset('eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/main.css')}}" rel="stylesheet">
    @yield('css')

</head>
<body>
<div class="cart_wrapper" data-url="{{route('deletedCart')}}">
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i
                                            class="fa fa-phone"></i> {{getConfigValueFromSettingTable('phone_contact')}}
                                    </a></li>
                                <li><a href="#"><i
                                            class="fa fa-envelope"></i>{{getConfigValueFromSettingTable('email')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{getConfigValueFromSettingTable('facebook_link')}}"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="{{getConfigValueFromSettingTable('linkkendin_link')}}"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="/eshopper/images/home/logo.png" alt=""/></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canada</a></li>
                                    <li><a href="">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canadian Dollar</a></li>
                                    <li><a href="">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-user"></i> Tài khoản</a></li>
                                <li><a href=""><i class="fa fa-star"></i> Danh mục ưu thích</a></li>
                                <li><a href="checkout.html"><i class="fa fa-crosshairs"></i>Thanh toán</a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                <li><a href="login.html"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->


    <div class="container">
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
                                 src="{{config('app.base_url').$cartItem['image']}}" alt=""></td>
                        <td>{{$cartItem['name']}}</td>
                        <td>{{number_format($cartItem['price'])}} VND</td>
                        <td>
                            <input type="number" value="{{$cartItem['quantity']}}" min="1" class="quantity">
                        </td>
                        <td>{{number_format($cartItem['price']*$cartItem['quantity'])}}</td>
                        <td>
                            <a href="" style="margin-top: 0;" data-id="{{$id}}" class="btn btn-primary cart_update">Cập nhật</a>
                            <a href="" data-id="{{$id}}" class="btn btn-danger cart_deleted">Xoá</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12">
                <h2>Tổng tiền: {{number_format($total)}} VND</h2>
            </div>

            <div class="col-md-12">
                @php
                    $customer_id = session()->get('id');
                    if($customer_id !=NULL){
                @endphp
                <h2><a class="btn btn-default check_out" href="{{route('add.checkout')}}">Thanh toán</a></h2>
                @php
                    }else{
                @endphp
                <h2><a class="btn btn-default check_out" href="{{route('login.checkout')}}">Thanh toán</a></h2>
                @php
                    }
                @endphp
                <div class="col-md-3">
                <form action="check_coupon" method="post">
                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('eshopper/js/jquery.js')}}"></script>
<script src="{{asset('eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('eshopper/js/price-range.js')}}"></script>
<script src="{{asset('eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('eshopper/js/main.js')}}"></script>

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


</body>
</html>
