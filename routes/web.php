<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
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
    return view('landingPage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'Admin\HomeController@index')->name('admin.route')->middleware('authentic');
Route::get('admin/users', 'Admin\UsersController@index')->name('admin.users')->middleware('authentic');
Route::get('admin/user/create', 'Admin\UsersController@create')->name('admin.users.create')->middleware('authentic');
Route::get('admin/user/edit/{id}', 'Admin\UsersController@edit')->name('admin.users.edit')->middleware('authentic');
Route::post('admin/user/delete', 'Admin\UsersController@delete')->name('admin.users.delete')->middleware('authentic');
Route::post('admin/user/store', 'Admin\UsersController@store')->name('admin.users.store')->middleware('authentic');
Route::post('admin/user/update', 'Admin\UsersController@update')->name('admin.user.update')->middleware('authentic');


Route::get('admin/categories', 'Admin\CategoryController@index')->name('admin.categories')->middleware('authentic');
Route::get('admin/category/create', 'Admin\CategoryController@create')->name('admin.category.create')->middleware('authentic');
Route::get('admin/category/edit/{id}', 'Admin\CategoryController@edit')->name('admin.category.edit')->middleware('authentic');
Route::post('admin/category/delete', 'Admin\CategoryController@delete')->name('admin.category.delete')->middleware('authentic');
Route::post('admin/category/store', 'Admin\CategoryController@store')->name('admin.category.store')->middleware('authentic');
Route::post('admin/category/update', 'Admin\CategoryController@update')->name('admin.category.update')->middleware('authentic');

Route::get('admin/category/{id}/subcategory/create', 'Admin\CategoryController@createSubcategory')->name('admin.subcategory.create')->middleware('authentic');
Route::get('admin/category/{id}/subcategory', 'Admin\CategoryController@subCategoryIndex')->name('admin.subcategory.index')->middleware('authentic');
Route::get('admin/category/{id}/subcategory/{subid}/edit', 'Admin\CategoryController@subCategoryEdit')->name('admin.subcategory.edit')->middleware('authentic');
Route::post('admin/subcategory/delete', 'Admin\CategoryController@subCategoryDelete')->name('admin.subcategory.delete')->middleware('authentic');
Route::post('admin/subcategory/store', 'Admin\CategoryController@subCategoryStore')->name('admin.subcategory.store')->middleware('authentic');
Route::post('admin/subcategory/update', 'Admin\CategoryController@subCategoryUpdate')->name('admin.subcategory.update')->middleware('authentic');

Route::get('admin/proposals', 'Admin\ProposalController@index')->name('admin.proposal.index')->middleware('authentic');
Route::post('admin/proposals/update', 'Admin\ProposalController@update')->name('admin.proposal.update')->middleware('authentic');

Route::get('admin/proposals/preview/{path}', function ($filename) {
    // Check if the file exists in the storage
    if (!Storage::disk('local')->exists($filename)) {
        abort(404);
    }
    
    // Get the file path and content type
    $filePath = storage_path('app/' . $filename);
    $contentType = Storage::disk('local')->mimeType($filename);
   
    // Return the file for preview
    return response()->file($filePath, [
        'Content-Type' => $contentType,
        'Content-Disposition' => 'inline',
    ]);
    
});

Route::get('admin/proposals/download/{filename}', function ($filename) {
    // Check if the file exists in the storage
    if (!Storage::disk('local')->exists($filename)) {
        abort(404);
    }

    // Get the file path and content type
    $filePath = storage_path('app/' . $filename);
    $contentType = Storage::disk('local')->mimeType($filename);

    // Return the file for download
    return response()->download($filePath, $filename, ['Content-Type' => $contentType]);
});

Route::get('admin/proposals/{id}/chat', 'Admin\ProposalController@chat')->name('admin.proposal.chat')->middleware('authentic');

Route::get('user/home', 'HomeController@authenticationValidateUser')->name('user.route')->middleware('authentic');

Route::get('/countries/{id}/phone-code', 'Auth\RegisterController@getPhoneCode');
