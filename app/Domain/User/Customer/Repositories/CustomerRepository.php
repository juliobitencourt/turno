<?php

namespace App\Domain\User\Customer\Repositories;

use App\Domain\User\AbstractUserRepository;
use App\Enums\UserRole;

class CustomerRepository extends AbstractUserRepository
{
    /**
     * Determine the user's role.
     */
    public function userRole(): string
    {
        return UserRole::CUSTOMER->value;
    }
}
