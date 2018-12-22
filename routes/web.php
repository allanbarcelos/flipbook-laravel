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
Route::get('/{year?}/{month?}/{day?}', 'HomeController@index')->name('home_edition')
                                                              ->where('year', '[0-9]{4}')
                                                              ->where('month', '[1-9]|1[0,1,2]')
                                                              ->where('day', '[1-9]|0[1-9]|[1,2][0-9]|3[0,1]');

Route::get('/user', 'UserController@index')->name('user');
Route::get('/user/edit', 'UserController@edit')->name('user_edit');
Route::get('/user/change-password', 'UserController@changePassword')->name('user_change_password');

Route::get('/admin', null)->name('admin');

Route::get('/admin/users', 'UsersController@index')->name('users');
Route::get('/admin/users/search', 'UsersController@search');
Route::any('/admin/user/create', 'UsersController@create')->name('user_create');

Route::get('/admin/user/view', 'UsersController@view')->name('user_view');
Route::get('/admin/user/edit', 'UsersController@edit')->name('user_edit');
Route::post('/admin/users/delete', 'UsersController@delete')->name('users_delete');

Route::any('/admin/clients', 'ClientsController@index')->name('clients');
Route::get('/admin/clients/list', 'ClientsController@list')->name('clients_list');
Route::get('/admin/clients/search', 'ClientsController@search');
Route::post('/admin/clients/delete', 'ClientsController@delete')->name('clients_delete');

Route::get('/admin/client', null)->name('client');
Route::any('/admin/client/create', 'ClientsController@create')->name('client_create');
Route::get('/admin/client/view', 'ClientsController@view')->name('client_view');
Route::get('/admin/client/edit', 'ClientsController@edit')->name('client_edit');

Route::any('/admin/content', 'ContentController@index')->name('content');
Route::any('/admin/content/create', 'ContentController@create')->name('content_create');
Route::any('/admin/content/edit', 'ContentController@create')->name('content_edit');
Route::any('/admin/content/search', 'ContentController@search')->name('content_search');
Route::post('/admin/content/delete', 'ContentController@delete')->name('content_delete');
Route::any('/admin/content/check-processing', 'ContentController@checkProcessing')->name('content_checkProcessing');

Route::get('/read/{year}/{month}/{day}', 'ReaderController@index')->name('news_read');
Route::get('/newspaper/search', 'ContentController@search')->name('news_search');
