<div class="row">
    <div class="col-md-12">
        <a href="{{route('showCart')}}" class="btn btn-primary mb-3">View Cart</a>
    </div>
</div>
<div class="features_items">
    <h2 class="title text-center">Features Items</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{config('app.base_url').$product->feature_image_path}}" alt=""/>
                        <style>
                            .productinfo {
                                height:370px;

                            }
                        </style>
                        <h2>{{$product->price}} VNĐ</h2>
                        <p>{{$product->name}}</p>
                        <a href="#"
                           data-url="{{route('addToCart',['id' =>$product->id])}}"
                           class="btn btn-default add_to_cart">Add
                            to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product->price)}} VNĐ</h2>
                            <p>{{$product->name}}</p>
                            <a href="#"
                               data-url="{{route('addToCart',['id' =>$product->id])}}"
                               class="btn btn-default add_to_cart">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    function addToCart() {
        //co url de minh call ajax
        event.preventDefault();//ngan viec chuyen trang
        let urlCart = $(this).data('url');
        //xac dinh url de call ajax
        //b2: call ajax
        $.ajax({
            type:"GET",
            url:urlCart,
            dataType:'json',
            success: function (data) {
                if(data.code === 200) {
                    alert('Added to cart successfully.')
                }
            },
            error:function (){}
        });
    }
    //identify id
    //truyen id sang cho route
    $(function (){
        $('.add_to_cart').on('click',addToCart);
    });
</script>
