<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface DenyCheckRepositoryInterface
{
    public function deny(CheckDeposit $check);
}
