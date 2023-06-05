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
        $categories=Category::paginate(9);
        return view('categoryList',compact('categories'));
    }
    // delte
    public function deleteCategory($id){
        $category=Category::where('category_id',$id)->exists();

        if($category){
        Category::where('category_id',$id)->delete();

            return redirect()->route('category#categoryList')->with(['deleteSuccess'=>'deleted successfully']);
        }

    }
}
