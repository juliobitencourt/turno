<?php

namespace App\Enums;

use App\Traits\Enums;

enum CheckDepositStatus: string
{
    use Enums;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case DENIED = 'denied';
}