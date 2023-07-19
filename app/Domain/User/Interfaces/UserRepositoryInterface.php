<?php

namespace App\Domain\User\Interfaces;

use App\Domain\User\DTO\UserData;

interface UserRepositoryInterface
{
    public function create(UserData $userData);

    public function find(string $id);
}
