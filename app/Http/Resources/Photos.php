<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Photos extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bike_id' => $this->bike_id,
            'photo_name' => $this->photo_name,
            'photo_file_name' => $this->photo_file_name,
            'photo_description' => $this->photo_description,
            'photo_status' => $this->photo_status
        ];
    }
}
