<?php

namespace App\Enums;

use App\Traits\Enums;

enum UserRole: string
{
    use Enums;

    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
}