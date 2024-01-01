<?php

namespace App\Http\Resources\Api\General;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityShippingCostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            =>$this->id,
            'name_ar'       => $this->name_ar,
            'name_en'       => $this->name_en,
            'shipping_cost' =>$this->shipping_cost
        ];
    }
}
