<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CourtController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\PaymentController;

Route::middleware([
    'auth',
])
->prefix('customer')
->name('customer.')
->group(function () {

    Route::get(
        '/courts',
        [CourtController::class, 'index']
    )->name('courts.index');

    Route::get(
        '/courts/{court}/booking',
        [BookingController::class, 'create']
    )->name('booking.create');

    Route::post(
        '/bookings',
        [BookingController::class, 'store']
    )->name('booking.store');

    Route::get(
        '/bookings/{booking}/payment',
        function (\App\Models\Booking $booking) {

            return inertia(
                'Customer/Payment/Show',
                [
                    'booking' => $booking
                        ->load([
                            'payment',
                            'schedule.court.gor',
                        ]),
                ]
            );

        }
    )->name('booking.payment');

    Route::post(
        '/payments/{payment}/simulate',
        [PaymentController::class, 'simulate']
    )->name('payment.simulate');

    Route::get(
        '/my-bookings',
        [BookingController::class, 'index']
    )->name('booking.index');
});