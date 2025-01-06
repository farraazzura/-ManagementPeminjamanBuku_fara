@extends('layouts.app')

@section('content')
<h1>Peminjaman Buku</h1>
<form action="/peminjaman" method="POST">
    @csrf
    <label for="id_buku">Pilih Buku:</label>
    <select name="id_buku" required>
        @foreach($bukus as $buku)
        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
        @endforeach
    </select>
    <label for="nama_peminjam">Nama Peminjam:</label>
    <input type="text" name="nama_peminjam" required>
    <button type="submit">Pinjam</button>
</form>
@endsection