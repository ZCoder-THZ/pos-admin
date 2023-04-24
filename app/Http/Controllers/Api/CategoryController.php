<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function getCategory(){
        $category=Category::get();
        return response()->json([
            "status"=>"success",
            "category"=>$category
        ]);
    }
}
