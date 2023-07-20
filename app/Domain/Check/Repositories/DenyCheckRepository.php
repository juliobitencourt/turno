<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Check\Interfaces\DenyCheckRepositoryInterface;
use App\Enums\CheckDepositStatus;
use App\Models\CheckDeposit;

class DenyCheckRepository implements DenyCheckRepositoryInterface
{
    /**
     * Deny the check.
     *
     * @param  CheckDeposit  $check The check that will be denied.
     * @return Collection
     */
    public function deny(CheckDeposit $check)
    {
        $check->status = CheckDepositStatus::DENIED;
        $check->save();
    }
}
