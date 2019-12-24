<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $fillable = [
        'name', 'code'
    ];

    function users() {
        return $this->belongsToMany('App\User', 'user_role', 'user_id', 'role_id');
    }

    function getAllRoutes() {
        Route::currentRouteName();
    }

    function permissions() {
        return $this->belongsToMany('App\Permission', 'role_permissions', 'role_id', 'permissions_id');
    }

    function hasPermission($permissionCode) {
        foreach($this->permissions as $permission) {
            if($permissionCode === $permission->code) {
                return true;
            }
        }
        return false;
    }

    function setPermission($arPermisssionsId = []) {
        DB::table('role_permissions')
            ->where('role_id', '=',  $this->id)
            ->delete();

        if(count($arPermisssionsId)) {

            $arQuery = [];

            foreach($arPermisssionsId as $permissionId) {
                $arQuery[] = ['role_id' => $this->id, 'permissions_id' => $permissionId];
            }

            DB::table('role_permissions')->insert(
                $arQuery
            );
        }

    }
}
