<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Models\CheckDeposit;

class CheckRepository implements CheckRepositoryInterface
{
    public function getAllChecks()
    {
        return CheckDeposit::all();
    }

    public function getChecksByCustomer(string $customerId)
    {
        return CheckDeposit::where('user_id', $customerId)->get();
    }

    public function getCheckById(string $checkId)
    {
        return CheckDeposit::find($checkId);
    }

    public function createCheck(array $checkDetails)
    {
        return CheckDeposit::create([
            'user_id' => $checkDetails['user_id'],
            'description' => $checkDetails['description'],
            'amount' => $checkDetails['amount'],
            'picture' => $checkDetails['picture'],
        ]);
    }
}
