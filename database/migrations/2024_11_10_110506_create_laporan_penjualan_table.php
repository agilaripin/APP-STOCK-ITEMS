<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_pembeli');
            $table->float('size');
            $table->string('nama_barang');
            $table->float('QTY');
            $table->double('harga_beli');
            $table->double('harga_penjualan');
            $table->double('total_penjualan');
            $table->double('untung_kg');
            $table->double('total_keuntungan');

            $table->foreign('nama_barang')->references('nama_ikan')->on('stock_items')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualans');
    }
};
