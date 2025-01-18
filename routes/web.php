<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
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
});

Auth::routes();
