<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RegistrationController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/{event}/register', [RegistrationController::class, 'register']);
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'unregister']);
    Route::get('/user/registrations', [RegistrationController::class, 'userRegistrations']);
});
