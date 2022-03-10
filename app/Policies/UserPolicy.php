<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model)
    {
        return $user->id == $model->id ?
            Response::allow() :
            Response::deny("Unauthorized");
    }

    // public function delete(User $user, User $model)
    // {
    //     return ($user->id == auth()->user()->id || $user->is_admin) ?
    //         Response::allow() :
    //         Response::deny("Unauthorized");
    // }

    public function delete(User $user)
    {
        return $user->id === auth()->user()->id;
    }
}
