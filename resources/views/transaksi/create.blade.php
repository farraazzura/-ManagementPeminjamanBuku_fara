<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
</head>
<body>
    <h1>Peminjaman Buku</h1>
    <form action="/peminjaman" method="POST">
        @csrf
        <label for="id_buku">Pilih Buku:</label>
        <select name="id_buku" required>
            @foreach($bukus as $buku)
            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
            @endforeach
        </select>
        <br>
        
        <label for="nama_peminjam">Nama Peminjam:</label>
        <input type="text" name="nama_peminjam" required>
        <br>
        
        <button type="submit">Pinjam</button>
    </form>
</body>
</html>