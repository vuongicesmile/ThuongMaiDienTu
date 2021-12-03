<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    private $product;
    public function __construct(Product $product)
    {
        $this->product=$product;
    }
    public function save_cart(Request $request)
    {
        try {
            DB::beginTransaction();
        $product_id = $request->productid_hidden;
        $quantity =$request->qty;
        $data =$this->product->where('id',$product_id)->get();
        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        DB::commit();
        return view('cart.show_cart', compact('sliders', 'categorys', 'products', 'productsRecommend', 'categorysLimit'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
    }
}
