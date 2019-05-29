<?php

namespace App\Policies;

use App\User;
use App\Aeronave;
use Illuminate\Auth\Access\HandlesAuthorization;

class AeronavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function view(User $user, Aeronave $aeronave)
    {
        return true;
    }

    /**
    * Determine whether the user can create models.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function create(User $user)
    {
        return $user->direcao;
    }

    /**
    * Determine whether the user can update the model.
    *
    * @param  \App\User  $user
    * @param  \App\Aeronave $aeronave
    * @return mixed
    */
    public function update(User $user, Aeronave $aeronave)
    {
        return $user->direcao; //|| $user->id == $aeronave->pilotos()->find($user->id); // ou é piloto da aeronave
    }

    /**
    * Determine whether the user can delete the aeronave.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function delete(User $user)
    {
        return $user->direcao;
    }

    /**
    * Determine whether the user can delete the aeronave.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function forceDelete(User $user)
    {
        return $user->direcao;
    }


    /**
    * Determine whether the user can authorize the model.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function authorize(User $user)
    {
        return $user->direcao;
    }
}
