<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AeronavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
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
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->direcao;
    }

    /**
    * Determine whether the user can delete the model.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function delete(User $user)
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
