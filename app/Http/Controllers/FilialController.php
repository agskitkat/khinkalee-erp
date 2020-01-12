<?php

namespace App\Http\Controllers;

use App\Filial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilialController extends Controller
{
    /**
     * Показывает все филиалы
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Filial::class);
        $list = Filial::all();
        return view('filials.filials', compact('list'));
    }

    /**
     * форма редактирования филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editform($id = false)
    {
        $this->authorize('viewAny', Filial::class);
        if($id) {
            $filial = Filial::where('id', $id)->first();
            if(!$filial) {
                return abort(404);
            }
        } else {
            $filial = new Filial();
        }
        return view('filials.editform', compact('filial', 'filial'));
    }


    /**
     * процесс редактирования
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(Request $request) {
        $message = [];
        $filial = false;
        if($request->id) {
            $filial = Filial::find($request->id);
            // Можно ли редактировать ?
            $this->authorize('update',  $filial);
        }

        if(!$filial) {
            // Можно ли создавать ?
            $this->authorize('create', $filial);
            $filial = new Filial();
        }

        $filial->name = $request->name;
        $filial->address = $request->address;
        $filial->save();

        return redirect()->route('filial/edit',  ['id' => $filial->id]);

    }

    /**
     * удаление филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {

        $filial = Filial::find($id);
        $this->authorize('delete',  $filial);

        if(!$filial) {
            return abort(404);
        }
        $filial->delete();

        return redirect()->route('filials');
    }
}
