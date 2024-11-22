<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel jika berbeda dari default ("users")
    protected $table = 'users';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Kolom yang disembunyikan saat objek dikonversi ke array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tipe kolom tertentu, misalnya "email_verified_at" adalah tipe datetime
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Setel password pengguna agar selalu di-hash saat disimpan.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
