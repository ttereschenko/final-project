<?php

namespace App\Services;

use App\Models\Facility;

class FacilityService
{
    public function create(array $data): Facility
    {
        $facility = new Facility($data);
        $facility->save();

        return $facility;
    }

    public function edit(Facility $facility, array $data): void
    {
        $facility->fill($data);
        $facility->save();
    }

    public function delete(Facility $facility): void
    {
        $facility->delete();
    }
}
