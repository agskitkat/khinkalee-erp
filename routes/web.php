<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('disallow', function() {
    return "Disallow";
});

Auth::routes();

Route::group(['middleware' => 'checkauth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    // Маршруты филиала
    Route::get('/filials', 'FilialController@index')->name('filials');
    Route::get('/filial/edit/{id?}', 'FilialController@editform')->where('id', '[0-9]+')->name('filial/edit');
    Route::post('/filial/save', 'FilialController@save')->name('filial/save');
    Route::get('/filial/delete/{id}', 'FilialController@delete')->where('id', '[0-9]+')->name('filial/delete');

    // Маршруты пользователя
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/user/edit/{id?}', 'UserController@edit')->where('id', '[0-9]+')->name('user/edit');
    Route::post('/user/save', 'UserController@save')->name('user/save');
    Route::get('/user/delete/{id}', 'UserController@delete')->where('id', '[0-9]+')->name('user/delete');

    // Роли пользователей
    Route::get('/roles', 'RoleController@index')->name('roles');
    Route::get('/role/edit/{id?}', 'RoleController@edit')->where('id', '[0-9]+')->name('role/edit');
    Route::post('/role/save', 'RoleController@save')->name('role/save');
    Route::get('/role/delete/{id}', 'RoleController@delete')->where('id', '[0-9]+')->name('role/delete');


});
