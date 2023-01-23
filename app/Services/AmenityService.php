<?php

namespace App\Services;

use App\Models\Amenity;

class AmenityService
{
    public function create(array $data): Amenity
    {
        $amenity = new Amenity($data);
        $amenity->save();

        return $amenity;
    }

    public function edit(Amenity $amenity, array $data): void
    {
        $amenity->fill($data);
        $amenity->save();
    }

    public function delete(Amenity $amenity): void
    {
        $amenity->delete();
    }
}
