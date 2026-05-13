<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\GorController;
use App\Http\Controllers\Admin\CourtController;


Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);

});
Route::get('/test', function () {
    return Inertia::render('Test');
});
Route::middleware([
    'auth',
    'verified',
    'nocache'
])->group(function () {

    Route::get('/dashboard', function () {

        return Inertia::render('Dashboard');

    })->name('dashboard');

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});

Route::middleware([
    'auth',
    'role:admin',
    'nocache'
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {

        return Inertia::render('Admin/Dashboard');

    })->name('dashboard');

    Route::resource(
        'gors',
        GorController::class
    );

    Route::resource(
        'courts',
        CourtController::class
    );
    
});

require __DIR__.'/auth.php';