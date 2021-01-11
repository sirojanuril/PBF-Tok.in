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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HalamanController@landingpage');
Route::get('/home', 'HomeController@halaman_utama')->name('home');

Route::group(['middleware' => ['auth', 'LevelUser:admin']], function(){
	Route::get('/barang', 'BarangController@home')->name('barang');
	Route::post('/barang/tambah', 'BarangController@create');
	Route::get('/barang/edit/{id}', 'BarangController@edit');
	Route::post('/barang/edit/{id}', 'BarangController@update');
	Route::get('/barang/hapus/{id}', 'BarangController@delete');
	Route::get('/pesanan', 'TransaksiController@pesanan_pembeli')->name('pesanan');
	Route::post('/konfirmasi/{id}', 'TransaksiController@verifikasi');
	Route::get('/penjualan', 'PenjualanController@data_jualan');
	Route::get('/cetak-data-pertanggal/{tanggal_awal}/{tanggal_akhir}', 'PenjualanController@cetak_laporan')->name('cetak-data-pertanggal');
});

Route::get('/akun', 'AkunController@tampilan_akun');
Route::post('/akun', 'AkunController@update_akun');

Route::get('/pesan/{id}', 'PesanController@pesanan_barang');
Route::post('/pesan/{id}', 'PesanController@pemesanan');
Route::get('/beli', 'PesanController@pembelian');
Route::delete('/hapus/{id}', 'PesanController@delete');
Route::get('/bayar', 'PesanController@pembayaran');

Route::get('/riwayat', 'TransaksiController@riwayat_pembelian');
Route::get('/riwayat/{id}', 'TransaksiController@info');
Route::get('/detail-pembeli/{id}', 'TransaksiController@info_pembeli');
Route::get('/pembayaran/{id}', 'TransaksiController@bayar_pesanan');
Route::post('/bukti/{id}', 'TransaksiController@upload_bukti');


