<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    private $order;
    private $customer;
    private $order_detail;
    public function __construct(Order $order,Customer $customer,Order_detail $order_detail)
    {
        $this->order=$order;
        $this->customer=$customer;
        $this->order_detail=$order_detail;
    }

    public function index()
    {
        $customer = $this->customer->latest()->get();
        $order =$this->order->latest()->paginate(5);
       return view('admin.order.manager_order',compact('customer','order'));
    }
    public function view_order($id)
    {
        //$customer = $this->order->customer()->find($id);
        $order =$this->order->find($id);
        $customer = $order->customer()->get();
        $shipping = $order->shipping()->get();
        $listDetail = $this->order_detail->where('order_id',$id)->get();
        return view('admin.order.orders',compact('shipping','customer','order','listDetail'));
    }
    public function delete_order($id)
    {
        $this->order->find($id)->delete();
        return redirect()->route('order.index');
    }
}
