<?php

namespace App\Domain\Repositories;

use App\Enums\CheckStatus;
use App\Domain\Interfaces\RejectCheckRepositoryInterface;

class RejectCheckRepository implements RejectCheckRepositoryInterface
{
    public function reject($check)
    {
        $check->status_id = CheckStatus::REJECTED;
        $check->save();
    }
}