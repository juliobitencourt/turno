<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\CheckRepository;
use App\Domain\Repositories\AcceptCheckRepository;
use App\Domain\Repositories\RejectCheckRepository;
use App\Domain\Interfaces\CheckRepositoryInterface;
use App\Domain\Account\Repositories\AccountRepository;
use App\Domain\Customer\Repositories\CustomerRepository;
use App\Domain\Interfaces\AcceptCheckRepositoryInterface;
use App\Domain\Interfaces\RejectCheckRepositoryInterface;
use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Customer\Interfaces\CustomerRepositoryInterface;

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
