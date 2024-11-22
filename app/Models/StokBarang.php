<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'stock_items';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'size',
        'nama_ikan',
        'stok_awal',
        'barang_keluar',
        'barang_masuk',
        'stok_akhir',
        'harga_beli',
        'total',
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
