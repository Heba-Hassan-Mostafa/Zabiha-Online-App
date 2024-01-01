<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'user_id'           => $this->user_id,
            'city_id '          => $this->city_id ,
            'address'           => $this->address,
            'long'              => $this->long,
            'lat'               => $this->lat,

        ];
    }
}
