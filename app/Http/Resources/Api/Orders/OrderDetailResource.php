<?php

namespace App\Http\Resources\Api\Orders;

use App\Models\City;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Resources\Api\General\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Orders\LocationResource;
use App\Http\Resources\Api\Orders\ProductQuantityResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cityId = $this->location->city_id;

        $city = City::where('id',$cityId,function($q){

             $q->where('shipping_cost','!=',null)
             ->orWhere('shipping_cost','!=',0);

        })->first();

        return [
            'id'                => $this->id,
            'user'              => new UserResource($this->whenLoaded('user')),
            'products'          =>  ProductQuantityResource::collection($this->whenLoaded('products')),
            'location'          => new LocationResource($this->whenLoaded('location')),
            'order_number'      => $this->order_number,
            'delivery_date'     => $this->delivery_date,
            'delivery_time'     => new DeliveryTimeResource($this->whenLoaded('delivery_time')),
            'delivery_type'     => $this->delivery_type,
            'subtotal'          => $this->subtotal,
            'total'             => $this->total,
            'order_status'      => $this->order_status,
            'note'              => $this->note,
            'value_added'       => Setting::where('key', 'value_added')->first()->value,
            'shipping_cost'     => $city->shipping_cost,
            'coupon_discount'   =>  $this->subtotal -  ($this->total - $city->shipping_cost)
                                
        ];
    }
}
