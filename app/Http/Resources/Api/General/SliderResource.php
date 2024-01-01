<?php

namespace App\Http\Resources\Api\General;

use App\Http\Resources\Api\Categories\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'file_name'  => $this->file_name,
            'product'    =>new ProductResource($this->whenLoaded('product')),
            'url'        => $this->url,
            'status'     => $this->status
        ];
    }
}
