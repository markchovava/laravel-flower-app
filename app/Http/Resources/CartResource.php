<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CartResource extends JsonResource
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
            'shopping_session' => $this->shopping_session,
            'ip_address' => $this->ip_address,
            'quantity' => $this->quantity,
            'total' => $this->total,
            'option_total' => $this->option_total,
            'option_quantity' => $this->option_quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'cart_items' => new CartItemResource($this->whenLoaded('cart_items')),
        ];
    }
}


