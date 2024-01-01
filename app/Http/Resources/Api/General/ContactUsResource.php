<?php

namespace App\Http\Resources\Api\General;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'     => $this->name,
            'phone'    => $this->phone,
            'message'  => $this->message
        ];
    }
}
