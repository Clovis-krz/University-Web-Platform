<?php

namespace App\Policies;

use App\Models\Cours;
use App\Models\User;
use HandlesAuthorization;

class CoursPolicy
{
    public function subscribe(User $user)
    {
        return $user->type == "etudiant";
    }

    public function unsubscribe(User $user)
    {
        return $user->type == "etudiant";
    }

    public function subscriptionlist(User $user, Cours $cours,)
    {
        return $user->type == "etudiant";
    }

    public function myformationlist(User $user, Cours $cours)
    {
        return $user->type == "etudiant";
    }

    public function iteach(User $user, Cours $cours)
    {
        return $user->type == "enseignant";
    }

}
