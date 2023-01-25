<?php

namespace App\Services;

use App\Events\BookingRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BookingService
{
    public function create(array $data, Property $property, User $user): ?Booking
    {
        $checkIn = Carbon::parse($data['check_in_date'])->format('Y-m-d');
        $checkOut =  Carbon::parse($data['check_out_date'])->format('Y-m-d');

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

//    public function disabledDates (Property $property)
//    {
//        $booking = Booking::query()
//            ->where('property_id', '=', $property->id)
//            ->where('status', '=', 'confirmed');
//
//        $checkIn =  Carbon::createFromFormat('Y/m/d',$booking->get('check_in_date'));
//        $checkOut = Carbon::createFromFormat('Y/m/d', $booking->get('check_out_date'));
//
//        $disabledDates = CarbonPeriod::create($checkIn, $checkOut);
//
//        dd($checkIn);
//    }
}
