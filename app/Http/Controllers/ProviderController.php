<?php

namespace App\Http\Controllers;

use App\Provider;
use App\ProviderProducts;
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


        $table = $xlsx->rows();
        $products = [];
        if($table) {
            if(isset($obrules->sittings->offsetRows)) {
                $table = array_slice($table, intval($obrules->sittings->offsetRows));
            }
            foreach ($table as $row) {
                if($this->checkGoodRow($row, $obrules->sittings)) {
                    $product = $this->parceRow($row, $obrules, $provider->id);
                    $products[] = $product;
                }
            }
        } else {
            flash("Таблица пуста")->warning()->important();
            return redirect()->route('providers/excel', ['id'=> $provider->id]);
        }

        return view('provider.excel_result', compact('products'));
    }


    protected function parceRow($row, $rules, $provider_id) {
       /*
        echo "<pre>";
        print_r($row);
        echo "</pre>";
       */

        // Получаем данные по правилам
        $article = trim($this->research($row, $rules->article));
        $price   = $this->research($row, $rules->price);
        $name    = $this->research($row, $rules->name);
        $measure = $this->research($row, $rules->measure);


        $result = [
            "article" => $article,
            "price" => $price,
            "name" => $name,
            "measure" => trim($measure),

            /*
            "mass" => $mass,
            "divider" => $divider
            */
        ];

        echo "<pre>";
        print_r($result);
        echo "</pre>";

        return $result;

        // Проверяем, есть ли такой в базе по артикулу
        $good = ProviderProducts::where('article', '=', $article)
            ->where('providers_id', '=', $provider_id)
            ->first();

        if(!$good) {
            $good = new ProviderProducts;
            $good->isnew = true;
        } else {
            $good->isnew = false;
        }

        $good->providers_id = $provider_id;
        $good->article = $article;
        $good->price = $price;
        $good->name = $name;
        $good->measure = $measure;
        $good->mass = 1;
        $good->divider = 1;
        $good->save();

        return $good;
    }

    protected function research($row, $ruleName) {
        if(isset($ruleName)) {
            if(isset($ruleName->pos)) {
                $strRow = "" . $row[$ruleName->pos];

                if(isset($ruleName->regexp)) {

                }

                $result = $strRow;
            } else {
                // TODO: Если позиция не указана, то пробуем условие
            }
        } else {
            // TODO: Что то делать если нет значения !!!
            $result = "BAD";
        }

        // Преобразование к формату
        if(isset($ruleName->sprintf)) {
            $result = $this->formatString($result, $ruleName->sprintf);
        }

        return $result;
    }

    protected function checkGoodRow($row, $sittings) {
        if(isset($sittings->goodRowCountParam)) {
            $notEmptyColsCount = 0;
            foreach($row as $col) {
                if(!empty($col)) {
                    $notEmptyColsCount++;
                }
            }
            if($notEmptyColsCount < intval($sittings->goodRowCountParam)) {
                return false;
            }
        }
        return true;
    }

    protected function formatString($str, $format) {
       return sprintf($format, $str);
    }
}
