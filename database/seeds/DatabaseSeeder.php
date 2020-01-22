<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Филиал
        $filialId = DB::table('filials')->insertGetId([
            'name' => "Khinka Lee",
            'address' => 'Никитский бул. 25',
        ]);

        //
      /*
      {
            "sittings":{
            "offsetRows" :"12",
            "goodRowCountParam":"5"
            },
            "article":{
                        "pos":"1",
            "sprintf":"%05d"
            },
            "name":{
                        "pos":"3"
            },
            "price": {
                        "pos":"8"
            },
            "measure":{
                        "pos":"7"
            },
            "mass":{
                        "recursive":[
                            "checkMass",
                            "findMassByName"
                        ]
            },
            "checkMass":{
                        "expression":"IsSetMass",
            "ismass":"true",
            "pos":"6"
            },
            "IsSetMass": {
                        "pos":"7",
            "regexp":"/^(кг)$/u"
            },
            "findMassByName":{
                        "ismass":"true",
            "pos":"3",
            "regexp":"/(\\d+(,|\\.)?\\d+)\\s?(г|гр|кг)/u",
            "default":"1"
            }
       }
      */

       // Поставщик
        $userId = DB::table('providers')->insertGetId([
            'email' => "agskitkat@gmail.com",
            'name' => 'Фрут Сити',
            'excel_rules' => '{ 
"sittings":{ 
"offsetRows":"12",
"goodRowCountParam":"5"
},
"article":{ 
"pos":"1",
"sprintf":"%05d"
},
"name":{ 
"pos":"3"
},
"price":{ 
"pos":"8"
},
"measure":{ 
"pos":"7"
},
"mass":{ 
"recursive":[ 
"checkMass",
"findMassByName"
]
},
"checkMass":{ 
"expression":"IsSetMass",
"ismass":"true",
"pos":"6"
},
"IsSetMass":{ 
"pos":"7",
"regexp":"/^(кг)$/u"
},
"findMassByName":{ 
"ismass":"true",
"pos":"3",
"regexp":"/(\\d+(,|\\.)?\\d+)\\s?(г|гр|кг)/u",
"default":"1"
}
}',
        ]);

        // Пользователи и роли
        $userId = DB::table('users')->insertGetId([
            'name' => "Georgy",
            'email' => 'agskitkat@gmail.com',
            'password' => bcrypt('123123123'),
        ]);
        $roleId = DB::table('roles')->insertGetId([
            'name' => "Супер Администратор",
            'code' => 'superadmin'
        ]);
        DB::table('user_role')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => "Cheef",
            'email' => 'cheef@cheef.com',
            'password' => bcrypt('123123123'),
        ]);
        $roleId = DB::table('roles')->insertGetId([
            'name' => "Шеф",
            'code' => 'cheef'
        ]);
        DB::table('user_role')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);


        // Товары и группы
        $Product_group_Id = DB::table('product_groups')->insertGetId([
            'name' => "Мясо",
            'sort' => '1'
        ]);
        $arProductName = [
            'Баранья мякоть',
            'Говяжий жир',
            'Говяжья вырезка',
            'Говяжья мякоть',
            'Свиная мякоть',
            'Свиная шейка',
            'Телятина мякоть'
        ];

        foreach ($arProductName as $name ) {
            DB::table('products')->insertGetId([
                'name' => $name,
                'id_product_group' => $Product_group_Id
            ]);
        }


        // Операции филиалов
        DB::table('permissions')->insert([
            'name' => "Филиал: чтение",
            'code' => 'filials_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Филиал: создание",
            'code' => 'filials_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Филиал: Изменять все",
            'code' => 'filials_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Филиал: Изменять свой",
            'code' => 'filials_self'
        ]);
        DB::table('permissions')->insert([
            'name' => "Филиал: Удалить любой",
            'code' => 'filials_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Филиал: Удалить свой",
            'code' => 'filials_remove_self'
        ]);

        // Операции пользователей
        DB::table('permissions')->insert([
            'name' => "Пользователь: чтение",
            'code' => 'user_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Пользователь: создание",
            'code' => 'user_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Пользователь: изменение всех",
            'code' => 'user_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Пользователь: изменение только себя",
            'code' => 'user_self_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Пользователь: удаление",
            'code' => 'user_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Пользователь: удаление только себя",
            'code' => 'user_remove_self'
        ]);

        // Операции с ролями
        DB::table('permissions')->insert([
            'name' => "Роли: чтение",
            'code' => 'role_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Роли: создание",
            'code' => 'role_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Роли: изменение",
            'code' => 'role_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Роли: удаление",
            'code' => 'role_remove'
        ]);


        // Операции с используемыми товарами
        DB::table('permissions')->insert([
            'name' => "Продукт: чтение",
            'code' => 'product_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Продукт: создание",
            'code' => 'product_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Продукт: изменение всех",
            'code' => 'product_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Продукт: изменение только себя",
            'code' => 'product_self_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Продукт: удаление",
            'code' => 'product_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Продукт: удаление только себя",
            'code' => 'product_remove_self'
        ]);

        // Операции с группами продуктов
        DB::table('permissions')->insert([
            'name' => "Группа продукта: чтение",
            'code' => 'group_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Группа продукта: создание",
            'code' => 'group_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Группа продукта: изменение всех",
            'code' => 'group_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Группа продукта: изменение только себя",
            'code' => 'group_self_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Группа продукта: удаление",
            'code' => 'group_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Группа продукта: удаление только себя",
            'code' => 'group_remove_self'
        ]);



        // Операции с ЗАКАЗАМИ
        DB::table('permissions')->insert([
            'name' => "Заказ: чтение только себя",
            'code' => 'order_read_self'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: чтение",
            'code' => 'order_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: создание",
            'code' => 'order_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: изменение всех",
            'code' => 'order_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: изменение только себя",
            'code' => 'order_self_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: удаление",
            'code' => 'order_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Заказ: удаление только себя",
            'code' => 'order_remove_self'
        ]);


        // Операции с операциями ))
        DB::table('permissions')->insert([
            'name' => "Операции: чтение",
            'code' => 'permission_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Операции: создание",
            'code' => 'permission_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Операции: изменение всех",
            'code' => 'permission_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Операции: изменение только себя",
            'code' => 'permission_update_self'
        ]);
        DB::table('permissions')->insert([
            'name' => "Операции: удаление",
            'code' => 'permission_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Операции: удаление только себя",
            'code' => 'permission_remove_self'
        ]);


        // Операции с Поставщиками
        DB::table('permissions')->insert([
            'name' => "Поставщик: чтение",
            'code' => 'provider_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Поставщик: создание",
            'code' => 'provider_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Поставщик: изменение всех",
            'code' => 'provider_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Поставщик: изменение только себя",
            'code' => 'provider_update_self'
        ]);
        DB::table('permissions')->insert([
            'name' => "Поставщик: удаление",
            'code' => 'provider_remove'
        ]);
        DB::table('permissions')->insert([
            'name' => "Поставщик: удаление только себя",
            'code' => 'provider_remove_self'
        ]);
        // Операции с товарами Поставщика
        DB::table('permissions')->insert([
            'name' => "Товар Поставщик: чтение",
            'code' => 'provider_products_read'
        ]);
        DB::table('permissions')->insert([
            'name' => "Товар Поставщик: создание",
            'code' => 'provider_products_create'
        ]);
        DB::table('permissions')->insert([
            'name' => "Товар Поставщик: изменение всех",
            'code' => 'provider_products_update'
        ]);
        DB::table('permissions')->insert([
            'name' => "Товар Поставщик: удаление",
            'code' => 'provider_products_remove'
        ]);


    }
}
