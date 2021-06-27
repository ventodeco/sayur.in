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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

// dashboard resep
Route::get('/dashboard/resep', 'DashboardController@indexResep')->name('dashboard.resep');
Route::get('/dashboard/resep/create', 'ResepController@create')->name('create-resep');
Route::get('/dashboard/resep/{resep}/edit', 'ResepController@edit')->name('edit-resep');
Route::get('/dashboard/resep/{resep}/delete', 'ResepController@delete')->name('delete-resep');
Route::post('/dashboard/resep/form-submit', 'ResepController@formSubmit')->name('form-submit-resep');

// dashboard kota
Route::get('/dashboard/kota', 'DashboardController@indexKota')->name('dashboard.kota');
Route::get('/dashboard/kota/create', 'KotaController@create')->name('create-kota');
Route::get('/dashboard/kota/{kota}/edit', 'KotaController@edit')->name('edit-kota');
Route::get('/dashboard/kota/{kota}/delete', 'KotaController@delete')->name('delete-kota');
Route::post('/dashboard/kota/form-submit', 'KotaController@formSubmit')->name('form-submit-kota');

// dashboard pesanan
Route::get('/dashboard/pesanan', 'DashboardController@indexPesanan')->name('dashboard.pesanan');
Route::get('/dashboard/pesanan/{pesanan}/edit', 'OrderController@edit')->name('edit-pesanan');
Route::get('/dashboard/pesanan/{pesanan}/detail', 'OrderController@detail')->name('detail-pesanan-admin');
Route::post('/dashboard/pesanan/form-submit', 'OrderController@formSubmit')->name('form-submit-pesanan');

// resep
Route::get('/cari-resep', 'ResepController@index')->name('cari-resep');
Route::get('/resep/{resep}', 'ResepController@getDetail')->name('resep');
Route::get('/resep/{resep}/fill-keranjang', 'ResepController@fillKeranjang')->name('fill-keranjang');

// keranjang
Route::get('/keranjang', 'KeranjangMapController@show')->name('show-keranjang');
Route::get('/delete-keranjang/{resep}', 'KeranjangMapController@delete')->name('delete-keranjang');
Route::get('/checkout', 'KeranjangMapController@checkout')->name('checkout');
Route::post('/change-value', 'KeranjangMapController@changeValue')->name('change-value');
Route::post('/create-order', 'OrderController@createOrder')->name('create-order');

// pesanan
Route::get('/pesanan', 'OrderController@pesanan')->name('pesanan');
Route::get('/pesanan/{order}', 'OrderController@detailPesanan')->name('detail-pesanan');
Route::get('/bayar/{order}', 'BillingController@bayar')->name('bayar');
Route::post('/bayar', 'BillingController@bayarSubmit')->name('bayar-submit');


