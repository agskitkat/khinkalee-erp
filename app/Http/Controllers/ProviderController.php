<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Показывает всех поставщиков
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = Provider::all();
        return view('provider.list', compact('list', 'list'));
    }


    /**
     * Форма редактирования поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false)
    {
        if($id) {
            $provider = Provider::where('id', $id)->first();
            if(!$provider) {
                return abort(404);
            }
        } else {
            $provider = new Provider();
        }

        return view('provider.edit', compact('provider', 'provider'));
    }


    /**
     * Процесс редактирования(сохранения) поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $isNew = false;
        $provider = false;

        if($request->id) {
            $provider = Provider::find($request->id);
        }

        if(!$provider) {
            $isNew = true;
            $provider = new Provider();
        }

        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->save();

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('provider/edit',  ['id' => $provider->id]);
    }

    /**
     * Удаление поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {
        $provider = Provider::find($id);
        if(!$provider) {
            return abort(404);
        }
        $provider->delete();
        return redirect()->route('users');
    }
}
