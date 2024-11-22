<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanOperasionalController;
use App\Http\Controllers\BelanjaHarianController;


// Prefix for Web Routes
Route::prefix('web')->group(function () {
    // StokBarang routes
    Route::get('/stok-barang', [StokBarangController::class, 'index']);
    Route::get('/stok-barang/create', [StokBarangController::class, 'create'])->name('stok_barang.create');
    Route::post('/product', [StokBarangController::class, 'store']);

    // LaporanPenjualan routes
    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index']);
    Route::get('/laporan-penjualan/create', [LaporanPenjualanController::class, 'create'])->name('laporan_penjualan.create');
    Route::post('/laporan-penjualan', [LaporanPenjualanController::class, 'store']);

    // LaporanOperasional routes
    Route::get('/laporan-operasional', [LaporanOperasionalController::class, 'index']);
    Route::get('/laporan-operasional/create', [LaporanOperasionalController::class, 'create'])->name('laporan_operasional.create');
    Route::post('/laporan-operasional', [LaporanOperasionalController::class, 'store']);

    // BelanjaHarian routes
    Route::get('/belanja-harian', [BelanjaHarianController::class, 'index']);
    Route::get('/belanja-harian/create', [BelanjaHarianController::class, 'create'])->name('belanja_harian.create');
    Route::post('/belanja-harian', [BelanjaHarianController::class, 'store']);
});
