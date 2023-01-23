<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Services\BookingService;

class BookingOwnerController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    public function list()
    {
        $user = auth()->user();

        $bookings = Property::query()
            ->where('user_id', '=', $user->id)
            ->whereHas('bookings')
            ->latest()->paginate();

        return view('booking.owner.list', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('booking.owner.request', compact('booking'));
    }

    public function confirm(Booking $booking)
    {
        $this->bookingService->confirm($booking);

        session()->flash('success', 'Booking was Confirmed');

        return redirect()->route('main');
    }

    public function cancel(Booking $booking)
    {
        $this->bookingService->cancel($booking);

        session()->flash('error', 'Booking was Canceled');

        return redirect()->route('main');
    }
}