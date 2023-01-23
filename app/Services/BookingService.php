<?php

namespace App\Services;

use App\Events\BookingRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;

class BookingService
{
    public function create(array $data, Property $property, User $user): ?Booking
    {
        $checkIn = $data['check_in_date'];
        $checkOut = $data['check_out_date'];

        $booking = Booking::query()
            ->where('property_id', '=', $property->id)
            ->whereBetween('check_in_date', [$checkIn, $checkOut])
            ->whereBetween('check_out_date', [$checkIn, $checkOut])
            ->where('status', '=', 'confirmed');

        if (!$booking->exists()) {
            $bookedProperty = new Booking($data);

            $bookedProperty->user()->associate($user);
            $bookedProperty->property()->associate($property);

            $bookedProperty->save();

            $event = new BookingRequest($property, $bookedProperty);
            event($event);

            return $bookedProperty;
        }
        return null;
    }

    public function confirm(Booking $booking): void
    {
        Booking::query()
            ->where('id', '=', $booking->id)
            ->update(['status' => 'confirmed']);
    }

    public function cancel(Booking $booking): void
    {
        Booking::query()
            ->where('id', '=', $booking->id)
            ->update(['status' => 'canceled']);
    }
}
