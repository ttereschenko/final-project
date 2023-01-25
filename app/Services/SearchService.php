<?php

namespace App\Services;



use Carbon\Carbon;

class SearchService
{
    public function searchByLocation($query, $request): void
    {
        $search = '%' . $request->get('location') . '%';
        $query->where(function ($q) use ($search) {
            $q->where('country', 'like', $search)
                ->orwhere('city', 'like', $search);
        });
    }

    public function searchByDates($query, $request): void
    {
        $checkIn = Carbon::parse($request->get('check_in_date'))->format('Y-m-d');
        $checkOut = Carbon::parse($request->get('check_out_date'))->format('Y-m-d');

        $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
            $q->whereBetween('check_in_date', [$checkIn, $checkOut])
                ->whereBetween('check_out_date', [$checkIn, $checkOut])
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

    public function searchByPriceRange($query, $request): void
    {
        $min = $request->get('min_price') ?? $query->min('price');
        $max = $request->get('max_price') ?? $query->max('price');

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
