<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any odel: orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissions(['order_read']);
    }

    /**
     * Determine whether the user can view the odel: order.
     *
     * @param  \App\User  $user
     * @param  \App\odel:Order  $odel:Order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can create odel: orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions(['order_create']);
    }

    /**
     * Determine whether the user can update the odel: order.
     *
     * @param  \App\User  $user
     * @param  \App\odel:Order  $odel:Order
     * @return mixed
     */
    public function update(User $user,  Order $order)
    {
        if( $user->hasPermissions(['order_update'])) {
            return true;
        } else {
            return $user->hasPermissions(['order_update_self'], $order);
        }
    }

    /**
     * Determine whether the user can delete the odel: order.
     *
     * @param  \App\User  $user
     * @param  \App\odel:Order  $odel:Order
     * @return mixed
     */
    public function delete(User $user,  Order $order)
    {
        if( $user->hasPermissions(['order_remove'])) {
            return true;
        } else {
            return $user->hasPermissions(['order_remove_self'], $order);
        }
    }

    /**
     * Determine whether the user can restore the odel: order.
     *
     * @param  \App\User  $user
     * @param  \App\odel:Order  $odel:Order
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the odel: order.
     *
     * @param  \App\User  $user
     * @param  \App\odel:Order  $odel:Order
     * @return mixed
     */
    public function forceDelete(User $user,  Order $order)
    {
        //
    }
}
