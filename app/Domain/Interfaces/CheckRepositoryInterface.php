<?php

namespace App\Domain\Interfaces;

interface CheckRepositoryInterface
{
    public function getAllChecks();
    public function getChecksByCustomer(string $customerId);
    public function getCheckById(string $checkId);
    public function createCheck(array $checkDetails);
    public function rejectCheck(string $checkId);
    public function acceptCheck(string $checkId);
}
