<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;

Route::get('/hotel/details/{id}', [HotelController::class, 'getDetails']);
Route::get('/hotels', [HotelController::class, 'index']);
Route::post('/reservations', [HotelController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/hotels/search', [HotelController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
