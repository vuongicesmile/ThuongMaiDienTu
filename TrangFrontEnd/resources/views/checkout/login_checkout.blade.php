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
{{--    @include('home.components.slider')--}}
{{--    <!--/slider-->--}}

    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    <section id="form"><!--form-->
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="login-form"><!--login form-->
                                        <h2>Đăng nhập tài khoản của bạn</h2>
                                        <form action="{{route('login.customer')}}" method="post">
                                            @csrf
                                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" placeholder="Tài khoản" />
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Nhập mật khẩu" />
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <span>
								<input type="checkbox" class="checkbox">
								Ghi nhớ lần sau
							</span>
                                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                                            <a class="btn-danger" href="{{route('redirectGoogle')}}">Đăng nhập bằng Google</a>
                                        </form>

                                    </div><!--/login form-->
                                </div>
                                <div class="col-sm-1">
                                    <h2 class="or">Hoặc</h2>
                                </div>
                                <div class="col-sm-4">
                                    <div class="signup-form"><!--sign up form-->
                                        <h2>Đăng ký tài khoản mới !</h2>
                                        <form action="{{route('add.customer')}}" method="post">
                                            @csrf
                                            <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Họ và tên khách hàng" value="{{old('name')}}" />
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Nhập tên địa chỉ email" value="{{old('email')}}" />
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Nhập mật khẩu" value="{{old('password')}}"/>
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input name="phone" class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Nhập số điện thoại" value="{{old('phone')}}"/>
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <button type="submit" class="btn btn-default">Đăng ký</button>
                                        </form>
                                    </div><!--/sign up form-->
                                </div>
                            </div>
                        </div>
                    </section><!--/form-->

                </div>
            </div>
        </div>
    </section>



@endsection






