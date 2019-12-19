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

    // Работа с филиалом
    Route::get('/filials', 'FilialController@index')->name('filials');
    Route::get('/filial/edit/{id?}', 'FilialController@editform')->where('id', '[0-9]+')->name('filial/edit');
    Route::post('/filial/save', 'FilialController@save')->name('filial/save');

    Route::get('/filial/delete/{id}', 'FilialController@delete')->where('id', '[0-9]+')->name('filial/delete');
});
