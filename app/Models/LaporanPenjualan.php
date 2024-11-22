<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPenjualan extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'laporan_penjualans';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_pembeli',
        'size',
        'nama_barang',
        'QTY',
        'harga_beli',
        'harga_penjualan',
        'total_penjualan',
        'untung_kg',
        'total_keuntungan',
    ];

    /**
     * Menambah stok barang dengan jumlah tertentu.
     *
     * @param int $amount
     * @return bool
     */
    public function increaseStock($amount)
    {
        $this->quantity += $amount;
        return $this->save();
    }

    public function stockBarang()
    {
        return $this->belongsTo(StokBarang::class);
    }

    /**
     * Mengurangi stok barang dengan jumlah tertentu.
     *
     * @param int $amount
     * @return bool
     */
    public function decreaseStock($amount)
    {
        if ($this->quantity < $amount) {
            return false; // Jumlah stok tidak mencukupi
        }

        $this->quantity -= $amount;
        return $this->save();
    }
}
