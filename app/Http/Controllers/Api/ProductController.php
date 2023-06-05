<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function getProducts (Request $request){

    //    $products= Product::when(request('search'),function($query){
    //     $query->where('product_name', 'like', '%' . request('search') . '%');
    //     })->get();
        $products=Product::where('product_name','like','%'.$request->search.'%')->get();
        logger(request('search'));
        return response()->json([
            'status'=>$products
        ]);
    }
    public function getProduct($id){
        $product=Product::where('product_id',$id)->first();
        return response()->json([
                'product'=>$product
        ]);
    }
    public function searchProduct(Request $request){
        logger($request->all());
        return response()->json([
                'searchItem'=>$request->all()
        ]);
    }
    public function getRandomProducts(){
        $random=Product::inRandomOrder()->take(4)->get();

        return response()->json([
                "random"=>$random
        ]);

    }
}
