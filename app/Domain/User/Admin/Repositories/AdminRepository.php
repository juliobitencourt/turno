<?php

namespace App\Domain\User\Admin\Repositories;

use App\Enums\UserRole;
use App\Domain\User\AbstractUserRepository;

class AdminRepository extends AbstractUserRepository
{
    /**
     * Determine the user's role.
     *
     * @return string
     */
    public function userRole(): string
    {
        return UserRole::ADMIN->value;
    }
}