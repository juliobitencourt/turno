<?php

namespace App\Domain\User\Admin\Repositories;

use App\Domain\User\AbstractUserRepository;
use App\Enums\UserRole;

class AdminRepository extends AbstractUserRepository
{
    /**
     * Determine the user's role.
     */
    public function userRole(): string
    {
        return UserRole::ADMIN->value;
    }
}
