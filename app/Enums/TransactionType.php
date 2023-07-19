<?php

namespace App\Enums;

use App\Traits\Enums;

enum TransactionType: string
{
    use Enums;

    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';
}
