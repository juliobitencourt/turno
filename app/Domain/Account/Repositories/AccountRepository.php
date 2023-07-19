<?php

namespace App\Domain\Account\Repositories;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use App\Traits\NumberFormat;

class AccountRepository implements AccountRepositoryInterface
{
    use NumberFormat;

    /**
     * Creates a new account with the provided user ID and initial balance.
     *
     * @param  string  $id The user ID associated with the account.
     */
    public function create(string $id): void
    {
        Account::create([
            'user_id' => $id,
            'balance' => 0,
        ]);
    }

    /**
     * Checks if the account with the provided ID has a balance greater than or equal to the specified amount.
     *
     * @param  string  $accountId The ID of the account to check.
     * @param  int  $amount The amount to compare the account balance against.
     * @return bool Returns true if the account balance is greater than or equal to the specified amount, otherwise false.
     */
    public function hasBalance(string $accountId, int $amount): bool
    {
        $account = Account::find($accountId);

        return $account->balance >= $amount;
    }

    /**
     * Retrieves the balance of the account with the provided ID.
     *
     * @param  string  $accountId The ID of the account to retrieve the balance from.
     * @return int The balance of the account.
     */
    public function getBalance(string $accountId): int
    {
        return Account::find($accountId)->balance;
    }

    /**
     * Increases the balance of the account with the provided ID by the specified amount.
     *
     * @param  string  $accountId The ID of the account to increment the balance.
     * @param  int  $amount The amount to increment the account balance by.
     */
    public function incrementAccountBalance(string $accountId, int $amount): void
    {
        $account = Account::find($accountId);
        $account->increment('balance', $this->set($amount));
    }

    /**
     * Decreases the balance of the account with the provided ID by the specified amount.
     *
     * @param  string  $accountId The ID of the account to decrement the balance.
     * @param  int  $amount The amount to decrement the account balance by.
     */
    public function decrementAccountBalance(string $accountId, int $amount): void
    {
        $account = Account::find($accountId);
        $account->decrement('balance', $this->set($amount));
    }
}
