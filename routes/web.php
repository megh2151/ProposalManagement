<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'Admin\HomeController@index')->name('admin.route')->middleware('authentic');
Route::get('admin/users', 'Admin\UsersController@index')->name('admin.users')->middleware('authentic');
Route::get('admin/user/create', 'Admin\UsersController@create')->name('admin.users.create')->middleware('authentic');
Route::get('admin/user/edit/{id}', 'Admin\UsersController@edit')->name('admin.users.edit')->middleware('authentic');
Route::post('admin/user/delete', 'Admin\UsersController@delete')->name('admin.users.delete')->middleware('authentic');
Route::post('admin/user/store', 'Admin\UsersController@store')->name('admin.users.store')->middleware('authentic');

Route::get('user/home', 'HomeController@authenticationValidateUser')->name('user.route')->middleware('authentic');
