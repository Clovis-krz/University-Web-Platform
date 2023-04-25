<?php

namespace App\Policies;

use App\Models\User;
use HandlesAuthorization;

class UserPolicy
{
    
    public function view(User $user, User $db_user)
    {
        return $user->IsAdmin() || $user->id == $db_user->id;
    }

    public function update(User $user, User $db_user)
    {
        return $user->IsAdmin() || $user->id == $db_user->id;
    }

    public function delete(User $user, User $db_user)
    {
        return $user->IsAdmin() || $user->id == $db_user->id;
    }
}
