<?php

namespace App\Domain\Repositories;

use App\Domain\Interfaces\CheckRepositoryInterface;
use App\Models\Check;

class CheckRepository implements CheckRepositoryInterface
{
    public function getAllChecks()
    {
        return Check::all();
    }

    public function getChecksByCustomer(string $customerId)
    {
        return Check::where('user_id', $customerId)->get();
    }

    public function getCheckById(string $checkId)
    {

    }

    public function createCheck(array $checkDetails)
    {
        return Check::create([
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