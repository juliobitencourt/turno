<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\CheckRepository;
use App\Domain\Interfaces\CheckRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CheckRepositoryInterface::class, CheckRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
