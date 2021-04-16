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

use App\Services\ViacepService;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('company.client', 'ClientController')->except(['index', 'create', 'edit'])->shallow();
Route::resource('client.adress', 'AdressController')->except(['index', 'create', 'edit'])->shallow();
Route::get('/viacep/{cep}', 'ViacepController@getByCep')->name('viacep.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
