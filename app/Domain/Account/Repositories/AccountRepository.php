<?php

namespace App\Domain\Account\Repositories;

use App\Models\Account;
use App\Domain\Account\Interfaces\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function create($id)
    {
        Account::create([
            'user_id' => $id,
            'balance' => 0
        ]);
    }
}