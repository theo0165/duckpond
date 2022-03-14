<?php

namespace App\Policies;

use App\Models\Community;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommunityPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Community $community)
    {
        return $user->id === $community->user_id || $user->is_admin;
    }
}
