<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::get('/hotel/details/{id}', [HotelController::class, 'getDetails']);
Route::get('/hotels', [HotelController::class, 'index']);
Route::post('/reservations', [HotelController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/hotels/search', [HotelController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::post('notifications/send', [NotificationController::class, 'send']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('profile', [ProfileController::class, 'edit']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('favorites', [FavoritesController::class, 'store']);
    Route::get('favorites', [FavoritesController::class, 'index']);
});

