<?php

namespace App\Domain\Account\Repositories;

use App\Models\Account;
use App\Domain\Account\Interfaces\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function create($id): void
    {
        Account::create([
            'user_id' => $id,
            'balance' => 0
        ]);
    }

    public function hasBalance(string $accountId, int $amount): bool
    {
        $account = Account::find($accountId);
        return $account->balance >= $amount;
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