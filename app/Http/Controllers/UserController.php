<?php

namespace App\Http\Controllers;

use App\Models\KartuPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mendapatkan data user, dengan pencarian berdasarkan username
        $kartus = KartuPeminjaman::when($search, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        })->get();

        return view('user.index', compact('kartus'));
    }

    /**
     * Form untuk menambahkan kartu baru.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kartu' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        KartuPeminjaman::create([
            'no_kartu' => $request->no_kartu,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail kartu.
     */
    public function show($id)
    {
        $kartu = KartuPeminjaman::findOrFail($id);
        return view('kartu.show', compact('kartu'));
    }

    /**
     * Form edit user.
     */
    public function edit($id)
    {
        // Menggunakan variabel $user untuk mengambil satu data user
        $kartu = KartuPeminjaman::findOrFail($id);
        return view('user.edit', compact('kartu'));
    }

    /**
     * Update data user.
     */ 
    public function update(Request $request, $id)
        {
            // Validasi input
            $validasi = $request->validate([
                'no_kartu' => "required|string|max:255|unique:kartu__peminjamen,no_kartu,{$id}",
                'nama'     => 'required|string|max:255',
                'alamat'   => 'required|string|max:255',
                'no_hp'    => 'required|string|max:255',
            ]);
    
            // Temukan data berdasarkan ID
            $kartu = KartuPeminjaman::findOrFail($id);
    
            // Update data
            $kartu->update($validasi);
    
            // Redirect dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
        } 
    

    /**
     * Hapus user.
     */
    public function destroy($id)
{
    $kartu = KartuPeminjaman::findOrFail($id);

    if ($kartu->transaksi()->exists()) {
        return redirect()->back()->with('error', 'Peminjam tidak bisa dihapus karena masih memiliki transaksi.');
    }

    $kartu->delete();
    return redirect()->route('kartu.index')->with('success', 'Peminjam berhasil dihapus.');
}

    public function print($id)
    {
        // Ambil data transaksi berdasarkan ID
        $kartu = KartuPeminjaman::with('transaksi')->findOrFail($id);
    
        // Generate PDF
        $pdf = Pdf::loadView('user.print', compact('kartu'))
                  ->setPaper('a4', 'portrait'); // Ukuran kertas A4
    
        // Unduh file PDF
        return $pdf->download('kartu_' . $kartu->id . '.pdf');
    }

    /**
     * Middleware untuk memastikan hanya pengguna yang sudah login bisa mengakses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
