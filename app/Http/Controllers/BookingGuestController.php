<?php

namespace App\Http\Controllers;

use App\Events\BookingRequest;
use App\Http\Requests\Booking\CreateRequest;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Type;
use App\Services\BookingService;

class BookingGuestController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    public function list()
    {
        $user = auth()->user();

        $bookings = Booking::query()
            ->where('user_id', '=', $user->id)
            ->latest()->paginate();

        return view('booking.guest.list', compact('bookings'));
    }

    public function createRequest(Property $property, CreateRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $bookedProperty = $this->bookingService->create($data, $property, $user);

        if ($bookedProperty) {
            session()->flash('success', 'booking request was created');
        }

//        $disabledDates = $this->bookingService->disabledDates($property);

        return redirect()->route('property.show', ['property' => $property]);
    }
}
