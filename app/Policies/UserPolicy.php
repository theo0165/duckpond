<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, User $userToEdit)
    {
        return $user->id === $userToEdit->id;
    }

    public function update(User $user, User $userToEdit)
    {
        return $user->id === $userToEdit->id;
    }

    public function delete(User $user, User $userToEdit)
    {
        return $user->id === $userToEdit->id;
    }
}
