<?php

namespace App\Domain\Check\Repositories;

use App\Models\CheckDeposit;
use App\Domain\Check\DTO\CheckData;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;

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
    public function createCheck(CheckData $checkData)
    {
        return CheckDeposit::create([
            'user_id' => $checkData->userId,
            'description' => $checkData->description,
            'amount' => $checkData->amount,
            'picture' => $checkData->picture,
        ]);
    }
}
