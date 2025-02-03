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
            })
            ->get();

         // Retrieve all books from the database
        $bukus = Buku::all();

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'nullable|string|max:50',
            'lokasi_rak' => 'required|string|max:50',
        ]);

        Buku::create($request->all());
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit buku.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        if (!$buku) {
            // Jika tidak ditemukan, arahkan kembali dengan pesan error
            return redirect()->route('bukus.index')->with('error', 'Buku tidak ditemukan');
        }
        
        return view('buku.edit', compact('buku'));
    }

    /**
     * Mengupdate data buku.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'nullable|string|max:50',
            'lokasi_rak' => 'required|string|max:50',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
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

    /**
     * Cetak daftar buku dalam format PDF.
     */
    public function print()
    {
        $bukus = Buku::all();
        $pdf = Pdf::loadView('buku.print', compact('bukus'))->setPaper('a4', 'portrait');
        return $pdf->download('daftar_buku.pdf');
    }

    /**
     * Middleware untuk memastikan hanya pengguna yang telah login bisa mengakses fitur ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
