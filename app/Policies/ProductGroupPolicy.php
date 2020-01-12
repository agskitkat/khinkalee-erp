<?php

namespace App\Policies;

use App\User;
use App\ProductGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any product groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissions(['group_read']);
    }

    /**
     * Determine whether the user can view the product group.
     *
     * @param  \App\User  $user
     * @param  \App\ProductGroup  $productGroup
     * @return mixed
     */
    public function view(User $user, ProductGroup $productGroup)
    {
        //
    }

    /**
     * Determine whether the user can create product groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions(['group_create']);
    }

    /**
     * Determine whether the user can update the product group.
     *
     * @param  \App\User  $user
     * @param  \App\ProductGroup  $productGroup
     * @return mixed
     */
    public function update(User $user, ProductGroup $productGroup)
    {
        if( $user->hasPermissions(['group_update'])) {
            return true;
        } else {
            return $user->hasPermissions(['group_self'], $productGroup);
        }
    }

    /**
     * Determine whether the user can delete the product group.
     *
     * @param  \App\User  $user
     * @param  \App\ProductGroup  $productGroup
     * @return mixed
     */
    public function delete(User $user, ProductGroup $productGroup)
    {
        if( $user->hasPermissions(['group_remove'])) {
            return true;
        } else {
            return $user->hasPermissions(['group_remove_self'], $productGroup);
        }
    }

    /**
     * Determine whether the user can restore the product group.
     *
     * @param  \App\User  $user
     * @param  \App\ProductGroup  $productGroup
     * @return mixed
     */
    public function restore(User $user, ProductGroup $productGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product group.
     *
     * @param  \App\User  $user
     * @param  \App\ProductGroup  $productGroup
     * @return mixed
     */
    public function forceDelete(User $user, ProductGroup $productGroup)
    {
        //
    }
}
