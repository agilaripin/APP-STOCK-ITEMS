<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanOperasionalController;
use App\Http\Controllers\BelanjaHarianController;

// Prefix for API Routes
Route::prefix('api')->group(function () {
    // StokBarang routes
    Route::get('/products', [StokBarangController::class, 'index']);
    Route::post('/product', [StokBarangController::class, 'store']);
    Route::get('/product/{id}', [StokBarangController::class, 'show']);
    Route::put('/product/{id}', [StokBarangController::class, 'update']);
    Route::delete('/product/{id}', [StokBarangController::class, 'destroy']);

    // LaporanPenjualan routes
    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index']);
    Route::post('/laporan-penjualan', [LaporanPenjualanController::class, 'store']);
    Route::get('/laporan-penjualan/{id}', [LaporanPenjualanController::class, 'show']);
    Route::put('/laporan-penjualan/{id}', [LaporanPenjualanController::class, 'update']);
    Route::delete('/laporan-penjualan/{id}', [LaporanPenjualanController::class, 'destroy']);

    // LaporanOperasional routes
    Route::get('/laporan-operasional', [LaporanOperasionalController::class, 'index']);
    Route::post('/laporan-operasional', [LaporanOperasionalController::class, 'store']);
    Route::get('/laporan-operasional/{id}', [LaporanOperasionalController::class, 'show']);
    Route::put('/laporan-operasional/{id}', [LaporanOperasionalController::class, 'update']);
    Route::delete('/laporan-operasional/{id}', [LaporanOperasionalController::class, 'destroy']);

    // BelanjaHarian routes
    Route::get('/belanja-harian', [BelanjaHarianController::class, 'index']);
    Route::post('/belanja-harian', [BelanjaHarianController::class, 'store']);
    Route::get('/belanja-harian/{id}', [BelanjaHarianController::class, 'show']);
    Route::put('/belanja-harian/{id}', [BelanjaHarianController::class, 'update']);
    Route::delete('/belanja-harian/{id}', [BelanjaHarianController::class, 'destroy']);
});
