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
Route::post('set-password', 'AkunController@setPassword')->name('setpassword');
Route::get('logout-process', 'AkunController@logoutProcess')->name('logout');
Route::post('login-process', 'AkunController@loginProcess')->name('login');
// =======================================================================================================================


//========================================================================================================================
//Informasi Surat Masukan
Route::get('admin/lihat-surat-masukan', 'SuratMasukanController@lihat')->name('surat.masukan.lihat');
Route::get('admin/tambah-surat-masukan', 'SuratMasukanController@tambah')->name('surat.masukan.tambah');
Route::post('admin/store-surat-masukan', 'SuratMasukanController@store')->name('surat.masukan.store');
Route::get('admin/edit-surat-masukan/{id}', 'SuratMasukanController@edit')->name('surat.masukan.edit');
Route::post('admin/update-surat-masukan', 'SuratMasukanController@update')->name('surat.masukan.update');
Route::get('admin/approved-surat-masukan/{id}', 'SuratMasukanController@flagapproved')->name('surat.masukan.flagapproved');
Route::get('admin/delete-surat-masukan/{id}', 'SuratMasukanController@delete')->name('surat.masukan.delete');
Route::get('admin/preview-surat-masukan/{id}', 'SuratMasukanController@preview')->name('surat.masukan.preview');
// =======================================================================================================================


// =======================================================================================================================
//Management Pegawai
Route::get('admin/lihat-pegawai', 'PegawaiController@lihat')->name('pegawai.lihat');
Route::get('admin/tambah-pegawai', 'PegawaiController@tambah')->name('pegawai.tambah');
Route::post('admin/store-pegawai', 'PegawaiController@store')->name('pegawai.store');
Route::get('admin/edit-pegawai/{id}', 'PegawaiController@edit')->name('pegawai.edit');
Route::post('admin/update-pegawai', 'PegawaiController@update')->name('pegawai.update');
Route::get('admin/delete-pegawai/{id}', 'PegawaiController@delete')->name('pegawai.delete');
// =======================================================================================================================


// =======================================================================================================================
//Jabatan
Route::get('admin/kelola-jabatan', 'JabatanController@index')->name('jabatan.index');
Route::post('admin/store-jabatan', 'JabatanController@store')->name('jabatan.store');
Route::get('admin/delete-jabatan/{id}', 'JabatanController@delete')->name('jabatan.delete');
Route::post('admin/edit-jabatan', 'JabatanController@edit')->name('jabatan.edit');
Route::get('admin/bind-jabatan/{id}', 'JabatanController@bind')->name('jabatan.bind');
// =======================================================================================================================

// =======================================================================================================================
//SKPD
Route::get('admin/kelola-skpd', 'SkpdController@index')->name('skpd.index');
Route::post('admin/store-skpd', 'SkpdController@store')->name('skpd.store');
Route::get('admin/delete-skpd/{id}', 'SkpdController@delete')->name('skpd.delete');
Route::post('admin/edit-skpd', 'SkpdController@edit')->name('skpd.edit');
Route::get('admin/bind-skpd/{id}', 'SkpdController@bind')->name('skpd.bind');
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
