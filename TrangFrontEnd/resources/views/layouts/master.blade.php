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
    <!-- lightslither -->
    <link href="{{asset('eshopper/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/lightgallery.min.css')}}" rel="stylesheet">

    @yield('css')

</head>
<body>

@include('components.header')
@yield('content')
@include('components.footer')


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
    $(document).ready(function() {
        // thuc hien doan ma lighslider tai id ImageGallery
        $('#imageGallery').lightSlider({
            // chay nhieu hinh anh
            gallery:true,
            //khi click thi chay 1 hinh
            item:1,
            // khi click vao thi lap di lap lai nhieu lan
            loop:true,
            // hien thi 3 thumnail con
            thumbItem:3,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }
        });
    });
</script>



@yield('js')

</body>
</html>
