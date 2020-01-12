<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Показывает все роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $list = Role::all();
        return view('role.list', compact('list'));
    }

    /**
     * Форма редактирования роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false) {
        if($id) {
            $role = Role::where('id', $id)->first();
            if(!$role) {
                return abort(404);
            }
        } else {
            $role = new Role();
        }

        $allPermissions = Permission::all();
        $permissions = $role->permissions();

        return view('role.edit', ['permissions' => $permissions, 'role' => $role, 'permissionsList'=> $allPermissions]);
    }


    /**
     * Процесс редактирования роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $isNew = false;
        $role = false;

        if($request->id) {
            $role = Role::find($request->id);
        }

        if(!$role) {
            $isNew = true;
            $role = new Role();
        }

        $role->name = $request->name;
        $role->code = $request->code;
        $role->save();


        $arPermissions = [];
        if($request->permissions) {
            foreach ($request->permissions as $permission) {
                $arPermissions[] = +$permission;
            }
        }
        $role->setPermission($arPermissions);

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('role/edit',  ['id' => $role->id]);
    }

    /**
     * Удаление роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {
        $role = Role::find($id);
        if(!$role) {
            return abort(404);
        }
        $role->delete();

        return redirect()->route('roles');
    }
}
