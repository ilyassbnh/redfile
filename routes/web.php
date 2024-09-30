<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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

