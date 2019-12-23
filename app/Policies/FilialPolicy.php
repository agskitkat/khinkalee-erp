<?php

namespace App\Policies;

use App\User;
use App\Filial;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any filials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissions(['filials_read']);
    }

    /**
     * Determine whether the user can view the filial.
     *
     * @param  \App\User  $user
     * @param  \App\Filial  $filial
     * @return mixed
     */
    public function view(User $user, Filial $filial) {
        //

    }

    /**
     * Determine whether the user can create filials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->hasPermissions(['filials_create']);
    }

    /**
     * Determine whether the user can update the filial.
     *
     * @param  \App\User  $user
     * @param  \App\Filial  $filial
     * @return mixed
     */
    public function update(User $user, Filial $filial) {

        if( $user->hasPermissions(['filials_update'])) {
            return true;
        } else {
            return $user->hasPermissions(['filials_self'], $filial);
        }


    }

    /**
     * Determine whether the user can delete the filial.
     *
     * @param  \App\User  $user
     * @param  \App\Filial  $filial
     * @return mixed
     */
    public function delete(User $user, Filial $filial)
    {
        //
    }

    /**
     * Determine whether the user can restore the filial.
     *
     * @param  \App\User  $user
     * @param  \App\Filial  $filial
     * @return mixed
     */
    public function restore(User $user, Filial $filial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the filial.
     *
     * @param  \App\User  $user
     * @param  \App\Filial  $filial
     * @return mixed
     */
    public function forceDelete(User $user, Filial $filial)
    {
        //
    }
}
