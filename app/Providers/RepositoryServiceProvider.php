<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\CheckRepository;
use App\Domain\Repositories\AcceptCheckRepository;
use App\Domain\Repositories\RejectCheckRepository;
use App\Domain\Interfaces\CheckRepositoryInterface;
use App\Domain\Interfaces\AcceptCheckRepositoryInterface;
use App\Domain\Interfaces\RejectCheckRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CheckRepositoryInterface::class, CheckRepository::class);
        $this->app->bind(AcceptCheckRepositoryInterface::class, AcceptCheckRepository::class);
        $this->app->bind(RejectCheckRepositoryInterface::class, RejectCheckRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
