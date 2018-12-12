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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/newspaper/read/{year}/{month}/{day}', 'ReaderController@index')->name('news_read');
Route::get('/newspaper/search', 'ContentController@search')->name('news_search');


Route::get('/admin', 'UserController@index')->name('admin_index');

Route::any('/admin/users', 'UserController@list')->name('users');

Route::any('/admin/clients', 'ClientsController@list')->name('clients');
Route::any('/admin/clients/create', 'ClientsController@create')->name('clients_create');
Route::get('/admin/client/view', 'ClientsController@view')->name('client_view');
Route::get('/admin/clients/edit', 'ClientsController@edit')->name('cient_edit');
Route::post('/admin/clients/delete', 'ClientsController@delete')->name('client_delete');

Route::any('/admin/content', 'FilesController@index')->name('content');
Route::post('/admin/content/store', 'FilesController@store')->name('content_store');
Route::post('/admin/content/delete', 'FilesController@store')->name('content_delete');
