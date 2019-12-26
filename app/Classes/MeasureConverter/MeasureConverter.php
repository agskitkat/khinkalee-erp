<?php


namespace App\Classes\MeasureConverter;


class MeasureConverter
{
    static $arMass = [
         [
            "name" => ["гр", "г", "грамм", "грам", "g", "gr"],
            "kg"   => 1000
        ],[
            "name" => ["кг", "к", "килог"],
            "kg"   => 1
        ],[
            "name" => ["ц", "цен", "цн"],
            "kg"   => 0.01
        ],[
            "name" => ["тн", "т", "тонн", "тонна"],
            "kg"   => 0.001
        ],[
            "name" => ["л", "литр"],
            "kg"   => 1
        ],[
            "name" => ["мл"],
            "kg"   => 1000
        ]
    ];

    static function converte($str) {
        $str = trim($str);
        $str = str_replace(" ","", $str);
        $str = str_replace(",",".", $str);

        foreach(self::$arMass as $mass) {
            $regMass = implode("|", $mass['name']);

            if (preg_match("/\d+\s?($regMass)/", $str)) {
                    foreach ($mass['name'] as $name) {
                        $str = str_replace($name,"", $str);
                    }
                    return $massFloat = floatval($str) / $mass['kg'];
                }
            }
            /*

               if (strpos($str, $name)) {}

            */


        $str = floatval($str);
        if(!$str) {
            $str = 1;
        }

        return $str;
    }
}
