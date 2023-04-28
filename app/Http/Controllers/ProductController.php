<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //home Page
    public function home(){

            $products=Product::select('products.*','categories.category_name')
                        ->when(request('key'),function($query){
                         $query->where('products.product_name','like','%'.request('key').'%');
                         })->leftJoin('categories','categories.category_id','products.category_id')
                        ->paginate(4);
                          $products->appends(request()->all);

            return view('home',compact('products'));

    }
    // Create Product Page
    public function productCreatePage(){
            $categories=Category::get();

            return view('createProduct',compact('categories'));

    }
    //edit page
    public function editProductPage($id){

            $categories=Category::get();
        $product=Product::where('product_id',$id)->first();

        return view('editProductPage',compact('categories','product'));
    }
    // create product
    public function createProduct(Request $request){
       $this->productValidationCheck($request);

       $data=$this->getProductData($request);

       if($request->productImage==!null){

        $fileName=uniqid().'_'.$request->file('productImage')->getClientOriginalName();

        $data['product_image']=$fileName;

        $request->file('productImage')->storeAs('public',$fileName);
        }
        Product::create($data);

        return redirect()->route('product#homePage')->with(['createSuccess'=>'Created Successfully']);

    }
    //  update
    public function edit(Request $request){
        $product=Product::where('product_id',$request->productId)->first();
       $data=$this->getProductData($request);

        if($request->file('productImage')){
           if($product->product_image){ //delete storage image
                 Storage::delete('public/'.$product->product_image);
                 }

                 $fileName=uniqid().'_'.$request->file('productImage')->getClientOriginalName();
                 $data['product_image']=$fileName;
                 $request->file('productImage')->storeAs('public',$fileName);

        }
        // Product::where();
        Product::where('product_id',$request->productId)->update($data);
        // dd('image doesn\'exist');
        return redirect()->route('product#homePage')->with(['updateSuccess'=>'updated successfully']);

    }
    // delete
    public function deleteProduct($id){
        Product::where('product_id',$id)->delete();
        return redirect()->route('product#homePage')->with(['deleteSuccess'=>'deleted successfully']);

    }

    // production validation check
    public function productValidationCheck($request){
         Validator::make($request->all(),[
            'productName'=>'required|min:5',
            'productPrice'=>'required',
            'productDescription'=>'required',
            'productImage'=>'required',
            'categoryId'=>'required'
        ])->validate();
    }
    // get prodcutdata

    public function getProductData($request){
           return [
           'product_name'=>$request->productName,
           'product_brand'=>$request->productBrand,
           'product_price'=>$request->productPrice,
           'product_description'=>$request->productDescription,
           'category_id'=>$request->categoryId,


      ];
    }
}
