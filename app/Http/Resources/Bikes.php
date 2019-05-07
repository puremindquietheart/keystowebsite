<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Bikes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bike_name' => $this->bike_name,
            'bike_price' => $this->bike_price,
            'bike_quantity' => $this->bike_quantity,
            'bike_discount' => $this->bike_discount,
            'bike_rating' => $this->bike_rating,
            'bike_available' => $this->bike_available,
            'date_added' => $this->date_added
        ];
    }
}
