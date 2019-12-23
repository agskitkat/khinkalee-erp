<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function roles() {
        //return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    function getRoles() {
        $roles = DB::table('user_role')
            ->where('user_id', '=', $this->id)
            ->join('roles', 'user_role.role_id', '=', 'roles.id')
            ->get();
        return $roles;
    }

    function setRole($arRolesId = []) {
        DB::table('user_role')
            ->where('user_id', '=',  $this->id)
            ->delete();

        if(count($arRolesId)) {

            $arQuery = [];

            foreach($arRolesId as $roleId) {
                $arQuery[] = ['user_id' => $this->id, 'role_id' => $roleId];
            }

            DB::table('user_role')->insert(
                $arQuery
            );
        }

    }

    function hasRole($roleCode) {
        foreach($this->roles as $user_role) {
           if($roleCode === $user_role->code) {
               return true;
           }
        }
        return false;
    }
}
