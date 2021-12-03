<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\CategoryTranslation;
use Illuminate\Session;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $sliders = Slider::latest()->get();
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();
//        dd($categoryTranslations);
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
        //pha xiu
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();

        return view('home.home', compact('sliders', 'categorys', 'products', 'productsRecommend', 'categorysLimit','categoryTranslations'));
    }

    //Cart Ajax
    public function addToCart($id)
    {
        try {
            DB::beginTransaction();
//        session()->flush('cart');
            $product = Product::find($id);
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->feature_image_path,
                    'quantity' => 1,
                ];
            }
            session()->put('cart', $cart);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'sucess'], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
//        //them vao session
//        session()->put('cart',$cart);//  qua cac trang khac van luu duoc du lieu
//        echo "<pre>";
//        print_r(session()->get('cart'));
    }

    public function showCart()
    {
        try {
            DB::beginTransaction();
            $carts = session()->get('cart');
            if($carts ==null)
            {
                $locale = \Illuminate\Support\Facades\Session::get('locale');
                $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();
                $sliders = Slider::latest()->get();
                $categorys = Category::where('parent_id', 0)->get();
                $products = Product::latest()->take(6)->get();
                $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
                $categorysLimit = Category::where('parent_id', 0)->take(3)->get();

                return view('cart.show_cart', compact('categoryTranslations','sliders', 'categorys', 'products', 'productsRecommend', 'categorysLimit'));

            }
            $locale = \Illuminate\Support\Facades\Session::get('locale');
            $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

            $sliders = Slider::latest()->get();
            $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
            $categorys = Category::where('parent_id', 0)->get();
            DB::commit();
            return view('home.cart', compact('categoryTranslations','carts', 'categorysLimit', 'sliders', 'categorys'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $carts);
            $carts = session()->get('cart');
            $cartCompenent = view('home.cart', compact('carts'))->render();
            return response()->json([
                'cart_component' => $cartCompenent,
                'code' => 200], 200);
        }
    }

    public function deletedCart(Request $request)
    {
        if ($request->id) {
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart', $carts);
            $carts = session()->get('cart');
            $cartCompenent = view('home.cart', compact('carts'))->render();
            return response()->json([
                'cart_component' => $cartCompenent,
                'code' => 200], 200);
        }
    }
    //end cart ajax
    //chi tiet san pham
    public function details_product($product_id)
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
        $anhsanpham = Product::find($product_id)->take(1)->get();
        $anhchitiet = Product::find($product_id)->images()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        return view('.sanpham.show_details', compact('categoryTranslations','sliders', 'categorys', 'products', 'productsRecommend', 'categorysLimit', 'anhchitiet', 'anhsanpham'));
    }
    //end chi tiet san pham

    //search
    public function search_index(Request $request)
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $carts = session()->get('cart');
        $key_word = $request->keyword_submit;
        $sliders = Slider::latest()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $search_product = $this->product->where('name', 'like', '%' . $key_word . '%')->get();
        return view('sanpham.search', compact('carts', 'categorysLimit', 'sliders', 'categorys', 'search_product','categoryTranslations'));
    }

    //SendMail
    public function sendMail()
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();

        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $to_name = "vuongicesmile";
        $to_mail = "vuongnq.labianlabs@gmail.com";
        $data = array('name'=>'Mail từ tài khoản khách hàng','body'=>'Mail gửi về vấn đề hàng hoá ');
        Mail::send('mail.send_mail',$data,function ($message) use ($to_name,$to_mail){
            $message->to($to_mail)->subject("Thông tin đặt hàng từ Eshop");
            $message->from($to_mail,$to_name);
        });
        return view('checkout.handcash',compact('categoryTranslations','sliders','categorys','categorysLimit','products','productsRecommend'));

    }

    public function autocomplete_ajax(Request $request) {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $carts = session()->get('cart');
        $sliders = Slider::latest()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $data = $request->all();
        if($data['query']){
            $search_product = $this->product->where('name', 'like', '%' . $data['query'] . '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: relative">';
            foreach ($search_product as $key => $val){
                $output .='
                <li><a href="#">'.$val->name.'</a></li>
                ';
            }
            $output .='</ul>';
            echo $output;
        }
//        return view('sanpham.search', compact('carts', 'categorysLimit', 'sliders', 'categorys', 'search_product','categoryTranslations'));
    }

}
