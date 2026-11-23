<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\TarifParkirController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LogAktivitasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ADMIN
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // PETUGAS
    Route::get('/petugas', [PetugasDashboardController::class, 'index'])
        ->name('petugas.dashboard');

    // OWNER
    Route::get('/owner', [OwnerDashboardController::class, 'index'])
        ->name('owner.dashboard');

    Route::get('/kendaraan', [KendaraanController::class, 'index'])
    ->name('admin.kendaraan.index');    
    Route::get('/transaksi', [TransaksiController::class, 'index'])
    ->name('admin.transaksi.index');    
    Route::get('/area-parkir', [AreaParkirController::class, 'index'])
    ->name('admin.area-parkir.index');    
    Route::get('/tarif-parkir', [TarifParkirController::class, 'index'])
    ->name('admin.tarif-parkir.index');    

    Route::get('/user', [UserController::class, 'index'])
    ->name('admin.user.index');
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
    ->name('admin.log-aktivitas.index');

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});
