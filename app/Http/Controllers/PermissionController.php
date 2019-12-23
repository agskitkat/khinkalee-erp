<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Показывает все роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = Permission::all();
        return view('permission.list', compact('list', 'list'));
    }

    /**
     * Форма редактирования роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false)
    {
        if($id) {
            $permission = Permission::where('id', $id)->first();
            if(!$permission) {
                return abort(404);
            }
        } else {
            $permission = new Permission();
        }

        return view('permission.edit', compact('permission', 'permission'));
    }


    /**
     * Процесс редактирования роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $isNew = false;
        $permission = false;

        if($request->id) {
            $permission = Permission::find($request->id);
        }

        if(!$permission) {
            $isNew = true;
            $permission = new Permission();
        }

        $permission->name = $request->name;
        $permission->code = $request->code;
        $permission->save();

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('permission/edit',  ['id' => $permission->id]);
    }

    /**
     * Удаление роли
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {
        $permission = Permission::find($id);
        if(!$permission) {
            return abort(404);
        }
        $permission->delete();

        return redirect()->route('permissions');
    }
}
