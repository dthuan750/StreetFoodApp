<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $status = request('status', 1);
        $orders = Order::orderBy('id','DESC')->where('status', $status)->paginate();
        return view('admin.order.index', compact('orders'));
    }
    
    public function show(Order $order){
        $auth = $order->customer;
        return view('admin.order.detail', compact('auth','order'));
    }

    public function update(Order $order){
        $status = request('status', 1);
        if($order->status != 2){
            $order->update(['status' => $status]);
            return redirect()->route('order.index')->with('ok','Cập nhật trạng thái thành công');
        }
        return redirect()->route('order.index')->with('no','Không thể cập nhật đơn hàng đã giao');
    }
}
