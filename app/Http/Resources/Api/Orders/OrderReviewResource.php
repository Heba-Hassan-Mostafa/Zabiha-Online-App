<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use App\Http\Resources\Api\General\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Categories\ProductResource;

class OrderReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'user'                 => new UserResource($this->whenLoaded('user')),
            'order'                => new OrderResource($this->whenLoaded('order')),
            'rate'                 => $this->rate,
            'comment'              =>$this->comment

        ];
    }
}
