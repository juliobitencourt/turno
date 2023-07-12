<?php

namespace App\Enums;

enum TransactionType: int
{
    use EnumsTrait;

    case INCOME = 1;
    case EXPENSE = 2;
}