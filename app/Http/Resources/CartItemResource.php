<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'cart_id' => $this->cart_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_quantity' => $this->product_quantity,
            'product_price' => $this->product_price,
            'product_total' => $this->product_total,
            'option_name' => $this->option_name,
            'option_total' => $this->option_total,
            'option_quantity' => $this->option_quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cart' => new CartResource($this->whenLoaded('cart')),
            'user' => new UserResource($this->whenLoaded('user')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
