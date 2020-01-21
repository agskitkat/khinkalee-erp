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
        $this->authorize('viewAny', Role::class);
        $list = Role::all();
        return view('role.list', compact('list'));
    }

    /**
     * Форма редактирования роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false) {
        $this->authorize('viewAny', Role::class);
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
            $this->authorize('update',  $role);
        }

        if(!$role) {
            $isNew = true;
            $role = new Role();
            $this->authorize('create',  $role);
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
        $this->authorize('remove',  $role);
        if(!$role) {
            return abort(404);
        }
        $role->delete();

        return redirect()->route('roles');
    }
}
