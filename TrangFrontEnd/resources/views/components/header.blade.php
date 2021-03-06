<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i
                                        class="fa fa-phone"></i> {{getConfigValueFromSettingTable('phone_contact')}}</a>
                            </li>
                            <li><a href="#"><i class="fa fa-envelope"></i>{{getConfigValueFromSettingTable('email')}}
                                </a></li>
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
                        <a href="{{route('home')}}"><img src="/eshopper/images/home/logo.png" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Languages
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('lang/vn')}}">@lang('lang.tv')</a></li>
                                <li><a href="{{url('lang/en')}}">@lang('lang.ta')</a></li>
                                <li><a href="{{url('lang/cn')}}">@lang('lang.tt')</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
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
                            <li><a href="{{route('login.checkout')}}"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href=""><i class="fa fa-star"></i> Favorite account</a></li>
                            @php
                                $customer_id = session()->get('customer_id');
                                if($customer_id != NULL)
                                    {
                            @endphp
                            <li><a href="{{route('add.checkout')}}"><i class="fa fa-crosshairs"></i> Payment</a></li>
                            @php
                                }else{
                            @endphp
                            <li><a href="{{route('login.checkout')}}"><i class="fa fa-crosshairs"></i> Payment</a>
                            </li>
                            @php
                                }
                            @endphp
                            <li><a href="{{route('showCart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @php
                                $customer_id = session()->get('customer_id');
                                if($customer_id != NULL)
                                    {
                            @endphp
                            <li><a href="{{route('logout.checkout')}}"><i class="fa fa-lock"></i>
                                Log out</a></li>
                            @php
                                }else{
                            @endphp

                            <li><a href="{{route('login.checkout')}}"><i class="fa fa-lock"></i> Log In</a></li>
                            @php
                                }
                            @endphp
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>


                    @include('components.main_menu')


                </div>
                <div class="col-sm-5">
                    <form action="{{route('search.index')}}" method="post" autocomplete="off">
                        @csrf
                    <div class="search_box pull-right">
                                {{--
                                    |khai b??o :id="keywords"
                                    |khi nh???p v??o 1 k?? t??? , d??ng m?? ajax , d???a v??o id ?????
                                    |b???t k?? t??? ???? ; khi c?? d??? li???u r???i c???n 1 c??i div ????? tr??? d??? li???u v???
                                    --}}
                        <input type="text" name="keyword_submit" id="keywords" placeholder="search product"/>
                        {{-- div d?????i ????y s??? tr??? d??? li???u v???                        --}}
                        <div id="search-ajax">
                        </div>
                        {{-- end div                        --}}
                        <input type="submit" style="margin-top: 0; color: #1a202c" class="btn btn-primary btn-sm" name="search_items" value="Search"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<script src="{{asset('eshopper/js/jquery.js')}}"></script>
<script src="{{asset('eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('eshopper/js/price-range.js')}}"></script>
<script src="{{asset('eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('eshopper/js/main.js')}}"></script>
<!-- light slider -->
<script src="{{asset('eshopper/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('eshopper/js/lightslider.js')}}"></script>
<script src="{{asset('eshopper/js/prettify.js')}}"></script>

<script type="text/javascript">
    {{-- khi c??c b???n nh???p d??? li???u : keyup    --}}
    $('#keywords').keyup(function(){
        //l???y d??? li???u trong ?? input text
        var query = $(this).val();
        // alert(query);
        // n???u kh??c r???ng
        if( query != '') {
            //l???y token trong crsf_field = tr?????ng name c???a input
            var _token = $('input[name="_token"]').val();
            // alert(_token);
            // th???c hi???n ajax
            $.ajax({
                url: '{{route('autocomplete.ajax')}}',
                method: 'POST',
                // d??? li??uh ???????c g???i ??i t???i url
                data: {query: query, _token: _token},
                success: function (data) {
                    // alert('du lieu ok');
                    // d??? li???u ????? ra v???i hi???u ???ng m???
                    $('#search-ajax').fadeIn();
                    // d??? li???u ????? v???
                    $('#search-ajax').html(data);
                }
            });
        }else {
            $('#search-ajax').fadeOut();
        }
    });
    $(document).on('click','li',function (){
        $('#keywords').val($(this).text());
        $('#search-ajax').fadeOut();
    });


</script>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "533088753508923");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v12.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
