<?php

namespace App\Services;

use App\Models\Property;
use App\Models\User;

class PropertyService
{
    public function create(array $data, User $user): Property
    {
        $property = new Property($data);

        $property->user()->associate($user);
        $property->type()->associate($data['types']);
        $property->country()->associate($data['country']);
        $property->city()->associate($data['city']);

        $property->save();

        if (isset($data['amenities'])) {
            $property->amenities()->attach($data['amenities']);
        }
        if (isset($data['facilities'])) {
            $property->facilities()->attach($data['facilities']);
        }

        return $property;
    }

    public function edit(Property $property, array $data): void
    {
        $property->fill($data);

        $property->type()->associate($data['types']);
        $property->country()->associate($data['country']);
        $property->city()->associate($data['city']);

        if (isset($data['amenities'])) {
            $property->amenities()->sync($data['amenities']);
        }
        if (isset($data['facilities'])) {
            $property->facilities()->sync($data['facilities']);
        }

        $property->save();
    }

    public function delete(Property $property): void
    {
        $property->delete();
    }


}
