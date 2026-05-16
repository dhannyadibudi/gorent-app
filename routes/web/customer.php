<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CourtController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\InvoiceController;

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
        '/bookings/{booking}/invoice',
        [InvoiceController::class, 'download']
    )->name('booking.invoice');

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

    Route::get(
        '/bookings/{booking}/status',
        [PaymentController::class, 'status']
    )->name('booking.status');

    Route::get(
        '/bookings/{booking}/snap-token',
        [PaymentController::class, 'snapToken']
    )->name('booking.snap-token');

    Route::post(
        '/payments/{payment}/simulate',
        [PaymentController::class, 'simulate']
    )->name('payment.simulate');

    Route::get(
        '/my-bookings',
        [BookingController::class, 'index']
    )->name('booking.index');
});