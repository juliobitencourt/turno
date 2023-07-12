<?php

namespace App\Enums;

enum CheckStatus: int
{
    use EnumsTrait;

    case ACCEPTED = 1;
    case REJECTED = 2;
}