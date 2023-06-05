<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $users=User::get();
        $products=Product::get();
        $categories=Category::get();
        $orders=Order::get();

        return view('dashboard',compact('users','products','categories','orders'));
    }
}
