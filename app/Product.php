<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $inOrder = [];

    protected $fillable = [
        'id_product_group', 'name', 'strong_rel'
    ];

    function getGroupName() {
        if(!$this->id_product_group) {
            return "Без группы";
        }
        $group = ProductGroup::find($this->id_product_group);
        return $group->name;
    }

    function getStrong() {
        $result = [
            'id' => '0',
            'name' => ''
        ];

        if($this->strong_rel) {
            $good = ProviderProducts::find($this->strong_rel);
            if(!$good) {
                $result['id'] = 0;
                $result['name'] = "Товар поставщика удалён";
            } else {
                $result['id'] = $good->id;
                $result['name'] = $good->getProviderName() . " - " . $good->name;
            }
        }

        return $result;
    }
}
