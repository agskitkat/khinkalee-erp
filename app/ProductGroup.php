<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = [
        'name', 'sort'
    ];

    function getProducts() {
        return Product::where('id_product_group', $this->id)->orderBy('name', 'desc')->get();
    }
}
