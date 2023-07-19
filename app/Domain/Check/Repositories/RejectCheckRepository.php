<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Check\Interfaces\RejectCheckRepositoryInterface;
use App\Enums\CheckDepositStatus;
use App\Models\CheckDeposit;

class RejectCheckRepository implements RejectCheckRepositoryInterface
{
    public function reject(CheckDeposit $check)
    {
        $check->status = CheckDepositStatus::DENIED;
        $check->save();
    }
}
