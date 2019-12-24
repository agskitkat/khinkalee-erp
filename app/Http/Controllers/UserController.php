<?php

namespace App\Http\Controllers;

use App\Filial;
use App\GroupRole;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Показывает все филиалы
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = User::all();
        return view('user.list', compact('list', 'list'));
    }

    /**
     * Форма редактирования филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false)
    {
        if($id) {
            $user = User::where('id', $id)->first();
            if(!$user ) {
                return abort(404);
            }
        } else {
            $user  = new User();
        }

        $roles = Role::all();
        $userRoles = $user->getRoles();

        return view('user.edit',  ['user' => $user, 'roles' => $roles, 'userRoles' => $userRoles]);
    }


    /**
     * Процесс редактирования
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $isNew = false;
        $user = false;

        if($request->id) {
            $user = User::find($request->id);
        }

        if(!$user) {
            $isNew = true;
            $user = new User();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $arRoles = [];
        if($request->roles) {
            foreach ($request->roles as $role) {
                $arRoles[] = +$role;
            }
        }
        $user->setRole($arRoles);

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('user/edit',  ['id' => $user->id]);
    }

    /**
     * Удаление филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {
        $user = User::find($id);
        if(!$user) {
            return abort(404);
        }
        $user->delete();

        return redirect()->route('users');
    }
}
