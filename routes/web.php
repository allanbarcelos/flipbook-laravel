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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('homeIndex');
Route::get('/newspaper/{year}/{month}/{day}', 'HomeController@newspaperView')->name('newsView');

Route::get('/admin', 'AdminController@index')->name('adminIndex');

Route::any('/admin/clients/list', 'ClientsController@list')->name('clientsList');
Route::any('/admin/clients/create', 'ClientsController@create')->name('clientsCreate');

Route::get('/admin/client/view/{id}', 'ClientsController@view')->name('clientView');
Route::get('/admin/clients/edit/{id}', 'ClientsController@edit')->name('cientEdit');
Route::post('/admin/clients/delete', 'ClientsController@delete')->name('clientDelete');

Route::any('/files/upload', 'FilesController@index');
Route::post('/files/store', 'FilesController@store')->name('store');
