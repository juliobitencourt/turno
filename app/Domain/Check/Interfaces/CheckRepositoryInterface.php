<?php

namespace App\Domain\Check\Interfaces;

interface CheckRepositoryInterface
{
    public function getAllChecks();

    public function getChecksByCustomer(string $customerId);

    public function getCheckById(string $checkId);

    public function createCheck(array $checkDetails);
}
