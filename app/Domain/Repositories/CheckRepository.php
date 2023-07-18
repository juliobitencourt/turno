<?php

namespace App\Domain\Repositories;

use App\Domain\Interfaces\CheckRepositoryInterface;
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

    }

    public function createCheck(array $checkDetails)
    {
        return CheckDeposit::create([
            'user_id' => $checkDetails['user_id'],
            'description' => $checkDetails['description'],
            'amount' => $checkDetails['amount'],
            'filename' => $checkDetails['filename'],
        ]);
    }

    public function rejectCheck(string $checkId)
    {

    }

    public function acceptCheck(string $checkId)
    {

    }

}