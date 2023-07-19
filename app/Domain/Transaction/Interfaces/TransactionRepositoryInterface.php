<?php

namespace App\Domain\Transaction\Interfaces;

use App\Domain\Transaction\DTO\TransactionData;

interface TransactionRepositoryInterface
{
    public function create(TransactionData $transactionData);

    public function find(string $id);

    public function sum(string $userId): int;
}
