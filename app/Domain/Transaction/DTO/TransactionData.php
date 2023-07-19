<?php

namespace App\Domain\Transaction\DTO;

use DateTime;

class TransactionData
{
    public function __construct(
        public string $userId,
        public string $description,
        public int $amount,
        public DateTime $date,
    ) {
    }
}
