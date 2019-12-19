<?php

namespace App\Http\Controllers;

use App\Filial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilialController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = Filial::all();
        return view('filials.filials', compact('list', 'list'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editform()
    {

        return view('filials.editform');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $message = [];
        $filial = false;

        if($request->id) {
            $filial = App\Filial::find($request->id);
        }

        if(!$filial) {
            $filial = new Filial();
        }

        $filial->name = $request->name;
        $filial->address = $request->address;
        $filial->save();

        return view('filials.editform')->with('message', []);
    }
}
