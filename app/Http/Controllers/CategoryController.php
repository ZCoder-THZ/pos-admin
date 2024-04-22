<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //create Category Page
    public function createCategoryPage()
    {
        $categories = Category::paginate(10);

        return view('createCategory', compact('categories'));
    }
    // create Category
    public function createCategory(Request $request)
    {
        try {
            Category::create([
                'category_name' => $request->categoryName,
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating the category: ' . $e->getMessage());
        }
    }

    //
    public function categoryList()
    {
        $categories = Category::paginate(9);
        return view('categoryList', compact('categories'));
    }
    // delte
    public function deleteCategory($id)
    {
        $category = Category::where('', $id)->exists();

        if ($category) {
            Category::where('id', $id)->delete();

            return redirect()
                ->route('category#categoryList')
                ->with(['deleteSuccess' => 'deleted successfully']);
        }
    }
}
