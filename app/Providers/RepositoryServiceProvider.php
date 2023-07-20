<?php

namespace App\Providers;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Account\Repositories\AccountRepository;
use App\Domain\Check\Interfaces\ApproveCheckActionInterface;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Domain\Check\Interfaces\DenyCheckActionInterface;
use App\Domain\Check\Repositories\ApproveCheckAction;
use App\Domain\Check\Repositories\CheckRepository;
use App\Domain\Check\Repositories\DenyCheckAction;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CheckRepositoryInterface::class, CheckRepository::class);
        $this->app->bind(ApproveCheckActionInterface::class, ApproveCheckAction::class);
        $this->app->bind(DenyCheckActionInterface::class, DenyCheckAction::class);
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
