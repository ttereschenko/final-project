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
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        private ImageService $imageService,
        private PropertyService $propertyService
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
            $search = '%' . $request->get('location') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('country', 'like', $search)
                    ->orwhere('city', 'like', $search);
            });
        }

        if ($request->has('check_in_date') || $request->has('check_out_date')) {
            $checkIn = $request->get('check_in_date');
            $checkOut = $request->get('check_out_date');

            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in_date', [$checkIn, $checkOut])
                    ->whereBetween('check_out_date', [$checkIn, $checkOut])
                    ->where('status', '=', 'confirmed');
            });
        }

        if ($request->has('guests')) {
            $search = '%' . $request->get('guests') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('guests', 'like', $search);
            });
        }

        if ($request->has('min_price') || $request->has('max_price')) {
            $min = $request->get('min_price') ?? $query->min('price');
            $max = $request->get('max_price') ?? $query->max('price');

            $query->where(function ($q) use ($min, $max) {
                $q->whereBetween('price', [$min, $max]);
            });
        }

        if ($request->has('types')) {
            $query->whereHas('type', function ($q) use ($request) {
                $q->whereIn('types.id', $request->get('types'));
            });
        }

        if ($request->has('amenities')) {
            $query->whereHas('amenities', function ($q) use ($request) {
                $q->whereIn('amenities.id', $request->get('amenities'));
            });
        }

        if ($request->has('facilities')) {
            $query->whereHas('facilities', function ($q) use ($request) {
                $q->whereIn('facilities.id', $request->get('facilities'));
            });
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
