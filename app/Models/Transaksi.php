<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['id_kartu', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public function kartu()
    {
        return $this->belongsTo(KartuPeminjaman::class, 'id_kartu')->withDefault();
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    } 

}
