<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Property;
use App\Services\FavouriteService;

class FavouriteController extends Controller
{
    public function __construct(private FavouriteService $favouriteService)
    {
    }

    public function wishlist()
    {
        $user = auth()->user();

        $favourites = Favourite::query()
            ->where('user_id', '=', $user->id)
            ->latest()->paginate();

        return view('wishlist', compact('favourites'));
    }

    public function add(Property $property)
    {
        $user = auth()->user();

        $this->favouriteService->add($property, $user);

        session()->flash('success', 'Added to Wishlist');

        return redirect()->back();
    }

    public function delete(Property $property)
    {
        $user = auth()->user();

        $this->favouriteService->delete($property, $user);

        session()->flash('error', 'Deleted from Wishlist');

        return redirect()->back();
    }
}
