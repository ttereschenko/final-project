<?php

namespace App\Services;

use App\Models\Type;

class TypeService
{
    public function create(array $data): Type
    {
        $type = new Type($data);
        $type->save();

        return $type;
    }

    public function edit(Type $type, array $data): void
    {
        $type->fill($data);
        $type->save();
    }

    public function delete(Type $type): void
    {
        $type->delete();
    }
}
