<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'index'])->name('registrations.index');
    Route::post('registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'store'])->name('registrations.store');
    Route::delete('registrations', [\App\Http\Controllers\Admin\RegistrationController::class, 'destroy'])->name('registrations.destroy');
});




require __DIR__.'/auth.php';
