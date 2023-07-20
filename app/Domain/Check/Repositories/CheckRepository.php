<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Models\CheckDeposit;

class CheckRepository implements CheckRepositoryInterface
{
    /**
     * Get all checks.
     *
     * @return Collection
     */
    public function getAllChecks()
    {
        return CheckDeposit::with('user')->get();
    }

    /**
     * Get all checks by the provided customer.
     *
     * @param  string  $customerId The customer id that will be used to filter the checks.
     * @return Collection
     */
    public function getChecksByCustomer(string $customerId)
    {
        return CheckDeposit::where('user_id', $customerId)->get();
    }

    /**
     * Get check by the provided id.
     *
     * @param  string  $checkId The id that will be used to find the check.
     * @return Collection
     */
    public function getCheckById(string $checkId)
    {
        return CheckDeposit::find($checkId);
    }

    /**
     * Creates a new check based on the provided check data.
     *
     * @param  CheckData  $checkData The user data used to create the user.
     * @return self Returns an instance of the current class.
     */
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
