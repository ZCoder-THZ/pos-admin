<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'product_description', 'product_price', 'category_id', 'product_image', 'product_brand'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
