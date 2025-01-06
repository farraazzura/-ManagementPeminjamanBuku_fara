@extends('layouts.app')

@section('content')
<h1>Pengembalian Buku</h1>
<form action="/pengembalian" method="POST">
    @csrf
    <label for="id_transaksi">Pilih Transaksi:</label>
    <select name="id_transaksi" required>
        @foreach($transaksis as $transaksi)
        <option value="{{ $transaksi->id }}">{{ $transaksi->buku->judul }} - {{ $transaksi->nama_peminjam }}</option>
        @endforeach
    </select>
    <button type="submit">Kembalikan</button>
</form>
@endsection