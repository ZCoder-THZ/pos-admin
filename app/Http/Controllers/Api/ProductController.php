<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function getProducts(Request $request)
    {
        $products = Product::where('product_name', 'like', '%' . $request->search . '%')
            ->with([
                'images' => function ($query) {
                    $query->select('id', 'product_id', 'url'); // Select the specific fields from ProductImages
                },
            ])
            ->with(['category:category_name,id'])
            ->get()
            ->map(function ($product) {
                if ($product->images->isNotEmpty()) {
                    $product->product_image = $product->images->first()->url;
                } else {
                    $product->product_image = null;
                }
                unset($product->images); // Unset the images relation
                return $product;
            });

        logger(request('search'));
        return response()->json([
            'status' => $products,
        ]);
    }
    public function getProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json([
            'product' => $product,
        ]);
    }
    public function searchProduct(Request $request)
    {
        logger($request->all());
        return response()->json([
            'searchItem' => $request->all(),
        ]);
    }
    public function getRandomProducts()
    {
        $random = Product::inRandomOrder()->take(4)->get();

        return response()->json([
            'random' => $random,
        ]);
    }
}
