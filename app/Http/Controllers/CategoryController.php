<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //create Category Page
    public function createCategoryPage(){
        return view('createCategory');
    }
    // create Category
    public function createCategory(Request $request){

        Category::create([
            'category_name'=>$request->categoryName

        ]);
      return redirect()->route('product#homePage');
    }
    //
    public function categoryList(){
        $categories=Category::get();
        return view('categoryList');
    }
}
