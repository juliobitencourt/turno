<?php

namespace App\Domain\Repositories;

use App\Enums\CheckDepositStatus;
use App\Domain\Interfaces\RejectCheckRepositoryInterface;

class RejectCheckRepository implements RejectCheckRepositoryInterface
{
    public function reject($check)
    {
        $check->status = CheckDepositStatus::DENIED;
        $check->save();
    }
}