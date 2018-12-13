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
Route::get('/newspaper/read/{year}/{month}/{day}', 'ReaderController@index')->name('news_read');
Route::get('/newspaper/search', 'ContentController@search')->name('news_search');

Route::get('/user', 'UsersController@index')->name('user');

Route::get('/admin', function () { return true; })->name('admin');
Route::any('/admin/users', function () { return true; })->name('users');
Route::get('/admin/users/list', 'UsersController@list')->name('users_list');
Route::get('/admin/users/search', 'UsersController@search');
Route::any('/admin/users/create', 'UsersController@create')->name('users_create');
Route::get('/admin/users/view', 'UsersController@view')->name('users_view');
Route::get('/admin/users/edit', 'UsersController@edit')->name('users_edit');
Route::delete('/admin/users/delete', function () { return true; })->name('users_delete');

Route::any('/admin/clients', function () { return true; })->name('client');
Route::get('/admin/clients/list', 'ClientsController@list')->name('clients_list');
Route::get('/admin/clients/search', 'ClientsController@search');
Route::any('/admin/clients/create', 'ClientsController@create')->name('clients_create');
Route::get('/admin/client/view', 'ClientsController@view')->name('client_view');
Route::get('/admin/clients/edit', 'ClientsController@edit')->name('client_edit');
Route::delete('/admin/clients/delete', function () { return true; })->name('client_delete');

Route::any('/admin/content', function () { return true; })->name('content');
Route::any('/admin/content/list', 'ContentController@list')->name('content_list');
Route::any('/admin/content/create', 'ContentController@create')->name('content_create');
Route::any('/admin/content/edit', 'ContentController@create')->name('content_edit');
Route::delete('/admin/content/delete', function () { return true; })->name('content_delete');
