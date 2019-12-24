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
        $filialId = DB::table('users')->insertGetId([
            'name' => "Khinka Lee",
            'address' => 'Никитский бул. 25',
        ]);

        //

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
    }
}
