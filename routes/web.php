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

Route::get('/user', 'UsersController@index')->name('user');

Route::get('/admin', 'UsersController@index')->name('admin');
Route::any('/admin/users', 'UsersController@list')->name('users');
Route::any('/admin/users/list', 'UsersController@list')->name('users_list');
Route::any('/admin/users/create', 'UsersController@create')->name('users_create');
Route::get('/admin/users/view', 'UsersController@view')->name('users_view');
Route::get('/admin/users/edit', 'UsersController@edit')->name('users_edit');
Route::post('/admin/users/delete', 'UsersController@delete')->name('users_delete');


Route::get('/admin/client', 'ClientsController@index')->name('client');
Route::get('/admin/clients/list', 'ClientsController@list')->name('clients_list');
Route::any('/admin/clients/create', 'ClientsController@create')->name('clients_create');
Route::get('/admin/client/view', 'ClientsController@view')->name('client_view');
Route::get('/admin/clients/edit', 'ClientsController@edit')->name('client_edit');
Route::post('/admin/clients/delete', 'ClientsController@delete')->name('client_delete');

Route::any('/admin/content/list', 'ContentController@list')->name('content_list');
Route::post('/admin/content/create', 'ContentController@create')->name('content_create');

Route::post('/admin/content/store', 'FilesController@store')->name('content_store');
Route::post('/admin/content/delete', 'FilesController@store')->name('content_delete');
