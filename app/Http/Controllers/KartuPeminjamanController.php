<?php

namespace App\Http\Controllers;

use App\Models\Kartu_Peminjaman;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class KartuPeminjamanController extends Controller
{
    // Tampilkan daftar kartu peminjaman
    public function index()
    {
        $kartu_peminjaman = Kartu_Peminjaman::with('transaksi.buku')->get();
        return view('kartu_peminjaman.index', compact('kartuPeminjaman'));
    }

    // Cetak kartu peminjaman
    public function print($id)
    {
        $kartuPeminjaman = Kartu_Peminjaman::with('transaksi.buku')->findOrFail($id);
        $pdf = \PDF::loadView('kartu_peminjaman.print', compact('kartuPeminjaman'));
        return $pdf->stream('kartu_peminjaman.pdf');
    }

    // Buat kartu peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transactions,id',
        ]);

        $transaksi = Transaksi::find($request->id_transaksi);

        // Buat kartu peminjaman
        Kartu_Peminjaman::create([
            'id_transaksi' => $transaksi->id,
            'nomor_kartu' => 'LC-' . uniqid(),
            'nama_peminjam' => $transaksi->nama_peminjam,
            'judul_buku' => $transaksi->buku->judul,
            'tanggal_pinjam' => $transaksi->tanggal_pinjam,
            'tanggal_kembali' => $transaksi->tanggal_kembali,
        ]);

        return redirect('/kartu-peminjaman')->with('success', 'Kartu peminjaman berhasil dibuat!');
    }
}
