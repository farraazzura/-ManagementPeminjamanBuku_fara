<?php

namespace App\Http\Controllers;

use App\Models\Kartu_Peminjaman;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KartuPeminjamanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'id_user' => 'required|exists:users,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required',
            'nomor_kartu' => 'required|unique:kartu_peminjamen,nomor_kartu',
        ]);

        // Buat data transaksi
        $transaksi = Transaksi::create([
            'id_buku' => $validated['id_buku'],
            'id_user' => $validated['id_user'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => $validated['status'],
        ]);

        // Tambahkan data ke kartu_peminjaman
        KartuPeminjaman::create([
            'id_transaksi' => $transaksi->id,
            'nomor_kartu' => $validated['nomor_kartu'],
            'id_user' => $validated['id_user'],
            'id_buku' => $validated['id_buku'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan!']);
    }

    public function printKartu($idTransaksi)
    {
        $kartu = KartuPeminjaman::where('id_transaksi', $idTransaksi)->with(['user', 'buku', 'transaksi'])->first();
    
        if (!$kartu) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }
    
        $pdf = Pdf::loadView('print-kartu', compact('kartu'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->download('kartu_peminjaman_' . $kartu->id . '.pdf');
    }

    public function printKartu1()
    {
        $kartu = KartuPeminjaman::with(['user', 'buku', 'transaksi'])->get();
    
        $pdf = Pdf::loadView('transaksi.print', compact('kartu'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->download('semua_kartu_peminjaman.pdf');
    }

    public function printUsers()
    {
        $users = User::all();
    
        $pdf = Pdf::loadView('users.print', compact('users'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->download('daftar_users.pdf');
    }

    public function printBooks()
    {
        $books = Buku::all();
    
        $pdf = Pdf::loadView('books.print', compact('books'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->download('daftar_buku.pdf');
    }
}
