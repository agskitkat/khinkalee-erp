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
     */
    public function index()
    {
        $list = Filial::all();
        return view('filials.filials', compact('list', 'list'));
    }

    /**
     * форма редактирования филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editform($id = false)
    {
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
     */
    public function save(Request $request)
    {
        $message = [];
        $filial = false;

        if($request->id) {
            $filial = Filial::find($request->id);
        }

        if(!$filial) {
            $filial = new Filial();
        }

        $filial->name = $request->name;
        $filial->address = $request->address;
        $filial->save();

        return redirect()->route('filial/edit',  ['id' => $filial->id, 'message' => ['Обновлено']]);

    }

    /**
     * удаление филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {

        $flight = Filial::find($id);
        if(!$flight) {
            return abort(404);
        }
        $flight->delete();

        return redirect()->route('filials');
    }
}
