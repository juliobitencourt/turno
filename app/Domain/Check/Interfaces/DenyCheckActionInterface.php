<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface DenyCheckActionInterface
{
    public function deny(CheckDeposit $check);
}
