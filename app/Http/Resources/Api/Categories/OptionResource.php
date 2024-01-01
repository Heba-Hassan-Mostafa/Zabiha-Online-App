<?php

namespace App\Http\Resources\Api\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'input_type'  => $this->input_type,
            'option_values' => OptionValueResource::collection($this->whenLoaded('option_values'))
            
        ];
    }
}
