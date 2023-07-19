<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Check\Repositories\CheckRepository;
use App\Domain\Check\Repositories\AcceptCheckRepository;
use App\Domain\Check\Repositories\RejectCheckRepository;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Domain\Account\Repositories\AccountRepository;
use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;
use App\Domain\Check\Interfaces\RejectCheckRepositoryInterface;
use App\Domain\Account\Interfaces\AccountRepositoryInterface;

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
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
