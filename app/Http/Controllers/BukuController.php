<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Tampilkan daftar buku
    public function index()
    {
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus'));
    }

    // Tampilkan form tambah buku
    public function create()
    {
        return view('bukus.create');
    }

    // Simpan buku baru
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
        return redirect('/bukus')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Tampilkan form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('bukus.edit', compact('buku'));
    }

    // Update data buku
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
        return redirect('/bukus')->with('success', 'Buku berhasil diperbarui!');
    }

    // Hapus buku
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect('/bukus')->with('success', 'Buku berhasil dihapus!');
    }
}
