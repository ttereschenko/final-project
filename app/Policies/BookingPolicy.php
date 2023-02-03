<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Booking $booking): bool
    {
        return $user->id === $booking->property->user_id;
    }

    public function confirm(User $user, Booking $booking): bool
    {
        return $user->id === $booking->property->user_id;
    }

    public function cancel(User $user, Booking $booking): bool
    {
        return $user->id === $booking->property->user_id;
    }
}
