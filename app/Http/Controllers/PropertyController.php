<?php

namespace App\Http\Controllers;

use App\Http\Requests\Property\CreateRequest;
use App\Http\Requests\Property\EditRequest;
use App\Models\Amenity;
use App\Models\City;
use App\Models\Country;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Type;
use App\Services\BookingService;
use App\Services\ImageService;
use App\Services\PropertyService;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        private ImageService $imageService,
        private PropertyService $propertyService,
        private SearchService $searchService,
        private BookingService $bookingService
    ) {
    }

    public function createForm(): View
    {
        $countries = Country::all();
        $amenities = Amenity::all();
        $types = Type::all();
        $facilities = Facility::all();

        return view('property.create', compact('amenities', 'types', 'facilities', 'countries'));
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        $property = $this->propertyService->create($data, $user);

        $files = $request->file('images');

        if ($request->hasFile('images')) {
            $this->imageService->create($files, $property);
        }

        session()->flash('success', 'Item was successfully added');

        return redirect()->route('property.show', ['property' => $property->id]);
    }

    public function list(Request $request): View
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
            $this->searchService->searchByPrice($query, $request);
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

    public function show(Property $property): View
    {
        $disabled = $this->bookingService->disabledDates($property);

        return view('property.show', compact('property', 'disabled'));
    }

    public function editForm(Property $property): View
    {
        $countries = Country::all();
        $cities = City::all();
        $amenities = Amenity::all();
        $types = Type::all();
        $facilities = Facility::all();

        return view(
            'property.edit',
            compact('property', 'amenities', 'types', 'facilities', 'countries', 'cities')
        );
    }

    public function edit(Property $property, EditRequest $request): RedirectResponse
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

    public function delete(Property $property): RedirectResponse
    {
        $this->propertyService->delete($property);

        session()->flash('success', 'Item was successfully deleted');

        return redirect()->back();
    }

    public function fetchCity(Request $request): JsonResponse
    {
        $data['city'] = City::query()
            ->where('country_id', $request->country_id)
            ->get(['name', 'id']);

        return response()->json($data);
    }
}
