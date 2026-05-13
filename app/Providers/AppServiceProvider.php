<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\GorRepositoryInterface;
use App\Repositories\Implementations\GorRepository;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use App\Repositories\Implementations\CourtRepository;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;
use App\Repositories\Implementations\ScheduleRepository;
use App\Services\Payment\FakePaymentService;
use App\Services\Payment\Contracts\PaymentGatewayInterface;

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
        $this->app->bind(
            ScheduleRepositoryInterface::class,
            ScheduleRepository::class
        );
        $this->app->bind(
            PaymentGatewayInterface::class,
            FakePaymentService::class
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
