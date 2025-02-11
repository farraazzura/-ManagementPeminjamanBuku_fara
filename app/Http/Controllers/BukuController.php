<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $bukus = Buku::when($search, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                            ->orWhere('pengarang', 'like', '%' . $search . '%')
                            ->orWhere('penerbit', 'like', '%' . $search . '%');
        })->get();

        \Log::info($bukus);

        return view('buku.index', compact('bukus'));
    }

    /**
     * Menampilkan form tambah buku.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Menyimpan buku baru ke database.
     */
    public function store(Request $request)
    { 

        // Validasi input
        $validatedData = $request->validate([
            'judul'       => 'required|string|max:255',
            'pengarang'   => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'tahun_terbit'=> 'required|numeric|min:1000|max:' . date('Y'),
            'isbn'        => 'required|string|max:50|unique:bukus,isbn',
            'lokasi_rak'  => 'required|string|max:50',
            'status'      => 'required|in:tersedia,dipinjam',
        ]);

         // Simpan ke database
        Buku::create($validatedData);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }  

    /**
     * Menampilkan halaman edit buku.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Mengupdate data buku.
     */
    public function update(Request $request, $id)
    {
        // Validasi input; perhatikan aturan unik untuk isbn, kecuali data yang sedang diedit
        $request->validate([
            'judul'       => 'required|string|max:255',
            'pengarang'   => 'required|string|max:255',
            'penerbit'    => 'required|string|max:255',
            'tahun_terbit'=> 'required|numeric|min:1000|max:' . date('Y'),
            'isbn'        => 'nullable|string|max:50|unique:bukus,isbn,' . $id,
            'lokasi_rak'  => 'required|string|max:50',
            'status'      => 'required|in:tersedia,dipinjam',
        ]);

        // Cari data buku yang akan diupdate
        $buku = Buku::findOrFail($id);

        // Update data buku
        $buku->update($request->only([
            'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'isbn', 'lokasi_rak', 'status'
        ]));

        \Log::info('Updated buku:', $buku->toArray());

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku.
     */
    public function destroy($id)
    { 
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function print($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        $pdf = Pdf::loadView('buku.print', compact('buku'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('detail_buku.pdf');
    }

    /**
     * Middleware untuk memastikan hanya pengguna yang telah login bisa mengakses fitur ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
