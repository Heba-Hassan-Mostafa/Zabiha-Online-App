<?php

namespace App\Http\Resources\Api\General;

use Illuminate\Http\Request;
use App\Http\Resources\Api\General\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'city'       => new CityResource($this->whenLoaded('city')),
        ];
    }
}
