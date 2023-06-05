<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

        //
     public $orderCode; // Declare the property without initializing it

    public function __construct()
    {
        $this->orderCode = time() . Str::random(5); // Initialize the property in the constructor
    }


     public function createOrderAndItems(Request $request)
    {
        $orderCode = time() . Str::random(5); // Generate order code
        $order=$request->input('order');
        // $sailDate=$request->input('sailDate');


        $items=$request->input('item');
        logger($items,$order);
        // Create order in the Order table
        $order = Order::create([
            'user_id' => $order['userId'],
            'total_price' => $order['totalPrice'],
            'sail_date'=>$order['sailDate'],
            'order_code' => $orderCode // Use the generated order code
        ]);

        // // Create order items in the OrderItem table
        foreach ($items as $item) {
            OrderItem::create([
                'product_id' => $item['productId'],
                'user_id' => $item['userId'],
                'quantity' => $item['quantity'],
                'total_price' => $item['totalPrice'], //subtotal
                'order_code' => $orderCode // Use the same order code for all order items
            ]);
        }

        // Return response
        return response()->json([
            "message" => 'Order and order items created successfully',
            "order" => $items
        ]);
    }

    //
    public function getOrder(Request $request){
        $orders=Order::where('user_id',$request->userId)->get();
        return response()->json([
                "orders"=>$orders
        ]);

    }
    //
    public function getOrderItems(Request $request){
        $orderItems=OrderItem::where('user_id',$request->userId)
                            ->join('products','products.product_id','order_items.product_id')
                            ->select('order_items.*','products.product_name',)
                            ->get();

            return response()->json([
                "orders-items"=>$orderItems
        ]);


    }
    // get orderitem sby order code
public function getOrderItemsByOrderCode($orderCode){
    $dbOrderItems = OrderItem::where('order_code', $orderCode)->join('products','products.product_id','order_items.product_id')->select('order_items.*','products.product_name','products.product_image','products.product_price')->get();
    // Alternatively, you can use the following syntax:
    // $orderItems = OrderItem::where('order_code', $orderCode)->get();

    // You can also add logging to debug the query and results
    logger($orderCode);

   $orderItems = [];
foreach ($dbOrderItems as $item) {
    // Create a new item with modified attribute
    $newItem = $item;
    if (strpos($newItem->product_image, 'https://images.unsplash.com/') === 0) {
        // If product image starts with unsplash.com, don't modify it
         $newItem->product_image=$item->product_image;
    } else {
        // If product image doesn't start with unsplash.com, modify the URL
        $newItem->product_image = "http://127.0.0.1:8000/storage/" . $item->product_image;
    }
    // Push the new item into the new array
    $orderItems[] = $newItem;
}


    logger($orderItems);
    return response()->json([
        "orderItems" => $orderItems,
        "message" => 'success'
    ]);
}

// delete order and items by id
// 1 id is orderId whitch means string value
 public function deleteOrderAndItems($id){
    try {
        $order = Order::where('order_code', $id)->first();
        $orderItem = OrderItem::where('order_code', $id)->first();

        if ($order && $orderItem) {
            Order::where('order_code', $id)->delete();
         OrderItem::where('order_code', $id)->delete();
         $data = Order::all();
               $data = $data->filter(function ($order) use ($id) {
            return $order->order_code !== $id;
        });
            return response()->json(["message" => "Order and associated items deleted successfully","data"=>$data]);
        } else {
            return response()->json(["error" => "Order or associated items not found"], 404);
        }
    } catch (\Exception $e) {
        return response()->json(["error" => "Failed to delete order and items: " . $e->getMessage()], 500);
    }
}



}
