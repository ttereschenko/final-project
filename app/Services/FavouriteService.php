<?php

namespace App\Services;

use App\Models\Favourite;
use App\Models\Property;
use App\Models\User;

class FavouriteService
{
    public function add(Property $property, User $user): ?Favourite
    {
        $favourite = Favourite::query()
            ->where('property_id', '=', $property->id)
            ->where('user_id', '=', $user->id);

        if (!$favourite->exists()) {
            $favoriteProperty = new Favourite();

            $favoriteProperty->user()->associate($user);
            $favoriteProperty->property()->associate($property);

            $favoriteProperty->save();

            return $favoriteProperty;
        }

        return null;
    }

    public function delete(Property $property, User $user): void
    {
        $favourite = Favourite::query()
            ->where('property_id', '=', $property->id)
            ->where('user_id', '=', $user->id);

        if ($favourite->exists()) {
            $favourite->delete();
        }
    }
}
