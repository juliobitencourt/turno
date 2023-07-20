<?php

namespace App\Domain\Check\Repositories;

use App\Models\CheckDeposit;
use App\Domain\Check\DTO\CheckData;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Enums\CheckDepositStatus;

class CheckRepository implements CheckRepositoryInterface
{
    /**
     * Get all checks.
     *
     * @param  CheckDepositStatus  $checkDepositStatus The check status to filter.
     * @return Collection
     */
    public function getAllChecks(CheckDepositStatus $checkDepositStatus = null)
    {
        return CheckDeposit::with('user')
            ->when($checkDepositStatus, function($query) use ($checkDepositStatus) {
                return $query->where('status', $checkDepositStatus);
            })
            ->get();
    }

    /**
     * Get all checks by the provided customer.
     *
     * @param  string  $customerId The customer id that will be used to filter the checks.
     * @param  CheckDepositStatus  $checkDepositStatus The check status to filter.
     * @return Collection
     */
    public function getChecksByCustomer(string $customerId, CheckDepositStatus $checkDepositStatus = null)
    {
        return CheckDeposit::where('user_id', $customerId)
            ->when($checkDepositStatus, function($query) use ($checkDepositStatus) {
                return $query->where('status', $checkDepositStatus);
            })
            ->get();
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
