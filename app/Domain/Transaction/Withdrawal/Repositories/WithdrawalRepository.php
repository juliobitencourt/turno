<?php

namespace App\Domain\Transaction\Withdrawal\Repositories;

use App\Domain\Transaction\AbstractTransactionRepository;
use App\Enums\TransactionType;

class WithdrawalRepository extends AbstractTransactionRepository
{
    /**
     * Determine the transactions's type.
     */
    public function transactionType(): string
    {
        return TransactionType::WITHDRAWAL->value;
    }
}
