<?php

namespace App\Domain\User\DTO;

class UserData
{
    public function __construct(
        public readonly string $username,
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
