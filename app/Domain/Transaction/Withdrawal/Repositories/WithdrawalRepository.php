<?php

namespace App\Domain\Transaction\Withdrawal\Repositories;

use App\Enums\TransactionType;
use App\Domain\Transaction\AbstractTransactionRepository;

class WithdrawalRepository extends AbstractTransactionRepository
{
    /**
     * Determine the transactions's type.
     *
     * @return string
     */
    public function transactionType(): string
    {
        return TransactionType::WITHDRAWAL->value;
    }
}