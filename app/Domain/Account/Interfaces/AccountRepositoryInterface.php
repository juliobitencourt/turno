<?php

namespace App\Domain\Account\Interfaces;

interface AccountRepositoryInterface
{
    public function create(string $id): void;

    public function hasBalance(string $accountId, int $amount): bool;

    public function getBalance(string $accountId): int;

    public function incrementAccountBalance(string $accountId, int $amount): void;

    public function decrementAccountBalance(string $accountId, int $amount): void;
}
