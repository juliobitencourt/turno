<?php

namespace App\Domain\User\Customer\Repositories;

use App\Enums\UserRole;
use App\Domain\User\AbstractUserRepository;

class CustomerRepository extends AbstractUserRepository
{
    /**
     * Determine the user's role.
     *
     * @return string
     */
    public function userRole(): string
    {
        return UserRole::CUSTOMER->value;
    }
}