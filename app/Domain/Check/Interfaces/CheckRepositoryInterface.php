<?php

namespace App\Domain\Check\Interfaces;

use App\Domain\Check\DTO\CheckData;
use App\Enums\CheckDepositStatus;

interface CheckRepositoryInterface
{
    public function getAllChecks();

    public function getChecksByCustomer(string $customerId, CheckDepositStatus $depositStatus);

    public function getCheckById(string $checkId);

    public function createCheck(CheckData $checkData);
}
