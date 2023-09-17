<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\JamKerjaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MesinFingerprintController;
use App\Http\Controllers\Admin\AbsensiController;



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

// Users Routes
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::middleware(['auth', 'user-access:1'])->group(function () {
  
        //Route::resource('/departemen', DepartemenController::class);
});

// Manager Routes

// Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
//     Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
// });  

// Super Admin Routes

Route::middleware(['auth', 'user-access:2'])->group(function () {
  
    Route::resource('/departemen', DepartemenController::class);
    Route::resource('/pengguna', UserController::class);
    Route::resource('/jam-kerja', JamKerjaController::class);
    Route::get('/mesin-fingerprint/sinkronisasi', [MesinFingerprintController::class, 'sinkronisasi'])->name('mesin-fingerprint.sinkronisasi');
    Route::resource('/mesin-fingerprint', MesinFingerprintController::class);
    Route::delete('/mesin-fingerprint/deletelog/{id}', [MesinFingerprintController::class, 'destroylog'])->name('mesin-fingerprint.destroylog');
    Route::resource('/absensi', AbsensiController::class);
    Route::get('/absensi/list/{keyword}', [AbsensiController::class, 'getAbsensi'])->name('absensi.list');
    Route::get('/api/absensi', [AbsensiController::class, 'getAbsensiData'])->name('absensi.data');
    Route::get('/api/absensi/user/{user_id}', [AbsensiController::class, 'getAbsensiUser'])->name('absensi.user');
    Route::get('/api/absensi/tgl/{tgl_awal}/{tgl_akhir}', [AbsensiController::class, 'getAbsensiUser'])->name('absensi.tgl');
    Route::get('/api/absensi/usertgl/{user_id}/{tgl_awal}/{tgl_akhir}', [AbsensiController::class, 'getAbsensiAllFilter'])->name('absensi.allFilter');



});
