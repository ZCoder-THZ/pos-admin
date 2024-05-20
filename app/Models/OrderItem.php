<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_item_id', 'user_id', 'product_id', 'quantity', 'total_price', 'order_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
