<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
        'product_total',
        'option_name',
        'option_total',
        'option_quantity',
        'created_at',
        'updated_at',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
