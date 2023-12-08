<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'order_no',
        'delivery_status',
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

    public function order_items(){
        return $this->hasMany(CartItem::class, 'order_id', 'id');
    }

}
