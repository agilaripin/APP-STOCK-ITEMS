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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('size')->default(0);
            $table->string('nama_ikan');
            $table->integer('stok_awal');
            $table->integer('barang_keluar');
            $table->integer('barang_masuk');
            $table->integer('stok_akhir');
            $table->integer('harga_beli');
            $table->integer('total');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
