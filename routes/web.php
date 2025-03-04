<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DisposisiController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SuratKeluarController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\KategoriSuratController;
use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;  
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriRekeningController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\IncomingLetterController;
use App\Http\Controllers\Admin\JamReservasiController;
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
    // Rute untuk mengunduh PDF  
    Route::get('/pemasukan/pdf', [PemasukanController::class, 'generatePDF'])->name('pemasukan.pdf');
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('/pengeluaran-pdf', [PengeluaranController::class, 'pdf'])->name('pengeluaran-pdf');  
    Route::resource('donasi', DonasiController::class);
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    Route::prefix('disposisi')->group(function () {
        Route::get('/{surat_id}', [DisposisiController::class, 'index'])->name('disposisi.index'); // Menampilkan daftar disposisi dari surat tertentu
        Route::get('/{surat_id}/create', [DisposisiController::class, 'create'])->name('disposisi.create'); // Form tambah disposisi
        Route::get('/{id}/edit', [DisposisiController::class, 'edit'])->name('disposisi.edit'); // Form edit disposisi
        Route::post('/{surat_id}', [DisposisiController::class, 'store'])->name('disposisi.store'); // Simpan disposisi baru
        Route::put('/{id}', [DisposisiController::class, 'update'])->name('disposisi.update'); // Update disposisi
        Route::delete('/{id}', [DisposisiController::class, 'destroy'])->name('disposisi.destroy'); // Hapus disposisi
    });

    Route::resource('kategori-surat', KategoriSuratController::class);
    Route::resource('jam-reservasi', JamReservasiController::class);
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/pdf', [AgendaController::class, 'pdf'])->name('agenda.df');
});

    Route::get('/superadmin', [DashboardController::class, 'index'])->middleware('userAcces:1');
    Route::get('/ketua', [DashboardController::class, 'index'])->middleware('userAcces:2');
    Route::get('/bendahara1', [DashboardController::class, 'index'])->middleware('userAcces:3');
    Route::get('/bendahara2', [DashboardController::class, 'index'])->middleware('userAcces:4');
    Route::get('/pengunjung', [DashboardController::class, 'index'])->middleware('userAcces:5');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/donasi-pdf', [DonasiController::class, 'pdf'])->name('donasi-pdf'); 
    Route::resource('kategoris', KategoriController::class); 
    
Route::resource('kategori-rekening', KategoriRekeningController::class);
Route::resource('transaksi', TransaksiController::class);

// Laporan - Menggunakan method POST untuk filter
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/jumlah-pengunjung', [LaporanController::class, 'jumlahPengunjung'])->name('jumlah-pengunjung.index');
Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
Auth::routes();
Route::resource('surat-masuk', SuratMasukController::class);
Route::resource('incoming', IncomingLetterController::class);

// Route::get('/pemasukan-pdf', function () {
//     $pemasukan = App\Models\Pemasukan::all();
//     return view('pages.keuangan.pemasukan.pdf', compact('pemasukan'));
// })->name('pemasukan-pdf');

  
Route::resource('donation', DonationController::class);  

Route::resource('reservasi', ReservasiController::class)->only('index', 'create', 'store');
Route::get('/reservasi/{id}/approve', [ReservasiController::class, 'approve'])->name('reservasi.approve');
Route::get('/reservasi/{id}/reject', [ReservasiController::class, 'reject'])->name('reservasi.reject');
Route::get('/reservasi/{id}/cancel', [ReservasiController::class, 'cancel'])->name('reservasi.cancel');
Route::get('/cek-reservasi', [ReservasiController::class, 'cekReservasi'])->name('reservasi.cek');



