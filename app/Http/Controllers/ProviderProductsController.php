<?php

namespace App\Http\Controllers;

use App\ProviderProducts;
use Illuminate\Http\Request;

class ProviderProductsController extends Controller
{
    /**
     * Показывает всех поставщиков
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = ProviderProducts::all();
        return view('provider.product.list', compact('list'));
    }


    /**
     * Форма редактирования поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false)
    {
        if($id) {
            $product = ProviderProducts::where('id', $id)->first();
            if(!$product) {
                return abort(404);
            }
        } else {
            $product = new ProviderProducts();
        }

        return view('provider.product.edit', compact('product'));
    }


    /**
     * Процесс редактирования(сохранения) поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(Request $request)
    {
        $isNew = false;
        $product = false;

        if($request->id) {
            $product = ProviderProducts::find($request->id);
        }

        if(!$product) {
            $isNew = true;
            $product = new ProviderProducts();
        }

        $product->name = $request->name;
        $product->article = $request->article;
        $product->providers_id = $request->providers_id;
        $product->price = $request->price;
        $product->measure = $request->measure;
        $product->mass = $request->mass;
        $product->divider = $request->divider;

        $product->save();

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('provider-product/edit',  ['id' => $product->id]);
    }

    /**
     * Удаление поставщика
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id) {
        $product = ProviderProducts::find($id);
        if(!$product) {
            return abort(404);
        }
        $product->delete();
        return redirect()->route('provider-products');
    }

    function search(Request $request) {
        $string = $request->string;
        $list = ProviderProducts::where('name', 'like', '%' .$string . '%')->take(30)->get('id');
        $result = [];
        foreach($list as $item) {
            $item = ProviderProducts::find($item['id']);
            $provider = $item->getProviderName();
            $result[] = [
               'id' => $item->id,
               'name' => $provider . ' - ' .  $item->name
            ];
        }
        return response()->json($result);
    }
}
