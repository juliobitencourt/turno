<?php

namespace App\Domain\User;

use App\Models\User;
use App\Domain\User\DTO\UserData;
use Illuminate\Support\Facades\Hash;
use App\Domain\User\Interfaces\UserRepositoryInterface;

abstract class AbstractUserRepository implements UserRepositoryInterface
{
    /**
     * The current user.
     *
     * @var  App\Models\User|null
     */
    public readonly User $user;

    /**
     * Creates a new user based on the provided user data.
     *
     * @param UserData $userData The user data used to create the user.
     * @return self Returns an instance of the current class.
     */
    public function create(UserData $userData): self
    {
        $this->user = new User;
        $this->user->role = $this->userRole();
        $this->user->username = $userData->username;
        $this->user->name = $userData->name;
        $this->user->email = $userData->email;
        $this->user->password = Hash::make($userData->password);
        $this->user->save();

        return $this;
    }

    /**
     * Method: userRole (abstract)
     *
     * Description: This method should be implemented in child classes to determine the user's role.
     *
     * @return string
     */
    protected abstract function userRole(): string;

    /**
     * Method: find
     *
     * Description: Finds and retrieves a user based on the provided ID.
     *
     * @param string $id The ID of the user to find.
     * @return User The found user object.
     */
    public function find(string $id): User
    {
        return $this->user = User::find($id);
    }
}

