<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'code' => $this->code,
            'access_level' => $this->access_level,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'delivery_phone' => $this->delivery_phone,
            'delivery_email' => $this->delivery_email,
            'delivery_address' => $this->delivery_address,
            'delivery_city' => $this->delivery_city,
            'delivery_country' => $this->delivery_country,
            'delivery_message' => $this->delivery_message,
        ];
    }
   
}
