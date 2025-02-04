<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'kartu__peminjamen';

    protected $fillable = [
        'no_kartu',
        'id_user'
    ];

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_kartu');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
