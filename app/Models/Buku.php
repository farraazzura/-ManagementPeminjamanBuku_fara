<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'lokasi_rak',
        'status',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_buku');
    }
}
