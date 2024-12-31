<?php

use App\Http\Controllers\F_Auth\AuthController;
use App\Http\Controllers\Konfigurasi\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('f_auth.index');
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ganti dengan nama view dashboard Anda
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::resource('konfigurasi/menu', MenuController::class);
    Route::get('konfigurasi/menu', [MenuController::class, 'index'])->name('konfigurasi.menu.index');
});
