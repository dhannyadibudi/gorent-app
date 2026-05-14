<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\GorController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\DashboardController;


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

});