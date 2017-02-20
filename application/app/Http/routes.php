<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

///////////////////////////////////////// BACKEND ROUTE /////////////////////////////////////////
Route::get('/admin', function () {
  return view('backend/pages/login');
})->name('login.pages');

Route::get('backend/dashboard', 'DashboardController@index')->name('dashboard');


// =======================================================================================================================
//Management Akun
Route::get('admin/kelola-akun', 'AkunController@index')->name('akun.kelola');
Route::post('admin/store-akun', 'AkunController@store')->name('akun.store');
Route::post('admin/update-akun', 'AkunController@update')->name('akun.update');
Route::get('admin/delete-akun/{id}', 'AkunController@delete')->name('akun.delete');
Route::get('admin/bind-akun/{id}', 'AkunController@bind')->name('akun.bind');
Route::get('email-activation/{code}', 'AkunController@emailActivation');
Route::post('set-password', 'AkunController@setPassword')->name('setpassword');
Route::get('logout-process', 'AkunController@logoutProcess')->name('logout');
Route::post('login-process', 'AkunController@loginProcess')->name('login');
// =======================================================================================================================


// =======================================================================================================================
//Features
Route::get('admin/kelola-features', 'FeaturesController@index')->name('features.index');
Route::post('admin/store-features', 'FeaturesController@store')->name('features.store');
Route::get('admin/delete-features/{id}', 'FeaturesController@delete')->name('features.delete');
Route::post('admin/edit-features', 'FeaturesController@edit')->name('features.edit');
Route::get('admin/publish-features/{id}', 'FeaturesController@publish')->name('features.publish');
Route::get('admin/bind-features/{id}', 'FeaturesController@bind')->name('features.bind');
// =======================================================================================================================


// =======================================================================================================================
//Profile
Route::get('admin/kelola-profile', 'UserProfileController@index')->name('profile.index');
Route::post('admin/edit-profile', 'UserProfileController@edit')->name('edit.profile.edit');
Route::get('admin/berita-user/{id}', 'UserProfileController@berita')->name('berita.user');
Route::post('admin/change-password', 'UserProfileController@changePassword')->name('change.password.user');
// =======================================================================================================================

////////////////////////////////////// END OF BACKEND ROUTE //////////////////////////////////////


///////////////////////////////////////// FRONTEND ROUTE /////////////////////////////////////////
