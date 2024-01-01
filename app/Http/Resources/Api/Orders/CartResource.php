<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use App\Http\Resources\Api\General\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Categories\ProductResource;

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

            'id'             => $this->id,
            'product'        => new ProductResource($this->whenLoaded('product')),
            'user'           => new UserResource($this->whenLoaded('user')),
            'price'          => $this->price * $this->quantity ,
            'quantity'       => $this->quantity,
            'note'           => $this->note,
            'options'        =>json_decode($this->options, true)

        ];
    }
}
