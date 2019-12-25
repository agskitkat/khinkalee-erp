<?php

namespace App\Http\Controllers;

use App\Provider;
use Exception;
use Illuminate\Http\Request;
use SimpleXLSX;

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
        $provider->excel_rules = trim($request->excel_rules);
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
        return redirect()->route('providers');
    }


    /**
     * Форма обновления excel
     */
    function excel($provider_id) {
        $provider = Provider::find($provider_id);

        if(!$provider) {
            flash('Поставщик не найден !')->error()->important();
            return redirect()->route('providers');
        }

        return view('provider.excel_upload', compact('provider'));
    }



    /**
     * Процесс обновления товаров через excel
     */
    function excel_process(Request $request, $provider_id) {
        $provider = Provider::find($provider_id);

        if(!$provider) {
            flash('Поставщик не найден !')->error()->important();
            return redirect()->route('providers');
        }

        $file = $request->file('xlsx');
        if(!$file) {
            flash('Ошибка файла !')->error()->important();
            return redirect()->route('providers/excel', ['id'=> $provider->id]);
        }

        // https://github.com/shuchkin/simplexlsx
        if ( !$xlsx = SimpleXLSX::parse($file->getPathname()) ) {
            flash(SimpleXLSX::parseError())->error()->important();
            return redirect()->route('providers/excel', ['id'=> $provider->id]);
        }

        try {
            $obrules = json_decode($provider->excel_rules);
        } catch (Exception $e) {
            flash("Ошибка в правиле обработки")->error()->important();
            return redirect()->route('providers/excel', ['id'=> $provider->id]);
        }

        echo "<pre>";
        print_r($obrules);
        echo "</pre>";
        $table = $xlsx->rows();
        $products = [];
        if($table) {
            foreach ($xlsx->rows() as $row) {
                $product = $this->parceRow($row, $obrules);
                $products[] = $product;
            }
        } else {
            flash("Таблица пуста")->warning()->important();
            return redirect()->route('providers/excel', ['id'=> $provider->id]);
        }

        //dd( $obrules );

        //return view('provider.excel_upload', compact('provider'));
    }


    protected function parceRow($row, $rules) {

    }
}
