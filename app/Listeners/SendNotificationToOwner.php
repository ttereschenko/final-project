<?php

namespace App\Listeners;

use App\Events\BookingRequest;
use App\Mail\Booking\OwnerNotification;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;

class SendNotificationToOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Property $property, Booking $booking)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingRequest  $event
     * @return void
     */
    public function handle(BookingRequest $event): void
    {
        Mail::to($event->property->user->email)->send(new OwnerNotification($event->property, $event->booking));
    }
}
