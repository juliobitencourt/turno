<?php

namespace App\Domain\Transaction\DTO;

use DateTime;

class TransactionData
{
    public function __construct(
        public readonly string $userId,
        public readonly string $description,
        public readonly int $amount,
        public readonly DateTime $date,
    ) {
    }
}
