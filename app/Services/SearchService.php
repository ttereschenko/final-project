<?php

namespace App\Services;

use App\Models\City;
use Carbon\Carbon;

class SearchService
{
    public function searchByLocation($query, $request): void
    {
        $search = '%' . $request->get('location') . '%';

        $query->whereHas('country', function ($q) use ($search) {
            $q->where('countries.name', 'like', $search);
        });

//        $query->whereHas('city', function ($q) use ($search) {
//            $q->where('cities.name', 'like', $search);
//        });
    }

    public function searchByDates($query, $request): void
    {
        $start = Carbon::parse($request->get('check_in_date'))->format('Y-m-d');
        $end = Carbon::parse($request->get('check_out_date'))->format('Y-m-d');
// ???
        $query->whereDoesntHave('bookings', function ($q) use ($start, $end) {
            $q->whereBetween('check_in_date', [$start, $end])
                ->whereBetween('check_out_date', [$start, $end])
                ->where('status', '=', 'confirmed');
        });
    }

    public function searchByGuestQuantity($query, $request): void
    {
        $search = '%' . $request->get('guests') . '%';
        $query->where(function ($q) use ($search) {
            $q->where('guests', 'like', $search);
        });
    }

    public function searchByPrice($query, $request): void
    {
        $min = $request->get('min_price');
        $max = $request->get('max_price');

        $query->where(function ($q) use ($min, $max) {
            $q->whereBetween('price', [$min, $max]);
        });
    }

    public function filterByPropertyTypes($query, $request): void
    {
        $query->whereHas('type', function ($q) use ($request) {
            $q->whereIn('types.id', $request->get('types'));
        });
    }

    public function filterByAmenities($query, $request): void
    {
        $query->whereHas('amenities', function ($q) use ($request) {
            $q->whereIn('amenities.id', $request->get('amenities'));
        });
    }

    public function filterByFacilities($query, $request): void
    {
        $query->whereHas('facilities', function ($q) use ($request) {
            $q->whereIn('facilities.id', $request->get('facilities'));
        });
    }
}
