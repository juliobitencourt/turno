<?php

namespace App\Enums;

enum UserRole: int
{
    use EnumsTrait;

    case ADMINISTRATOR = 1;
    case CUSTOMER = 2;
}