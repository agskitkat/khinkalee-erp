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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/filials', 'FilialController@index')->name('filials');
Route::get('/filial/edit', 'FilialController@editform')->name('filial/edit');
Route::post('/filial/save', 'FilialController@save')->name('filial/save');
