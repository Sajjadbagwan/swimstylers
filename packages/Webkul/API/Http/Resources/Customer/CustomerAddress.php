<?php

namespace Swim\API\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddress extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address1' => explode(PHP_EOL, $this->address1),
            'country' => $this->country,
            'country_name' => core()->country_name($this->country),
            'state' => $this->state,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}