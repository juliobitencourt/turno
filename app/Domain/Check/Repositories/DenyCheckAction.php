<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Check\Interfaces\DenyCheckActionInterface;
use App\Enums\CheckDepositStatus;
use App\Models\CheckDeposit;

class DenyCheckAction implements DenyCheckActionInterface
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
