<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Property;

class ImageService
{
    public function create(array $files, Property $property)
    {
        foreach ($files as $file) {
            $image = new Image();

            $path = $file->store('/images/resource/' . $property->id, ['disk' => 'my_files']);

            $image->url = $path;
            $image->property()->associate($property);

            $image->save();
        }
    }

    public function delete(Image $image): void
    {
        $image->delete();

//        Storage::delete($image->url);
    }
}
