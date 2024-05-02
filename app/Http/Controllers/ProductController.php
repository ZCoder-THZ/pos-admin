<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateProductRequest;
class ProductController extends Controller
{
    //home Page
    public function home()
    {
        $products = Product::select('products.*', 'categories.category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.product_name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->paginate(4);
        $products->appends(request()->all);
        // dd($products);
        return view('home', compact('products'));
    }
    // Create Product Page
    public function productCreatePage()
    {
        $categories = Category::get();

        return view('createProduct', compact('categories'));
    }
    //edit page
    public function editProductPage($id)
    {
        $categories = Category::get();
        $product = Product::where('id', $id)->first();
        return view('editProductPage', compact('categories', 'product'));
    }
    // create product
    public function createProduct(CreateProductRequest $request)
    {
        // $this->productValidationCheck($request);
        $validated = $request->validated();

        $data = $this->getProductData($request);
        // if ($request->productImage == !null) {
        //     $fileName = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();

        //     $data['product_image'] = $fileName;

        //     $request->file('productImage')->storeAs('public', $fileName);
        // }
        $product = Product::create($data);
        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('posts', 'public');
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->url = $filename;
                $productImage->save();
                $imageUrls[] = $filename;
            }
        }
        return redirect()
            ->route('product#homePage')
            ->with(['createSuccess' => 'Created Successfully']);
    }
    //  update
    public function edit(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        $data = $this->getProductData($request);

        if ($request->file('productImage')) {
            if ($product->product_image) {
                //delete storage image
                Storage::delete('public/' . $product->product_image);
            }

            $fileName = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();
            $data['product_image'] = $fileName;
            $request->file('productImage')->storeAs('public', $fileName);
        }
        // Product::where();
        Product::where('id', $request->productId)->update($data);
        // dd('image doesn\'exist');
        return redirect()
            ->route('product#homePage')
            ->with(['updateSuccess' => 'updated successfully']);
    }
    // delete
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect()
            ->route('product#homePage')
            ->with(['deleteSuccess' => 'deleted successfully']);
    }

    // production validation check
    public function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'productName' => 'required|min:5',
            'productPrice' => 'required',
            'productDescription' => 'required',
            'productImage' => 'required',
            'categoryId' => 'required',
        ])->validate();
    }
    // get prodcutdata

    public function getProductData($request)
    {
        return [
            'product_name' => $request->productName,
            'product_brand' => $request->productBrand,
            'product_price' => $request->productPrice,
            'product_description' => $request->productDescription,
            'category_id' => $request->categoryId,
        ];
    }

    public function viewByCategory($id)
    {
        $products = Product::select('products.*', 'categories.category_name')->where('products.category_id', $id)->leftJoin('categories', 'categories.id', 'products.category_id')->paginate(4);
        $products->appends(request()->all);
        return view('home', compact('products'));
    }
}
