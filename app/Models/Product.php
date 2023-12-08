<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'description',
        'price', 
        'image',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')
            ->withTimestamps();
    }

    public function order_item(){
        return $this->hasOne(OrderItem::class, 'user_id', 'id');   
    }

    public function cart_item(){
        return $this->hasOne(CartItem::class, 'user_id', 'id');   
    }
}


