<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Planning;
use HandlesAuthorization;

class PlanningPolicy
{
    
    public function viewTeacher(User $user, Planning $planning)
    {
        return $user->type == 'enseignant';
    }
    public function viewStudent(User $user, Planning $planning)
    {
        return $user->type == 'etudiant';
    }
    public function create(User $user, Planning $planning)
    {
        return $user->IsAdmin() || $user->type == 'enseignant';
    }

    public function update(User $user, Planning $planning)
    {
        return $user->IsAdmin() || $user->type == 'enseignant';
    }

    public function delete(User $user, Planning $planning)
    {
        return $user->IsAdmin() || $user->type == 'enseignant';
    }
}
