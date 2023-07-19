<?php

namespace App\Domain\Transaction\Deposit\Repositories;

use App\Enums\TransactionType;
use App\Domain\Transaction\AbstractTransactionRepository;

class DepositRepository extends AbstractTransactionRepository
{
    /**
     * Determine the transactions's type.
     *
     * @return string
     */
    public function transactionType(): string
    {
        return TransactionType::DEPOSIT->value;
    }
}