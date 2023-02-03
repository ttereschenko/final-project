<?php

namespace App\Http\Controllers;

use App\Http\Requests\Amenity\CreateRequest;
use App\Http\Requests\Amenity\EditRequest;
use App\Models\Amenity;
use App\Services\AmenityService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AmenityController extends Controller
{
    public function __construct(private AmenityService $amenityService)
    {
    }

    public function createForm(): View
    {
        return view('amenity.create');
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->amenityService->create($data);

        session()->flash('success', 'Item was successfully added');

        return redirect()->route('amenity.list');
    }

    public function list(): View
    {
        $amenities = Amenity::query()->paginate();

        return view('amenity.list', compact('amenities'));
    }

    public function editForm(Amenity $amenity): View
    {
        return view('amenity.edit', compact('amenity'));
    }

    public function edit(Amenity $amenity, EditRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->amenityService->edit($amenity, $data);

        session()->flash('success', 'Item was successfully edited!');

        return redirect()->route('amenity.list');
    }

    public function delete(Amenity $amenity): RedirectResponse
    {
        $this->amenityService->delete($amenity);

        session()->flash('success', 'Item was successfully deleted!');

        return redirect()->route('amenity.list');
    }
}
