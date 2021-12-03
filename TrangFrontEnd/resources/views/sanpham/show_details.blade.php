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
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        @foreach ($anhsanpham as $anhsanpham_item)

                        <ul id="imageGallery">
                            @foreach($anhchitiet as $productImageItem)
                            <li data-thumb="{{config('app.base_url').$productImageItem->image_path}}" data-src="{{config('app.base_url').$productImageItem->image_path}}">
                                <img width="100%" src="{{config('app.base_url').$productImageItem->image_path}}" />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                            <h2>{{$anhsanpham_item->name}}</h2>
                            <p>Web ID: SP000{{$anhsanpham_item->id}}</p>
                            <form action="{{route('save.cart')}}" method="post">
                                @csrf
                                <span>
                           <span>{{number_format($anhsanpham_item->price)}} VND</span>
                           <label>Số lượng:</label>
                           <input name="qty" type="number" min="1" value="1"/>
                           <input name="productid_hidden" type="hidden" min="1" value="{{$anhsanpham_item->id}}"/>
                                        <button type="submit" class="btn btn-fefault cart">
                              <i class="fa fa-shopping-cart"></i>
                              Thêm vào giỏ hàng
                           </button>
                        </span>
                            </form>
                            <p><b>Tình trạng:</b> Còn hàng</p>
                            <p><b>Ghi chú:</b> {!!$anhsanpham_item->content!!}</p>
                            <p><b>Thương hiệu :</b> E-SHOPPER</p>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <p>{!!$anhsanpham_item->content!!}</p>
                        </div>
                        <div class="tab-pane fade" id="companyprofile" >
                            <p>{!!$anhsanpham_item->content!!}</p>
                        </div>
                        @endforeach
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                              <span>
                                 <input type="text" placeholder="Your Name"/>
                                 <input type="email" placeholder="Email Address"/>
                              </span>
                                    <textarea name="" ></textarea>
                                    <b>Rating: </b> <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/product-details/rating.png')}}" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend1.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend2.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend3.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend1.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend2.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{\Illuminate\Support\Facades\URL::to('eshopper/images/home/recommend3.jpg')}}" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->
            </div>
        </div>
    </section>

@endsection


