<?php

namespace App\Policies;

use App\User;
use App\Aeronave;
use Illuminate\Auth\Access\HandlesAuthorization;

class AeronavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, Aeronave $model)
    {
        //
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
     * @param  \App\Aeronave  $model
     * @return mixed
     */
    public function update(User $user, Aeronave $model)
    {
        return $user->direcao;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $model
     * @return mixed
     */
    public function delete(User $user, Aeronave $model)
    {
        return $user->direcao;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $model
     * @return mixed
     */
    public function restore(User $user, Aeronave $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $model
     * @return mixed
     */
    public function forceDelete(User $user, Aeronave $model)
    {
        //
    }
}
