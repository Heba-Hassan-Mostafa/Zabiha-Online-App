<?php

namespace App\Http\Resources\Api\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionValueResource extends JsonResource
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
            'value'          => $this->value,
            'price'          => $this->price,
            'option'         => $this->option->name,
            
        ];
    }
}
