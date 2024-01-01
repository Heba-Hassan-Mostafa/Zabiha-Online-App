<?php

namespace App\Http\Resources\Api\Orders;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Resources\Api\General\UserResource;
use App\Http\Resources\Api\Orders\OrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'                 => $this->data ,
            'created_at'           => $this->created_at->diffforhumans(),
            'logo'                 =>asset(Setting::where('key', 'logo')->first()->value)
        ];
    }
}
