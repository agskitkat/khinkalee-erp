<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    function getByRole() {
        return $this->belongsToMany('App\Permission', 'role_permissions', 'role_id', 'permissions_id');
    }
}
