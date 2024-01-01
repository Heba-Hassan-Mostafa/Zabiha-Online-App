<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use App\Http\Resources\Api\General\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Orders\LocationResource;
use App\Http\Resources\Api\Categories\ProductResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'user'              => new UserResource($this->whenLoaded('user')),
            'products'          =>  ProductResource::collection($this->whenLoaded('products')),
            'location'          => new LocationResource($this->whenLoaded('location')),
            'order_number'      => $this->order_number,
            'delivery_date'     => $this->delivery_date,
            'delivery_time_id'  => $this->delivery_time_id,
            'delivery_type'     => $this->delivery_type,
            'subtotal'          => $this->subtotal,
            'total'             => $this->total,
            'order_status'      => $this->order_status,
            'note'              => $this->note,

        ];
    }
}
