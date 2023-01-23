<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'country' => $this->country,
            'city' => $this->city,
            'house_number' => $this->house_number,
            'price' => $this->price,
            'currency' => $this->currency,
            'rooms' => $this->rooms,
            'beds' => $this->beds,
            'guests' => $this->guests,
            'user_id' => new UserResource($this->user),
            'type_id' => $this->type_id,
            'amenities' => AmenityResource::collection($this->amenities),
            'facilities' => AmenityResource::collection($this->facilities),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
