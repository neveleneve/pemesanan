<?php

use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('dashboard');

Route::resource('role', RoleController::class);

Route::delete('user/restore/{meja}', [UserController::class, 'restore'])
    ->name('user.restore');
Route::resource('user', UserController::class);

Route::get('meja/qr-code/{meja}', [MejaController::class, 'qrCode'])->name('meja.qr');
Route::delete('meja/restore/{meja}', [MejaController::class, 'restore'])
    ->name('meja.restore');
Route::resource('meja', MejaController::class);

Route::delete('menu/restore/{menu}', [MenuController::class, 'restore'])
    ->name('menu.restore');
Route::resource('menu', MenuController::class);

Route::resource('pesanan', PesananController::class)
    ->except('create', 'edit', 'destroy');

Route::get('transaksi/report', [TransaksiController::class, 'report'])->name('transaksi.report');
Route::resource('transaksi', TransaksiController::class)
    ->except('create', 'edit', 'destroy');

Route::group(['prefix' => 'report'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('report.index');
    Route::post('/cetak', [ReportController::class, 'cetak'])->name('report.cetak');
    Route::get('/harian', [ReportController::class, 'hari'])->name('report.hari');
    Route::get('/bulanan', [ReportController::class, 'bulan'])->name('report.bulan');
    Route::get('/tahunan', [ReportController::class, 'tahun'])->name('report.tahun');
});

Route::group(['prefix' => 'pesan'], function () {
    Route::post('/', [PemesananController::class, 'pemesanan'])->name('pesan');
    Route::get('{kode}', [PemesananController::class, 'hasilpesan'])->name('pesan.lihat');
    Route::get('{meja}/{token}', [PemesananController::class, 'pesan'])->name('pesan.check');
});
