<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->direcao || $user->is($model);
    }

    /**
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function viewAtivo(User $user)
    {
        return $user->direcao;
    }

    public function viewQuota(User $user)
    {
        return $user->direcao;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->direcao;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->direcao || $user->is($model);
    }


    public function getCertificado(User $user, User $model)
    {
        return $user->direcao || $user->is($model);
    }

    public function getLicenca(User $user, User $model)
    {
        return $user->direcao || $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

    public function mudarEstado(User $user, User $model)
    {
        return $user->direcao && $user->id != $model->id;
    }
}
