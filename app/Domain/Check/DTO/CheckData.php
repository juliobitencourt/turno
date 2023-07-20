<?php

namespace App\Domain\Check\DTO;

class CheckData
{
    public function __construct(
        public readonly string $userId,
        public readonly string $description,
        public readonly int $amount,
        public readonly string $picture,
    ) {
    }
}
