<?php

namespace App\Domain\Check\Interfaces;

use App\Domain\Check\DTO\CheckData;

interface CheckRepositoryInterface
{
    public function getAllChecks();

    public function getChecksByCustomer(string $customerId);

    public function getCheckById(string $checkId);

    public function createCheck(CheckData $checkData);
}
