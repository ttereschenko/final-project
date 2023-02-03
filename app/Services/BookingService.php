<?php

namespace App\Services;

use App\Events\BookingRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use DateTime;

class BookingService
{
    public function create(array $data, Property $property, User $user): ?Booking
    {
        $bookedProperty = new Booking($data);

        $bookedProperty->user()->associate($user);
        $bookedProperty->property()->associate($property);
        $bookedProperty->total_price = $this->calculateTotalPrice($data, $property);

        $bookedProperty->save();

        $event = new BookingRequest($property, $bookedProperty);
        event($event);

        return $bookedProperty;
    }

    public function confirm(Booking $booking): void
    {
        $booking->status = 'confirmed';
        $booking->save();
    }

    public function cancel(Booking $booking): void
    {
        $booking->status = 'canceled';
        $booking->save();
    }

    public function disabledDates(Property $property): array
    {
        $bookings = Booking::query()
            ->where('property_id', '=', $property->id)
            ->where('status', '=', 'confirmed')
            ->get();

        $disabled = [];

        foreach ($bookings as $booking) {
            $start = DateTime::createFromFormat('Y-m-d H:i:s', $booking->check_in_date);
            $end = DateTime::createFromFormat('Y-m-d H:i:s', $booking->check_out_date);

            while ($start < $end) {
                $disabled[] = $start->format('d-m-Y');
                $start->modify("+1 day");
            }
        }
        return $disabled;
    }

    public function calculateTotalPrice(array $data, Property $property): float
    {
        $start = DateTime::createFromFormat('d M Y', $data['check_in_date']);
        $end = DateTime::createFromFormat('d M Y', $data['check_out_date']);

        $nights = [];

        while ($start < $end) {
            $nights[] = $start->format('d-m-Y');
            $start->modify("+1 day");
        }

        $total = count($nights) * $property->price;

        return round($total, 2);
    }
}
