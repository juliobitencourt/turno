<?php

namespace App\Domain\Account\Repositories;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Models\Account;

class AccountRepository implements AccountRepositoryInterface
{
    public function create($id): void
    {
        Account::create([
            'user_id' => $id,
            'balance' => 0,
        ]);
    }

    public function hasBalance(string $accountId, int $amount): bool
    {
        $account = Account::find($accountId);

        return $account->balance >= $amount;
    }

    public function getBalance(string $accountId): int
    {
        return Account::find($accountId)->balance;
    }

    public function incrementAccountBalance(string $accountId, int $amount): void
    {
        $account = Account::find($accountId);
        $account->increment('balance', $amount);
    }

    public function decrementAccountBalance(string $accountId, int $amount): void
    {
        $account = Account::find($accountId);
        $account->decrement('balance', $amount);
    }
}
