<?php

namespace App\Domain\User\DTO;

class UserData
{
    public function __construct(
        public string $username,
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
