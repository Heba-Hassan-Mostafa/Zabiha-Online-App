<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductQuantityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 

            'id'             => $this->id,
            'name'           => $this->name,
            'category_id'    => $this->category_id,
            'city_id'        => $this->city_id,
            'city_name'      => $this->city->name,
            'description'    => $this->description,
            'image'          => $this->image,
            'main_price'     => $this->main_price,
            'discount_price' => $this->discount_price,
            'store_quantity' => $this->store_quantity,
            'status'         => $this->status,

            'order_quantity' => $this->pivot->quantity
        ];
    }
}
