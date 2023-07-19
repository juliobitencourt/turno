<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface RejectCheckRepositoryInterface
{
    public function reject(CheckDeposit $check);
}
