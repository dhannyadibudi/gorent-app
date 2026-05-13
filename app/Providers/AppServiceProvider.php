<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\GorRepositoryInterface;
use App\Repositories\Implementations\GorRepository;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use App\Repositories\Implementations\CourtRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            GorRepositoryInterface::class,
            GorRepository::class
        );
        $this->app->bind(
            CourtRepositoryInterface::class,
            CourtRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
