<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaHarian extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'belanja_harians';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_barang',
        'quantity',
        'harga_beli',
        'jumalah',
    ];

    // Relasi dengan StokBarang
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'nama_barang', 'nama_ikan');
    }

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
