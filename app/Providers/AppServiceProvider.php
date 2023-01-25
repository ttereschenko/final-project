<?php

namespace App\Providers;

use App\Models\Favourite;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('admin', function () {
            return auth()?->user()?->role === User::ROLE_ADMIN;
        });

        Blade::if('owner', function () {
            return auth()?->user()?->role === User::ROLE_OWNER || auth()?->user()?->role === User::ROLE_ADMIN;
        });

        Blade::if('guest', function () {
            return auth()?->user()?->role === User::ROLE_GUEST;
        });

        Blade::if('favourite', function ($property) {
            $user = auth()?->user()?->id;
            $favourite = Favourite::query()
                ->where('property_id', '=', $property->id)
                ->where('user_id', '=', $user);

            return $favourite->exists();
        });

        Blade::if('notFavourite', function ($property) {
            $user = auth()?->user()?->id;
            $favourite = Favourite::query()
                ->where('property_id', '=', $property->id)
                ->where('user_id', '=', $user);

            return !$favourite->exists();
        });
    }
}
