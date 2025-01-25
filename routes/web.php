<?php

use App\Http\Controllers\F_Auth\AuthController;
use App\Http\Controllers\Konfigurasi\AksesRoleController;
use App\Http\Controllers\Konfigurasi\AksesUserController;
use App\Http\Controllers\Konfigurasi\MenuController;
use App\Http\Controllers\Konfigurasi\PermissionController;
use App\Http\Controllers\Konfigurasi\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home'); // Ganti dengan view landing page Anda
})->name('landing');

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('f_auth.index');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'konfigurasi', 'as' => 'konfigurasi.'], function () {
        Route::put('menu/sort', [MenuController::class, 'sort'])->name('menu.sort');
        Route::resource('menu', MenuController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('akses-role/{role}/role', [AksesRoleController::class, 'getPermissionsByRole']);
        Route::resource('akses-role', AksesRoleController::class)->except(['create', 'store', 'destroy'])->parameters(['akses-role' => 'role']);
        Route::get('akses-user/{user}/user', [AksesUserController::class, 'getPermissionsByUser']);
        Route::resource('akses-user', AksesUserController::class)->except(['create', 'store', 'destroy'])->parameters(['akses-user' => 'user']);
    });
});
