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

    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function addSkill()
    {

    }

    public function updateSkill()
    {

    }

    public function destroySkill()
    {

    }
}
