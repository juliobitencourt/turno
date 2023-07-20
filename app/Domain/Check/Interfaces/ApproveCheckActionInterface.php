<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface ApproveCheckActionInterface
{
    public function approve(CheckDeposit $check);
}
