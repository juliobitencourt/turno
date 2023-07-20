<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface ApproveCheckRepositoryInterface
{
    public function approve(CheckDeposit $check);
}
