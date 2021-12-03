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
                <h2>Cảm ơn các bạn đã đặt hàng , chúng tôi sẽ liên hệ cho các bạn sớm nhất !</h2>

                </div>
            </div>
        </div>
    </section>



@endsection






