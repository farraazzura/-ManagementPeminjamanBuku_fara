<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buku',
        'nama_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
