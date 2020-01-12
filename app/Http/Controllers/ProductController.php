<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index() {
        $this->authorize('viewAny', Product::class);
        $groups = ProductGroup::orderBy('sort', 'asc')->get();
        $outOfGroup = Product::where('id_product_group', NULL)->get();
        return view('product.list', [
            'groups' => $groups,
            'outOfGroup' => $outOfGroup ?:[]
        ]);
    }

    /**
     * Форма редактирования
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id = false)
    {
        $this->authorize('viewAny', Product::class);
        if($id) {
            $product = Product::where('id', $id)->first();
            if(!$product ) {
                return abort(404);
            }
        } else {
            $product  = new Product();
        }

        $groups = ProductGroup::all();

        $outOfGroup = Product::where('id_product_group', 0)->get();
        return view('product.edit',  [
            'product' => $product,
            'groups'=> $groups
        ]);
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
        $product = false;

        if($request->id) {
            $product = Product::find($request->id);
            $this->authorize('update',  $product);
        }

        if(!$product) {
            $isNew = true;
            $product = new Product();
            $this->authorize('create', $product);
        }

        $product->name = $request->name;
        $product->id_product_group = $request->id_product_group;
        $product->strong_rel = $request->strong_rel;
        $product->save();

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('product/edit',  ['id' => $product->id]);
    }

    /**
     * Удаление филиала
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id) {
        $product = Product::find($id);
        $this->authorize('delete',  $product);
        if(!$product) {
            return abort(404);
        }
        $product->delete();

        return redirect()->route('products');
    }


    function search(Request $request) {
        $string = $request->string;
        $list = Product::where('name', 'like', '%' .$string . '%')->take(30)->get('id');
        $result = [];

        foreach($list as $item) {
            $item = Product::find($item['id']);
            $result[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }

        return response()->json($result);
    }
}
