<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function delete(Image $image)
    {
        $this->imageService->delete($image);

        session()->flash('success', 'Successfully deleted');

        return redirect()->route('property.edit', ['property' => $image->property_id]);
    }
}
