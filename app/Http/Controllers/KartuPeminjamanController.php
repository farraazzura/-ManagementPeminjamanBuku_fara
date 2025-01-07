<?php

namespace App\Http\Controllers;

use App\Models\Kartu_Peminjaman;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuPeminjamanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_buku' => 'required',
            'nama_peminjam' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required',
            'nomor_kartu' => 'required',
            'judul_buku' => 'required',
        ]);

        // Buat data transaksi
        $transaksi = Transaksi::create([
            'id_buku' => $validated['id_buku'],
            'nama_peminjam' => $validated['nama_peminjam'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => $validated['status'],
        ]);

        // Tambahkan data ke kartu_peminjamen
        KartuPeminjaman::create([
            'id_transaksi' => $transaksi->id,
            'nomor_kartu' => $validated['nomor_kartu'],
            'nama_peminjam' => $validated['nama_peminjam'],
            'judul_buku' => $validated['judul_buku'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan!']);

    }


    public function printKartu($idTransaksi)
    {
        $kartu = KartuPeminjaman::where('id_transaksi', $idTransaksi)->first();
    
        if (!$kartu) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }
    
        return view('print-kartu', compact('kartu'));
    }
}    