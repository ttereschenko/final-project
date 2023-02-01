<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingGuestController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BookingOwnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TypeController;
use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Type;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/verified_email/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login',  'loginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');

    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(PropertyController::class)->group(function () {
   Route::group(['prefix' => '/announcements', 'as' => 'property.'], function () {

       Route::get('/create', 'createForm')->name('create.form')->middleware('auth');
       Route::post('/create', 'create')->name('create')->middleware('auth');
       Route::post('/create/fetch-cities', 'fetchCity');

       Route::get('', 'list')->name('list');

       Route::prefix('/{property}')->group(function () {
           Route::get('', 'show')->name('show');

           Route::get('/edit', 'editForm')->name('edit.form')
               ->middleware( 'can:edit,property');
           Route::post('/edit', 'edit')->name('edit')
               ->middleware('can:edit,property');
           Route::post('/edit/fetch-cities', 'fetchCity');

           Route::post('/delete', 'delete')->name('delete')
               ->middleware('auth','can:delete,property');

       });
   });
});

Route::controller(AmenityController::class)->group(function () {
    Route::group(['prefix' => '/amenities', 'as' => 'amenity.'], function () {

        Route::get('/create', 'createForm')->name('create.form')
            ->middleware('can:create,' . Amenity::class);
        Route::post('/create', 'create')->name('create')
            ->middleware('can:create,' . Amenity::class);

        Route::get('', 'list')->name('list')
            ->middleware('can:list,' . Amenity::class);

        Route::prefix('/{amenity}')->group(function () {

            Route::get('/edit', 'editForm')->name('edit.form')
                ->middleware('can:edit,' . Amenity::class);
            Route::post('/edit', 'edit')->name('edit')
                ->middleware('can:edit,' . Amenity::class);

            Route::post('/delete', 'delete')->name('delete')
                ->middleware('can:delete,' . Amenity::class);
        });
    });
});

Route::controller(TypeController::class)->group(function () {
    Route::group(['prefix' => '/types', 'as' => 'type.'], function () {

        Route::get('/create', 'createForm')->name('create.form')
            ->middleware('can:create,' . Type::class);
        Route::post('/create', 'create')->name('create')
            ->middleware('can:create,' . Type::class);

        Route::get('', 'list')->name('list')
            ->middleware('can:list,' . Type::class);

        Route::prefix('/{type}')->group(function () {

            Route::get('/edit', 'editForm')->name('edit.form')
                ->middleware('can:edit,' . Type::class);
            Route::post('/edit', 'edit')->name('edit')
                ->middleware('can:edit,' . Type::class);

            Route::post('/delete', 'delete')->name('delete')
                ->middleware('can:delete,' . Type::class);
        });
    });
});

Route::controller(FacilityController::class)->group(function () {
    Route::group(['prefix' => '/facilities', 'as' => 'facility.'], function () {

        Route::get('/create', 'createForm')->name('create.form')
            ->middleware('can:create,' . Facility::class);
        Route::post('/create', 'create')->name('create')
            ->middleware('can:create,' . Facility::class);

        Route::get('', 'list')->name('list')
            ->middleware('can:list,' . Facility::class);

        Route::prefix('/{facility}')->group(function () {

            Route::get('/edit', 'editForm')->name('edit.form')
                ->middleware('can:edit,' . Facility::class);
            Route::post('/edit', 'edit')->name('edit')
                ->middleware('can:edit,' . Facility::class);

            Route::post('/delete', 'delete')->name('delete')
                ->middleware('can:delete,' . Facility::class);
        });
    });
});

Route::post('/{image}/delete', [ImageController::class, 'delete'])->name('image.delete');

Route::controller(OwnerController::class)->group(function () {
    Route::post('/', 'changeRole')->name('owner.start')
        ->middleware('auth');

    Route::get('/my-announcements', 'createdAnnouncementList')->name('owner.property.list')
        ->middleware('auth');

});

Route::controller(FavouriteController::class)->group(function () {
    Route::get('/wishlist', 'wishlist')->name('wishlist')->middleware('auth');

    Route::group(['prefix' => '/wishlist/{property}', 'as' => 'wishlist.'], function () {

        Route::post('/add', 'add')->name('add')
            ->middleware('auth', 'can:addToWishlist,property');

        Route::post('/delete', 'delete')->name('delete')
            ->middleware('auth', 'can:deleteFromWishlist,property');
    });
});

Route::controller(BookingGuestController::class)->group(function () {
    Route::get('/booking', 'list')->name('booking.list')->middleware('auth');

    Route::post('/{property}/booking/create', 'createRequest')->name('booking.create')
        ->middleware('auth', 'can:reserve,property');
});

Route::controller(BookingOwnerController::class)->group(function () {
    Route::get('/booking-requests', 'list')->name('owner.booking.list')
        ->middleware('auth');

    Route::group(['prefix' => '/booking/{booking}', 'as' => 'booking.'], function () {

        Route::get('', 'show')->name('request')
            ->middleware('auth');

        Route::post('/confirm', 'confirm')->name('confirm')
            ->middleware('auth');

        Route::post('/cancel', 'cancel')->name('cancel')
            ->middleware('auth');
    });
});

