<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::controller(FavouriteController::class)->group(function(){
    Route::group(['prefix' => '/wishlist/{property}'], function () {

        Route::post('/add', 'add')->middleware(['auth:api']);

        Route::delete('/delete', 'delete')->middleware(['auth:api']);
    });
});

Route::controller(AmenityController::class)->group(function(){
    Route::group(['prefix' => '/amenities'], function () {
        Route::get('', 'list');

        Route::post('/create', 'create')->middleware(['auth:api']);

        Route::put('/{amenity}/edit', 'edit')->middleware(['auth:api']);

        Route::delete('/{amenity}/delete', 'delete')->middleware(['auth:api']);
    });
});

Route::controller(FacilityController::class)->group(function(){
    Route::group(['prefix' => '/facilities'], function () {
        Route::get('', 'list');

        Route::post('/create', 'create')->middleware(['auth:api']);

        Route::put('/{facility}/edit', 'edit')->middleware(['auth:api']);

        Route::delete('/{facility}/delete', 'delete')->middleware(['auth:api']);
    });
});

Route::controller(TypeController::class)->group(function(){
    Route::group(['prefix' => '/types'], function () {
        Route::get('', 'list');

        Route::post('/create', 'create')->middleware(['auth:api']);

        Route::put('/{type}/edit', 'edit')->middleware(['auth:api']);

        Route::delete('/{type}/delete', 'delete')->middleware(['auth:api']);
    });
});

Route::controller(PropertyController::class)->group(function () {
    Route::group(['prefix' => '/announcements'], function () {

        Route::get('', 'list');

//        Route::post('/create', 'create')->middleware(['auth:api']);

        Route::get('/{property}', 'show');

//        Route::put('/{property}/edit', 'edit')->middleware(['auth:api']);

        Route::delete('/{property}/delete', 'delete')->middleware(['auth:api']);
    });
});
