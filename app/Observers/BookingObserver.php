<?php

namespace App\Observers;

use App\Mail\Booking\CanceledRequest;
use App\Mail\Booking\ConfirmedRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class BookingObserver
{
    /**
     * Handle the Booking "updated" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function updated(Booking $booking): void
    {
        $isStatusChanged = $booking->wasChanged('status');
//        $isStatusChanged = $booking->status !== $booking->getOriginal('status');

        if ($isStatusChanged) {
            if ($booking->status === 'confirmed') {
                Mail::to($booking->user->email)->send(new ConfirmedRequest($booking));
            }

            if ($booking->status === 'canceled') {
                Mail::to($booking->user->email)->send(new CanceledRequest($booking));
            }
        }
    }
}
