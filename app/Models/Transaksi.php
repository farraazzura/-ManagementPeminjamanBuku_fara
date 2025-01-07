<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['id_buku', 'nama_peminjam', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public function kartuPeminjaman()
    {
        return $this->hasOne(KartuPeminjaman::class, 'id_transaksi');
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
