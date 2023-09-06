<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DepartemenController;

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
});
