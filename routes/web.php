<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\UserController;
use App\Models\Absensi;
use App\Models\ProdukTitipan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::resource('/jenis', JenisController::class);
Route::resource('/menu', MenuController::class);
Route::resource('/pelanggan', PelangganController::class);
Route::resource('/kategori', KategoriController::class);
Route::resource('/stok', StokController::class);
Route::resource('/meja', MejaController::class);
Route::resource('/pemesanan', PemesananController::class);
Route::resource('/transaksi', TransaksiController::class);
Route::resource('/karyawan', KaryawanController::class);
Route::resource('/produktitipan', ProdukTitipanController::class);
Route::resource('/absensi', AbsensiController::class);
Route::get('/dashboard', [DataController::class, 'index']);
Route::post('/store-transaction', [TransaksiController::class, 'storeTransaksi'])->name('store.transaksi');
Route::get('nota/{faktur}', [TransaksiController::class,'faktur']);
Route::get('export/menu', [MenuController::class,'exportData'])->name('export-menu');
Route::get('export/jenis', [JenisController::class,'exportData'])->name('export-jenis');
Route::get('export/absensi', [AbsensiController::class,'exportData'])->name('export-absensi');
Route::get('export/meja', [MejaController::class,'exportData'])->name('export-meja');
Route::get('export/stok', [StokController::class,'exportData'])->name('export-stok');
Route::get('export/pelanggan', [PelangganController::class,'exportData'])->name('export-pelanggan');
Route::get('export/kategori', [KategoriController::class,'exportData'])->name('export-kategori');
Route::get('export/karyawan', [KaryawanController::class,'exportData'])->name('export-karyawan');
Route::get('export/produktitipan', [ProdukTitipanController::class,'exportData'])->name('export-produktitipan');
Route::get('generate/absensi', [AbsensiController::class, 'pdfabsensi'])->name('absensi-export');


//yang belum bisa
Route::get('generate/menu', [MenuController::class, 'menupdf'])->name('menu-pdf');

//import yang sudah bisa
Route::post('pelanggan/import', [PelangganController::class,'importData'])->name('import_pelanggan');
Route::post('absensi/import', [AbsensiController::class,'importData'])->name('import-absensi');
Route::post('menu/import', [MenuController::class,'importData'])->name('import_menu');
Route::post('meja/import', [MejaController::class,'importData'])->name('import-meja');
Route::post('jenis/import', [JenisController::class,'importData'])->name('import_jenis');
Route::post('karyawan/import', [KaryawanController::class,'importData'])->name('import_karyawan');
Route::post('stok/import', [StokController::class,'importData'])->name('import_stok');
Route::post('kategori/import', [KategoriController::class,'importData'])->name('import_kategori');
Route::post('produktitipan/import', [ProdukTitipanController::class,'importData'])->name('import_produktitipan');

//pdf yang sudah bisa
Route::get('generate/jenis', [JenisController::class, 'jenispdf'])->name('jenis-pdf');
Route::get('generate/karyawan', [KaryawanController::class, 'karyawanpdf'])->name('karyawan-pdf');
Route::get('generate/meja', [MejaController::class, 'mejapdf'])->name('meja-pdf');
Route::get('generate/stok', [StokController::class, 'stokpdf'])->name('stok-pdf');
Route::get('generate/kategori', [KategoriController::class, 'kategoripdf'])->name('kategori-pdf');
Route::get('generate/pelanggan', [PelangganController::class, 'generatepdf'])->name('aku');
Route::get('generate/produktitipan', [ProdukTitipanController::class, 'produktitipanpdf'])->name('produktitipan-pdf');


Route::get('/contact', [ContactController::class, 'index']);
Route::get('/laporan', [LaporanController::class, 'index']);

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('data_penjualan/{lasCount}', 'HomeController@data_penjualan');
