<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    //
    public function index() {
        $this->authorize('viewAny', ProductGroup::class);
        $list = ProductGroup::all();
        return view('product.group.list', ['list'=>$list]);
    }


    public function edit($id = false)
    {
        $this->authorize('viewAny', ProductGroup::class);
        if($id) {
            $group = ProductGroup::where('id', $id)->first();
            if(!$group ) {
                return abort(404);
            }
        } else {
            $group  = new ProductGroup();
        }

        return view('product.group.edit',  ['group' => $group]);
    }


    /**
     * Процесс редактирования
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(Request $request)
    {
        $isNew = false;
        $group = false;

        if($request->id) {
            $group = ProductGroup::find($request->id);
            $this->authorize('update',  $group);
        }

        if(!$group) {
            $isNew = true;
            $group = new ProductGroup();
            $this->authorize('create', $group);
        }

        $group->name = $request->name;
        $group->sort = $request->sort;
        $group->save();

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('group/edit',  ['id' => $group->id]);
    }

    /**
     * Удаление филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id) {
        $group = ProductGroup::find($id);
        $this->authorize('delete',  $group);
        if(!$group) {
            return abort(404);
        }
        $group->delete();

        return redirect()->route('groups');
    }


}
