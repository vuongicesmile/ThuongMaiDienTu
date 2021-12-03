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

    {{--    <!--/slider-->--}}
        @include('home.components.slider')
    {{--    <!--/slider-->--}}

    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    <section id="cart_items">
                        <div class="container">
                            <div class="breadcrumbs">
                                <ol class="breadcrumb">
                                    <li><a href="{{route('home')}}">Trang chủ</a></li>
                                    <li class="active">Thanh toán giỏ hàng</li>
                                </ol>
                            </div><!--/breadcrums-->
                            <div class="register-req">
                                <p>Làm ơn đăng nhập hoặc đăng ký để thanh toán giỏ hàng và xem lại lịch sử mua hàng </p>
                            </div><!--/register-req-->

                            <div class="shopper-informations">
                                <div class="row">

                                    <div class="col-sm-12 clearfix">
                                        <div class="bill-to">
                                            <p>Điền thông tin hàng</p>
                                            <div class="form-one">
                                                <form action="{{route('add.payment')}}" method="post">
                                                    @csrf
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Họ và tên" value="{{old('name')}}">
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" placeholder="Email" value="{{old('email')}}">
                                                    @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="Số phone" value="{{old('phone')}}">
                                                    @error('phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input class="form-control @error('address') is-invalid @enderror" name="address" type="text" placeholder="Địa chỉ liên lạc" value="{{old('address')}}">
                                                    @error('address')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
                                                    @error('notes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
                                                </form>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </section> <!--/#cart_items-->

                </div>
            </div>
        </div>
    </section>



@endsection






