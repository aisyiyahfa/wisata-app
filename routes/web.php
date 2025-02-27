<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;  
use App\Http\Controllers\Auth\RegisterController;  
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriRekeningController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\IncomingLetterController;
use App\Http\Controllers\Admin\ReservasiController;
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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pemasukan', PemasukanController::class);
    // // Rute untuk mengunduh PDF  
    Route::get('/pemasukan-pdf', [PemasukanController::class, 'pdf'])->name('pemasukan-pdf');  
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('/pengeluaran-pdf', [PengeluaranController::class, 'pdf'])->name('pengeluaran-pdf');  
    Route::resource('donasi', DonasiController::class);

    Route::get('/superadmin', [AdminController::class, 'superAdmin'])->middleware('userAcces:1');
    Route::get('/ketua', [AdminController::class, 'ketua'])->middleware('userAcces:2');
    Route::get('/bendahara1', [AdminController::class, 'bendahara1'])->middleware('userAcces:3');
    Route::get('/bendahara2', [AdminController::class, 'bendahara2'])->middleware('userAcces:4');
    Route::get('/pengunjung', [AdminController::class, 'pengunjung'])->middleware('userAcces:5');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/donasi-pdf', [DonasiController::class, 'pdf'])->name('donasi-pdf'); 
    Route::resource('kategoris', KategoriController::class); 
    
Route::resource('kategori-rekening', KategoriRekeningController::class);
Route::resource('transaksi', TransaksiController::class);
});
// Laporan - Menggunakan method POST untuk filter
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
Auth::routes();
Route::resource('surat-masuk', SuratMasukController::class);
Route::resource('incoming', IncomingLetterController::class);

// Route::get('/pemasukan-pdf', function () {
//     $pemasukan = App\Models\Pemasukan::all();
//     return view('pages.keuangan.pemasukan.pdf', compact('pemasukan'));
// })->name('pemasukan-pdf');

  
Route::resource('donation', DonationController::class);  

Route::resource('reservasi', ReservasiController::class);


