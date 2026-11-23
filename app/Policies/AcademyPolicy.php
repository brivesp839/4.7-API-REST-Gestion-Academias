<?php

namespace App\Policies;

use App\Models\Academy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AcademyPolicy
{
    //Permite al usuario ver todas las academias 
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    //Permite al usuario ver sólo sus academias
    public function view(User $user, Academy $academy): bool
    {
        return $user->id === $academy->user_id;
    }

    
    public function create(User $user): bool
    {
        return false;
    }

    //El usuario puede actualizar sólo sus academias
    public function update(User $user, Academy $academy): bool
    {
        return $user->id === $academy->user_id;
    }

    //El usuario puede borrar sólo sus academias
    public function delete(User $user, Academy $academy): bool
    {
        return $user->id === $academy->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Academy $academy): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Academy $academy): bool
    {
        return false;
    }
}
