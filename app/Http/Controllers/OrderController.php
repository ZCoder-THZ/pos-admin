<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrderList()
    {
        $orders = Order::select('orders.*', 'users.name', 'users.image')->join('users', 'users.id', 'orders.user_id')->paginate(3);

        return view('orderList', compact('orders'));
    }
    public function getOrderItems($order_code)
    {
        $orderItems = OrderItem::select('order_items.*', 'products.product_name', 'products.product_price', 'products.product_image')->where('order_code', $order_code)->join('products', 'products.id', 'order_items.product_id')->get();

        return view('orderItemsList', compact('orderItems'));
    }
    public function ajaxChangeStatus(Request $request)
    {
        $status = $request->status * 1;
        $orderId = $request->orderId * 1;
        Order::where('order_id', $orderId)->update([
            'status' => $status,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}
