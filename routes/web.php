<?php

use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes([
    'register' => false
]);

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('dashboard');

Route::delete('meja/restore/{meja}', [MejaController::class, 'restore'])
    ->name('meja.restore');
Route::resource('meja', MejaController::class);

Route::delete('menu/restore/{menu}', [MenuController::class, 'restore'])
    ->name('menu.restore');
Route::resource('menu', MenuController::class);

Route::resource('transaksi', TransaksiController::class)
    ->except('create', 'edit', 'destroy');

Route::group(['prefix' => 'pesan'], function () {
    Route::post('/', [PemesananController::class, 'pemesanan'])->name('pesan');
    Route::get('{kode}', [PemesananController::class, 'hasilpesan'])->name('pesan.lihat');
    Route::get('{meja}/{token}', [PemesananController::class, 'pesan'])->name('pesan.check');
});
