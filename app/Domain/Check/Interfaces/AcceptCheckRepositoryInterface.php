<?php

namespace App\Domain\Check\Interfaces;

use App\Models\CheckDeposit;

interface AcceptCheckRepositoryInterface
{
    public function accept(CheckDeposit $check);
}
