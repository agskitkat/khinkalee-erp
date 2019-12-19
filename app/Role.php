<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    function users() {
        return $this->belongsToMany('App\User', 'user_role', 'user_id', 'role_id');
    }
}
