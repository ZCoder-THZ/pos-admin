<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function getProducts(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by product name
        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Retrieve products with related images and category
        $products = $query
            ->with([
                'images' => function ($query) {
                    $query->select('id', 'product_id', 'url'); // Select the specific fields from ProductImages
                },
                'category:category_name,id',
            ])
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

        return response()->json([
            'status' => $products,
        ]);
    }
    public function getProduct($id)
    {
        $product = Product::where('id', $id)
            ->with(['category:category_name,id'])
            ->with(['images:url,id,product_id'])
            ->get();

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
    public function filterProducts(Request $request)
    {
        try {
            $query = Product::query();

            // Filter by category if provided in the request
            if ($request->has('category')) {
                $category = Category::where('category_name', $request->category)->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                } else {
                    // Handle case where category does not exist
                }
            }

            // Execute the query
            $products = $query
                ->with([
                    'images' => function ($query) {
                        $query->select('id', 'product_id', 'url'); // Select the specific fields from ProductImages
                    },
                    'category:category_name,id',
                ])
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

            return response()->json(['products' => $products]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
