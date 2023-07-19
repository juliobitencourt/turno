<?php

namespace App\Domain\Transaction\Deposit\Repositories;

use App\Domain\Transaction\AbstractTransactionRepository;
use App\Enums\TransactionType;

class DepositRepository extends AbstractTransactionRepository
{
    /**
     * Determine the transactions's type.
     */
    public function transactionType(): string
    {
        return TransactionType::DEPOSIT->value;
    }
}
