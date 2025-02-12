<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\User;
use App\Models\KartuPeminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Repositories\KartuPeminjamanRepository;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi dengan opsi pencarian.
     */
    public function index(Request $request)
{
    $search = $request->input('search'); // Ambil input pencarian dari form

    // Query untuk mendapatkan data transaksi dengan pencarian
    $transaksis = Transaksi::with(['buku', 'kartu']) // Pastikan ada relasi 'user'
        ->when($search, function ($query, $search) {
            return $query->whereHas('buku', function ($query) use ($search) {
                // Cari berdasarkan judul buku
                $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orWhereHas('kartu', function ($query) use ($search) {
                // Cari berdasarkan nama peminjam di tabel kartu__peminjamen
                $query->where('nama', 'like', '%' . $search . '%');
            });
        })
        ->get();

    return view('transaksi.index', compact('transaksis'));
}


    /**
     * Buat Transaksi
     */
    public function create()
    {
        $bukus = Buku::all(); // Ambil semua buku untuk dropdown
        $kartu = KartuPeminjaman::all();

        return view('transaksi.create', compact('bukus', 'kartu'));
    }

    /**
     * Simpan transaksi baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_buku' => 'required|exists:bukus,id',
        'id_kartu' => 'required|exists:kartu__peminjamen,id', 
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
    ]);

    Transaksi::create([
        'id_buku' => $request->id_buku,
        'id_kartu' => $request->id_kartu,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'dipinjam', // Default status saat peminjaman baru dibuat
    ]);

    return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan.');
}


    /**
     * Tampilkan detail transaksi.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('buku')->findOrFail($id); // Cari transaksi beserta relasi buku
        return view('transaksis.show', compact('transaksi'));
    }

    /**
     * Edit transaksi.
     */
    public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $bukus = Buku::all();
    $kartus = KartuPeminjaman::all(); // Ambil data kartu peminjaman

    return view('transaksi.edit', compact('transaksi', 'bukus', 'kartus'));
}


    /**
    * Update transaksi.
    */
    
    public function update(Request $request, $id)
{
    $request->validate([
        'id_buku' => 'required|exists:bukus,id',
        'id_kartu' => 'required|exists:kartu__peminjamen,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'nullable|date',
        'status' => 'required|in:dipinjam,dikembalikan',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $transaksi->update([
        'id_buku' => $request->id_buku,
        'id_kartu' => $request->id_kartu,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => $request->status,
    ]);

    return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui.');
}


    /**
     * Hapus transaksi.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function pinjamBuku($bukuId, $userId)
    {
        $buku = Buku::findOrFail($bukuId);

        if ($buku->status === 'dipinjam') {
        return response()->json(['message' => 'Buku sedang dipinjam'], 400);
    }

    // Buat transaksi peminjaman
    Transaksi::create([
        'buku_id' => $bukuId,
        'user_id' => $userId, 
    ]);

    // Ubah status buku
    $buku->update(['status' => 'dipinjam']);

    return response()->json(['message' => 'Buku berhasil dipinjam']);
    }

    public function kembalikanBuku($bukuId)
{
    $buku = Buku::findOrFail($bukuId);

    if ($buku->status === 'tersedia') {
        return response()->json(['message' => 'Buku sudah tersedia'], 400);
    }

    // Update status transaksi terakhir menjadi selesai
    $transaksi = Transaksi::where('buku_id', $bukuId)
        ->where('status_transaksi', 'dipinjam')
        ->latest()
        ->first();

    if ($transaksi) {
        $transaksi->update(['status_transaksi' => 'dikembalikan']);
    }

    // Ubah status buku
    $buku->update(['status' => 'tersedia']);

    return response()->json(['message' => 'Buku berhasil dikembalikan']);
    }

    /**
     * Cetak detail transaksi.
     */

    public function print($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaksi = Transaksi::with('buku')->findOrFail($id);
    
        // Generate PDF
        $pdf = Pdf::loadView('transaksi.print', compact('transaksi'))
                  ->setPaper('a4', 'portrait'); // Ukuran kertas A4
    
        // Unduh file PDF
        return $pdf->download('transaksi_' . $transaksi->id . '.pdf');
    }

    /**
     * Hanya bisa diakses oleh yang sudah Login
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
}