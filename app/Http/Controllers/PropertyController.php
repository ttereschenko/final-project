<?php

namespace App\Http\Controllers;

use App\Http\Requests\Property\CreateRequest;
use App\Http\Requests\Property\EditRequest;
use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Type;
use App\Models\User;
use App\Services\ImageService;
use App\Services\PropertyService;
use App\Services\SearchService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        private ImageService $imageService,
        private PropertyService $propertyService,
        private SearchService $searchService,
    ) {
    }

    public function createForm()
    {
        $amenities = Amenity::all();
        $types = Type::all();
        $facilities = Facility::all();

        return view('property.create', compact('amenities', 'types', 'facilities'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $property = $this->propertyService->create($data, $user);

        $files = $request->file('images');

        if ($request->hasFile('images')) {
            $this->imageService->create($files, $property);
        }

        if ($user->role !== 'owner') {
            User::query()
                ->where('id', '=', $user->id)
                ->update(['role' => 'owner']);
        }

        session()->flash('success', 'Item was successfully added');

        return redirect()->route('property.show', ['property' => $property->id]);
    }

    public function list(Request $request)
    {
        $query = Property::query()->with(['user', 'type'])->latest();

        if ($request->has('location')) {
            $this->searchService->searchByLocation($query, $request);
        }

        if ($request->has('check_in_date') || $request->has('check_out_date')) {
           $this->searchService->searchByDates($query, $request);
        }

        if ($request->has('guests')) {
            $this->searchService->searchByGuestQuantity($query, $request);
        }

        if ($request->has('min_price') || $request->has('max_price')) {
            $this->searchService->searchByPriceRange($query, $request);
        }

        if ($request->has('types')) {
            $this->searchService->filterByPropertyTypes($query, $request);
        }

        if ($request->has('amenities')) {
            $this->searchService->filterByAmenities($query, $request);
        }

        if ($request->has('facilities')) {
            $this->searchService->filterByFacilities($query, $request);
        }

        $properties = $query->paginate()->appends($request->query());

        $amenities = Amenity::all();
        $types = Type::all();
        $facilities = Facility::all();

        return view('property.list', compact('properties', 'amenities', 'types', 'facilities'));
    }

    public function show(Property $property)
    {
        return view('property.show', compact('property'));
    }

    public function editForm(Property $property)
    {
        $amenities = Amenity::all();
        $types = Type::all();
        $facilities = Facility::all();

        return view('property.edit', compact('property', 'amenities', 'types', 'facilities'));
    }

    public function edit(Property $property, EditRequest $request)
    {
        $data = $request->validated();
        $files = $request->file('images');

        if ($request->hasFile('images')) {
            $this->imageService->create($files, $property);
        }

        $this->propertyService->edit($property, $data);

        session()->flash('success', 'Item was successfully edited');

        return redirect()->route('property.show', ['property' => $property->id]);
    }

    public function delete(Property $property)
    {
        $this->propertyService->delete($property);

        session()->flash('success', 'Item was successfully deleted');

        return redirect()->back();
    }
}
