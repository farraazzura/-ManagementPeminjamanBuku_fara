<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Form Peminjaman
    public function create()
    {
        $bukus = Buku::where('status', 'tersedia')->get();
        return view('transaksis.create', compact('bukus'));
    }

    // Proses Peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'nama_peminjam' => 'required|string|max:100',
        ]);

        $buku = Buku::find($request->id_buku);
        $buku->update(['status' => 'dipinjam']);

        Transaksi::create([
            'id_buku' => $request->id_buku,
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => now(),
        ]);

        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil!');
    }

    // Form Pengembalian
    public function returnForm()
    {
        $transaksis = Transaksi::where('status', 'dipinjam')->get();
        return view('transaksis.return', compact('transaksis'));
    }

    // Proses Pengembalian
    public function processReturn(Request $request)
    {
        $transaksi = Transaction::find($request->id_transaksi);
        $transaksi->update(['status' => 'dikembalikan', 'tanggal_kembali' => now()]);

        $transaksi->buku->update(['status' => 'tersedia']);

        return redirect('/pengembalian')->with('success', 'Pengembalian berhasil!');
    }

    // Cetak Kartu
    public function printCard($id)
    {
        $transaksi = Transaksi::find($id);
        $pdf = \PDF::loadView('transaksis.card', compact('transaksi'));
        return $pdf->stream('kartu_peminjaman.pdf');
    }
}