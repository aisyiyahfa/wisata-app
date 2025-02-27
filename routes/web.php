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
use App\Http\Controllers\Admin\KategoriSuratController;
use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Auth;
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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pemasukan', PemasukanController::class);
    // Rute untuk mengunduh PDF  
    Route::get('/pemasukan/pdf', [PemasukanController::class, 'generatePDF'])->name('pemasukan.pdf');
    Route::resource('pengeluaran', PengeluaranController::class);
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
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/pdf', [AgendaController::class, 'pdf'])->name('agenda.df');
});

Auth::routes();
