<?php

namespace App\Http\Controllers;

use App\Order;
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

        $groups = ProductGroup::orderBy('sort', 'asc')->get();
        $outOfGroup = Product::where('id_product_group', NULL)->get();

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
            'outOfGroup' => $outOfGroup ?:[]
        ]);
    }
}
