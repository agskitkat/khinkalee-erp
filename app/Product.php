<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'ID_T_PRODUCT_GROUP', 'NAME', 'STRONG_REL',
    ];
}
