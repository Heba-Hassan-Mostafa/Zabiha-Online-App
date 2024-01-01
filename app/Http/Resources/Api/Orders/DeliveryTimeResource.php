<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'id'     => $this->id,
            'from'   =>$this->from,
            'to'     =>$this->to
        ];
    }
}
