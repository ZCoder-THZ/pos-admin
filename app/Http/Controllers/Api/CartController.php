<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    //create order to show the customer what he orderd
    // cart data [productid,userid,total price,]
    // 2nd orderItem out
    // total Price ordered Id
    public function addToCart(Request $request){
        return response()->json([
            "message"=>'ites work'
        ]);
    }
}
