<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'shopping_session',
        'ip_address',
        'quantity',
        'total',
        'option_total',
        'option_quantity',
        'created_at',
        'updated_at',
    ];
 
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cart_items(){
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
    
}
