<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $user2)
    {
        return ($user->isAdmin() || $user->id === $user2);
    }

    public function delete(User $user, User $user2)
    {
        return ($user->isAdmin() || $user->id === $user2);
    }
}
