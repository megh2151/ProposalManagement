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

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);

Auth::routes();

Route::get('admin/home', 'Admin\HomeController@index')->name('admin.route')->middleware('authentic');

Route::get('admin/users', 'Admin\UsersController@index')->name('admin.users')->middleware('authentic');
Route::get('admin/user/create', 'Admin\UsersController@create')->name('admin.users.create')->middleware('authentic');
Route::get('admin/user/edit/{id}', 'Admin\UsersController@edit')->name('admin.users.edit')->middleware('authentic');
Route::post('admin/user/delete', 'Admin\UsersController@delete')->name('admin.users.delete')->middleware('authentic');
Route::post('admin/user/store', 'Admin\UsersController@store')->name('admin.users.store')->middleware('authentic');
Route::post('admin/user/update', 'Admin\UsersController@update')->name('admin.user.update')->middleware('authentic');



Route::get('admin/proposal-users', 'Admin\UsersController@propUserindex')->name('admin.proposal.users')->middleware('authentic');
Route::get('admin/proposal-users/{id}/chat', 'Admin\UsersController@propUserChat')->name('admin.proposal.users.chat')->middleware('authentic');
Route::post('admin/proposal-users/send-activation', 'Admin\UsersController@sendActivation')->name('admin.propusers.send-activation')->middleware('authentic');

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

// Proposals
Route::get('admin/proposals', 'Admin\ProposalController@index')->name('admin.proposal.index')->middleware('authentic');
Route::post('admin/proposals/update', 'Admin\ProposalController@update')->name('admin.proposal.update')->middleware('authentic');
Route::get('admin/proposals/{id}/view/', 'Admin\ProposalController@view')->name('admin.proposal.view')->middleware('authentic');
Route::get('admin/proposals/preview/{path}', function ($filename) {
    // Check if the file exists in the storage
    if (!Storage::disk('public')->exists('proposals/'.$filename)) {
        abort(404);
    }
    
    // Get the file path and content type
    $filePath = storage_path('app/' . 'public/proposals/'.$filename);
    $contentType = Storage::disk('public')->mimeType('proposals/'.$filename);

    // Return the file for preview
    return response()->file($filePath, [
        'Content-Type' => $contentType,
        'Content-Disposition' => 'inline',
    ]);
    
});
Route::get('admin/proposals/download/{filename}', function ($filename) {
    // Check if the file exists in the storage
    if (!Storage::disk('public')->exists('proposals/'.$filename)) {
        abort(404);
    }
    
    // Get the file path and content type
    $filePath = storage_path('app/' . 'public/proposals/'.$filename);
    $contentType = Storage::disk('public')->mimeType('proposals/'.$filename);


    // Return the file for download
    return response()->download($filePath, $filename, ['Content-Type' => $contentType]);
});
Route::get('admin/proposals/{id}/chat', 'Admin\ProposalController@chat')->name('admin.proposal.chat')->middleware('authentic');
Route::post('admin/proposals/{id}/update-rating', 'Admin\ProposalController@updateRating')->name('admin.proposal.updateRating')->middleware('authentic');
Route::post('admin/proposal/send-access-request', 'Admin\ProposalController@sendAccessRequest')->name('admin.proposal.request')->middleware('authentic');
Route::get('/admin/proposal/search', 'Admin\ProposalController@search')->name('admin.proposal.search')->middleware('authentic');
Route::post('admin/profile/update', 'Admin\UsersController@profileUpdate')->name('admin.profile.update')->middleware('authentic');
Route::get('admin/profile', 'Admin\UsersController@profile')->name('admin.profile')->middleware('authentic');


Route::get('admin/email', 'Admin\EmailController@showForm')->name('email')->middleware('authentic');
Route::post('admin/send-email', 'Admin\EmailController@sendEmail')->name('sendEmail')->middleware('authentic');

Route::post('admin/update-setting', 'Admin\SettingsController@updateSetting')->name('update-settings')->middleware('authentic');
Route::get('admin/board-members', 'Admin\AdvisoryBoardMembersController@index')->name('admin.board-members')->middleware('authentic');
Route::post('admin/update-user', 'Admin\AdvisoryBoardMembersController@updateUser')->name('admin.board-members.update')->middleware('authentic');

// USER ROUTES 
Route::get('user/dashboard', 'UserController@profile')->name('user.dashboard')->middleware('authentic');
Route::post('user/profile/update', 'UserController@updateProfile')->name('user.profile.update')->middleware('authentic');
Route::post('user/proposal/submit', 'ProposalController@proposalSubmit')->name('user.proposal.submit')->middleware('authentic');
Route::get('user/proposal/{id}/chat', 'ProposalController@propChat')->name('user.proposal.chat')->middleware('authentic');
Route::get('user/proposal/{id}/edit', 'ProposalController@editProposal')->name('user.proposal.edit')->middleware('authentic');
Route::post('user/proposal/update', 'ProposalController@proposalUpdate')->name('user.proposal.update')->middleware('authentic');
Route::get('user/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
Route::get('user/proposal/{id}/view', 'ProposalController@view')->name('user.proposal.view')->middleware('authentic');
Route::post('/user/profile/update-password', 'UserController@updatePassword')->name('user.profile.updatePassword')->middleware('authentic');

Route::get('/auth/{provider}', 'AuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'AuthController@handleProviderCallback');

// Common ROUTES
Route::get('proposals/preview/{path}', function ($filename) {

    // Check if the file exists in the storage
    if (!Storage::disk('public')->exists('proposals/'.$filename)) {
        abort(404);
    }
    
    // Get the file path and content type
    $filePath = storage_path('app/' . 'public/proposals/'.$filename);
    $contentType = Storage::disk('public')->mimeType('proposals/'.$filename);
   
    // Return the file for preview
    return response()->file($filePath, [
        'Content-Type' => $contentType,
        'Content-Disposition' => 'inline',
    ]);
    
});
Route::get('/countries/{id}/phone-code', 'Auth\RegisterController@getPhoneCode');
Route::get('/subcategories/{category_id}', 'ProposalController@getSubcategories');
Route::get('/country/{id}/phone-code', 'HomeController@getPhoneCode');
Route::post('/send-message', 'Admin\ProposalController@sendMessage')->middleware('authentic');
Route::get('/messages', 'Admin\ProposalController@getNewMessages')->middleware('authentic');
Route::delete('/proposals/{proposal}', 'ProposalController@destroy')->name('proposals.destroy')->middleware('authentic');
Route::get('/about-us', 'HomeController@aboutUs');
Route::get('/faq', 'HomeController@faq');
Route::get('/contact-us', 'HomeController@contactUs');
Route::get('/get-local-government-areas', 'ProposalController@getLocalGovernmentAreas');
Route::get('/advisory-board-members', 'AdvisoryBoardMembersController@index')->name('board-member');
Route::get('/advisory-board-application', 'AdvisoryBoardMembersController@advisoryBoardApplication')->name('join-board');
Route::get('/join-advisory-board-application', 'AdvisoryBoardMembersController@joinBoardForm')->name('join-board-form');
Route::post('/join-advisory-board-application-submit', 'AdvisoryBoardMembersController@joinBoardFormSubmit')->name('join-board-submit');
Route::get('activity-summary', 'HomeController@activitySummary')->name('user.activitySummary');

