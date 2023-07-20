<?php

namespace App\Providers;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Account\Repositories\AccountRepository;
use App\Domain\Check\Interfaces\ApproveCheckRepositoryInterface;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Domain\Check\Interfaces\DenyCheckRepositoryInterface;
use App\Domain\Check\Repositories\ApproveCheckRepository;
use App\Domain\Check\Repositories\CheckRepository;
use App\Domain\Check\Repositories\DenyCheckRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CheckRepositoryInterface::class, CheckRepository::class);
        $this->app->bind(ApproveCheckRepositoryInterface::class, ApproveCheckRepository::class);
        $this->app->bind(DenyCheckRepositoryInterface::class, DenyCheckRepository::class);
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
