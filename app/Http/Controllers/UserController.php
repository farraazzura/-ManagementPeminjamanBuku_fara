<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::when($search, function ($query, $search) {
                return $query->where('username', 'like', '%' . $search . '%');
            })
            ->get();

        return view('user.index', compact('users'));
    }

    /**
     * Form untuk menambahkan user baru.
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
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.index', compact('user'));
    }

    /**
     * Form edit user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);
        
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Cetak detail user dalam bentuk PDF.
     */
    public function print($id)
    {
        $user = User::findOrFail($id);
        $pdf = Pdf::loadView('user.print', compact('user'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('user_' . $user->id . '.pdf');
    }

    /**
     * Middleware untuk memastikan hanya pengguna yang sudah login bisa mengakses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
