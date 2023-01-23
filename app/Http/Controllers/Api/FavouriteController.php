<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteResource;
use App\Models\Property;
use App\Services\FavouriteService;

class FavouriteController extends Controller
{
    public function __construct(private FavouriteService $favouriteService)
    {
    }

    public function add(Property $property): FavouriteResource
    {
        $user = auth()->user();

        $favoriteProperty = $this->favouriteService->add($property, $user);

        return new FavouriteResource($favoriteProperty);
    }

    public function delete(Property $property)
    {
        $user = auth()->user();

        $this->favouriteService->delete($property, $user);

        $data = [
            'message' => 'Item was successfully deleted from wishlist!'
        ];

        return response($data, 200);
    }
}
