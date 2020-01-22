<?php

namespace App\Policies;

use App\User;
use App\ProviderProducts;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProviderProductsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any provider products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissions(['provider_products_read']);
    }

    /**
     * Determine whether the user can view the provider products.
     *
     * @param  \App\User  $user
     * @param  \App\ProviderProducts  $providerProducts
     * @return mixed
     */
    public function view(User $user, ProviderProducts $providerProducts)
    {
        //
    }

    /**
     * Determine whether the user can create provider products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions(['provider_products_create']);
    }

    /**
     * Determine whether the user can update the provider products.
     *
     * @param  \App\User  $user
     * @param  \App\ProviderProducts  $providerProducts
     * @return mixed
     */
    public function update(User $user, ProviderProducts $providerProducts)
    {
        return $user->hasPermissions(['provider_products_update']);
    }

    /**
     * Determine whether the user can delete the provider products.
     *
     * @param  \App\User  $user
     * @param  \App\ProviderProducts  $providerProducts
     * @return mixed
     */
    public function delete(User $user, ProviderProducts $providerProducts)
    {
        return $user->hasPermissions(['provider_products_remove']);
    }

    /**
     * Determine whether the user can restore the provider products.
     *
     * @param  \App\User  $user
     * @param  \App\ProviderProducts  $providerProducts
     * @return mixed
     */
    public function restore(User $user, ProviderProducts $providerProducts)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the provider products.
     *
     * @param  \App\User  $user
     * @param  \App\ProviderProducts  $providerProducts
     * @return mixed
     */
    public function forceDelete(User $user, ProviderProducts $providerProducts)
    {
        //
    }
}
