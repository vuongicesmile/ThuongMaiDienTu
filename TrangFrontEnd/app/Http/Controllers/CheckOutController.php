<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingAddRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MongoDB\Driver\Session;

class CheckOutController extends Controller
{
    private $customer;
    private $shipping;
    private $payment;
    private $order;
    private $order_detail;


    public function __construct(OrderDetail $order_detail, Customer $customer, Shipping $shipping, Payment $payment, Order $order)
    {
        $this->customer = $customer;
        $this->shipping = $shipping;
        $this->payment = $payment;
        $this->order = $order;
        $this->order_detail = $order_detail;

    }

    public function login_checkout()
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $sliders = Slider::latest()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $categorys = Category::where('parent_id', 0)->get();
        return view('checkout.login_checkout', compact('categoryTranslations','categorys', 'categorysLimit', 'sliders'));
    }

    public function add_customer(SignUpRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = md5($request->password);
            $data['phone'] = $request->phone;
            $customer_id = $this->customer->insertGetId($data);
            session()->put('customer_id', $customer_id);
            session()->put('customer_name', $request->name);
            DB::commit();
            return redirect(route('add.checkout'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
    }

    public function checkout()
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $sliders = Slider::latest()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $categorys = Category::where('parent_id', 0)->get();
        return view('checkout.show_checkout', compact('categoryTranslations','categorys', 'categorysLimit', 'sliders'));
    }

    public function save_checkout_customer(ShippingAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $carts = session()->get('cart');
            $data = array();
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['notes'] = $request->notes;
            $shipping_id = $this->shipping->insertGetId($data);
            session()->put('shipping_id', $shipping_id);
            $sliders = Slider::latest()->get();
            $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
            $categorys = Category::where('parent_id', 0)->get();
            DB::commit();
            return view('checkout.payment', compact('carts', 'categorys', 'categorysLimit', 'sliders'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
    }

    public function logout_checkout()
    {
        session()->flush();
        return redirect(route('login.checkout'));
    }

    public function login_customer(SignInRequest $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $result = $this->customer->where('email', $email)->where('password', $password)->get();
        foreach ($result as $item) {
            $customer_id = $item->id;
            session()->put('customer_id', $customer_id);
            if ($result) {
                foreach ($result as $result_item)
                    session()->put('customer_id', $result_item->id);

                return redirect(route('add.checkout'));

            } else {
                return redirect(route('login.checkout'));
            }
        }
    }

    public function payment(ShippingAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $carts = session()->get('cart');
            $data = array();
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['notes'] = $request->notes;
            $shipping_id = $this->shipping->insertGetId($data);
            session()->put('shipping_id', $shipping_id);
            $locale = \Illuminate\Support\Facades\Session::get('locale');
            $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

            $sliders = Slider::latest()->get();
            $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
            $categorys = Category::where('parent_id', 0)->get();
            DB::commit();
            return view('checkout.payment', compact('categoryTranslations','categorys', 'carts', 'categorysLimit', 'sliders', 'shipping_id'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }
    }

    public function order_place(Request $request)
    {
        $locale = \Illuminate\Support\Facades\Session::get('locale');
        $categoryTranslations = CategoryTranslation::where('locale',$locale)->get();

        $sliders = Slider::latest()->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $carts = session()->get('cart');
//        dd($carts);
        //insert payment method
        try {
            DB::beginTransaction();
            $data = array();
            $data['method'] = $request->payment_options;
            $data['status'] = "Đang chờ xử lý";
            $payment_id = $this->payment->insertGetId($data);
            //insert-order method

            $order_data = array();
            $order_data['customer_id'] = session()->get('customer_id');
            $order_data['shipping_id'] = session()->get('shipping_id');
            $order_data['payment_id'] = $payment_id;
            foreach ($carts as $id => $cartItem) {
                $order_data['order_total'] = $id;
            }
            $order_data['order_status'] = "Đang chờ xử lý";
            $order_id = $this->order->insertGetId($order_data);
            //insert order_detail order_id
            foreach ($carts as $id => $cart) {
                $order_d = array();
                $order_d['order_id'] = $order_id;
                $order_d['product_id'] = $id;
                $order_d['product_name'] = $cart['name'];
                $order_d['product_price'] = $cart['price'];
                $order_d['product_sales_quantity'] = $cart['quantity'];
                $this->order_detail->insertGetId($order_d);
            }
            $customerMail = $this->customer->where('id',$order_data['customer_id'])->get();
            foreach ($customerMail as $cMail_item) {
                $to_name = $cMail_item->name;
                $to_mail = $cMail_item->email;
                $dataMail = array('name' => 'Mail từ tài khoản khách hàng', 'body' => 'Mail gửi về vấn đề hàng hoá ');
                Mail::send('mail.send_mail',compact('carts'), function ($message) use ($to_name, $to_mail) {
                    $stt = session()->get('customer_id');
                    $message->to($to_mail)->subject("[Bán hàng trực tuyến] Đơn hàng mới #.$stt.");
                    $message->from($to_mail, $to_name);
                });
            }
            DB::commit();
            if ($data['method'] == 1)
                echo "Thanh toán bằng thẻ ATM";
            else if ($data['method'] == 2)
                return view('checkout.handcash', compact('categoryTranslations','categorys', 'sliders', 'categorysLimit'));
            else {
                echo "Thẻ paypal";
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Thông báo :' . $exception->getMessage() . '--dòng : ' . $exception->getLine());
        }

    }
}
