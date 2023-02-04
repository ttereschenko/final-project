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
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'country' => new CountryResource($this->country),
            'city' => new CityResource($this->city),
            'street' => $this->address,
            'house_number' => $this->house_number,
            'price' => $this->price,
            'currency' => $this->currency,
            'rooms' => $this->rooms,
            'beds' => $this->beds,
            'guests' => $this->guests,
            'user' => new UserResource($this->user),
            'types' => new TypeResource($this->type),
            'amenities' => AmenityResource::collection($this->amenities),
            'facilities' => FacilityResource::collection($this->facilities),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
