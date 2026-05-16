<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\GorController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminBookingController;

Route::middleware([
    'auth',
    'role:admin',
    'nocache',
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'gors',
        GorController::class
    );

    Route::resource(
        'courts',
        CourtController::class
    );

    Route::resource(
        'schedules',
        ScheduleController::class
    )->only([
        'index',
        'store',
    ]);

    Route::resource(
        'bookings',
        AdminBookingController::class
    )->only([
        'index',
        'show'
    ]);

    Route::patch(
        'bookings/{booking}/cancel',
        [AdminBookingController::class, 'cancel']
    )->name('bookings.cancel');

    Route::patch(
        'bookings/{booking}/complete',
        [AdminBookingController::class, 'complete']
    )->name('bookings.complete');

});