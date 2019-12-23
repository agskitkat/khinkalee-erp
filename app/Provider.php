<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    //

    protected $fillable = [
        'name', 'email',
    ];

    function products() {
        return $this->belongsToMany(
            'App\ProviderProducts'
        );
    }

    function countProduct() {
        return DB::table('provider_goods')
            ->where('providers_id', '=',  $this->id)
            ->count();
    }
}
