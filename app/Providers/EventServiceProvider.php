<?php

namespace App\Providers;

use App\Events\BookingRequest;
use App\Events\UserLoggedIn;
use App\Listeners\SendLoginAlert;
use App\Listeners\SendNotificationToOwner;
use App\Models\Booking;
use App\Observers\BookingObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        BookingRequest::class => [
            SendNotificationToOwner::class,
        ],

        UserLoggedIn::class => [
            SendLoginAlert::class,
        ],
    ];

//    protected $observers = [
//        Booking::class => [BookingObserver::class],
//    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
//        Booking::observe(BookingObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
