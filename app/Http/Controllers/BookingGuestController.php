<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CreateRequest;
use App\Models\Booking;
use App\Models\Property;
use App\Services\BookingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookingGuestController extends Controller
{
    public function __construct(private BookingService $bookingService)
    {
    }

    public function list(): View
    {
        $user = auth()->user();

        $bookings = Booking::query()
            ->where('user_id', '=', $user->id)
            ->latest()->paginate();

        return view('booking.guest.list', compact('bookings'));
    }

    public function createRequest(Property $property, CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $bookedProperty = $this->bookingService->create($data, $property, $user);

        if ($bookedProperty) {
            session()->flash('success', 'booking request was created');
        }

        return redirect()->route('property.show', ['property' => $property]);
    }
}
