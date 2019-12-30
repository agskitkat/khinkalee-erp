<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderProducts extends Model
{
    protected $table = "provider_goods";

    function getProviderName() {
        $provider = Provider::where('id', '=', $this->providers_id)->first();
        if(!$provider) {
            $name = "Нет поставщика";
        } else {
            $name = $provider->name;
        }
        return $name;
    }
}
