<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function getProducts() {
        return OrderProduct::where('id_order',  $this->id)->get();
    }

    function getProductsCount() {
        return OrderProduct::where('id_order',  $this->id)->count();
    }

    function getFilial() {

    }

    function getUser() {

    }

    function getSum() {

    }

    function setProduct($product_id, $product_measure, $product_count) {
        $orderProduct = OrderProduct::where('id_order',  $this->id)
            ->where('id_product', $product_id)
            ->first();

        if(!$orderProduct) {
            $orderProduct = new OrderProduct();
        }

        $orderProduct->id_order = $this->id;
        $orderProduct->id_product = $product_id;
        $orderProduct->measure = $product_measure;
        $orderProduct->count = $product_count;
        $orderProduct->save();
        return $orderProduct;
    }

    function unsetProduct($product_id) {
        $orderProduct = OrderProduct::where('id_order', $this->id)
            ->where('id_product', $product_id)
            ->first();
        if($orderProduct) {
            $orderProduct->delete();
        }
        return true;
    }
}
