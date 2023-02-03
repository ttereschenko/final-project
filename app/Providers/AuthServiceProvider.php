<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Type;
use App\Policies\AmenityPolicy;
use App\Policies\BookingPolicy;
use App\Policies\FacilityPolicy;
use App\Policies\PropertyPolicy;
use App\Policies\TypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        Type::class => TypePolicy::class,
        Amenity::class => AmenityPolicy::class,
        Facility::class => FacilityPolicy::class,
        Booking::class => BookingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
