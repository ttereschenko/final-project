<?php

use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
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
