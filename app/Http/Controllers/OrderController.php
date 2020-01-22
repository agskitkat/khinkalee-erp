<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index() {
        //$this->authorize('viewAny', Order::class);

        // Проверка пользователя на чтение своих записей !
        $user = Auth::user();
        if($user->hasPermissions(['order_read_self']) && !$user->hasRole('superadmin') ) {

            $orders = Order::where('user_id', $user->id)
                ->orderBy('updated_at', 'asc')
                ->get();

        } else {
            $this->authorize('viewAny', Order::class);
            $orders = Order::orderBy('updated_at', 'asc')->get();
        }

        return view('order.list', [
            'list' => $orders
        ]);
    }

    /**
     * Форма редактирования
     * @param bool $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id = false) {


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

        $user = Auth::user();
        if($request->id) {
            // Проверка на разрешения обновления
            if($user->hasPermissions(['order_read_self']) && !$user->hasRole('superadmin') ) {
                $order = Order::where('id', $request->id)
                    ->where('user_id', $user->id)
                    ->first();
            } else {
                $order = Order::find($request->id);
                $this->authorize('update', $order);
            }
        }

        if(!$order) {
            $isNew = true;
            $order = new Order();
            $this->authorize('create', $order);
            $order->user_id = $user->id;
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
     * @param bool $id
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function orderFillingEnd($id = false) {
        $order = false;

        $user = Auth::user();


        if($id) {
            if($user->hasPermission(['order_self_update'])) {
                $order = Order::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
            } else {
                $this->authorize('update',  $order);
                $order = Order::where('id', $id)->first();
            }
        }

        if(!$order) {
            return abort(404);
        }

        $order->status = "check";
        $order->save();

        return redirect()->route('orders');
    }
}
