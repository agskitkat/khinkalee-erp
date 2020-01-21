<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index() {
        $this->authorize('viewAny', Order::class);
        $orders = Order::orderBy('updated_at', 'asc')->get();
        return view('order.list', [
            'list' => $orders
        ]);
    }


    /**
     * Форма редактирования
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id = false) {
        $this->authorize('viewAny', Order::class);
        if($id) {
            $order = Order::where('id', $id)->first();
            if(!$order ) {
                return abort(404);
            }
        } else {
            $order  = new Order();
        }

        $orderProductState = $order->getProducts();
        $groups = ProductGroup::orderBy('sort', 'asc')->get();
        $outOfGroup = Product::where('id_product_group', NULL)->get();

        $arOrderProductState = [];
        foreach($orderProductState as $p) {
            $arOrderProductState[$p->id_product] = [
                "measure" => $p->measure,
                "count" => $p->count,
            ];
        }

        foreach($groups as &$group) {
            if(count($products = $group->getProducts())) {
                foreach($products as $product) {

                    $group->products[] = $product;
                }
            }
        }

        return view('order.edit',  [
            'order' => $order,
            'groups' => $groups,
            'outOfGroup' => $outOfGroup ?:[],
            'arOrderProductState' => $arOrderProductState
        ]);
    }


    /**
     * Сохранить
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(Request $request)
    {
        $isNew = false;
        $order = false;

        if($request->id) {
            $order = Order::find($request->id);
            $this->authorize('update',  $order);
        }

        if(!$order) {
            $isNew = true;
            $order = new Order();
            $this->authorize('create', $order);
        }


        $order->name = $request->name;
        $order->status = $request->status?:"filling";
        $order->comment = $request->comment;
        $order->save();

        foreach($request->product as $id => $product) {
            if($product['count'] === 0 || empty($product['count'])) {
                $order->unsetProduct($id);
            } else {
                $order->setProduct($id, $product['measure'], $product['count']);
            }
        }

        if( $isNew ) {
            flash('Создано !')->success()->important();
        } else {
            flash('Обновлено !')->success()->important();
        }

        return redirect()->route('order/edit',  ['id' => $order->id]);
    }

    /**
     *  Установить статус на проверке
     */
    public function orderFillingEnd($id = false) {
        $order = false;

        if($id) {
            $order = Order::where('id', $id)->first();
        }

        if(!$order) {
            return abort(404);
        }

        $this->authorize('update',  $order);

        $order->status = "check";
        $order->save();

        return redirect()->route('orders');
    }
}
