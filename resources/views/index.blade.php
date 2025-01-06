<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Buku</title>
    <style>
        /* Reset some default styles */
        body, h1, table, form {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Page Layout */
        body {
            background-color: #f4f7fc;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .btn-danger:hover {
            background-color: #e53935;
        }

        /* Modal Styles */
        #transactionModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        #modalContent {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #modalContent h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .form-group button {
            width: 100%;
        }

        /* Close Button */
        #closeModal {
            margin-top: 20px;
            background-color: #f44336;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #closeModal:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Peminjaman Buku</h1>

        <!-- Pesan jika ada -->
        @if(session('success'))
            <p style="color: green; text-align: center;">{{ session('success') }}</p>
        @endif

        <!-- Tombol Tambah Transaksi -->
        <button id="addTransactionBtn">Tambah Transaksi</button>

        <!-- Tabel Daftar Transaksi -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->nama_peminjam }}</td>
                        <td>{{ $transaksi->buku->judul }}</td>
                        <td>{{ $transaksi->tanggal_pinjam }}</td>
                        <td>{{ $transaksi->tanggal_kembali ?? 'Belum Kembali' }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>
                            <a href="{{ route('transaksis.show', $transaksi->id) }}">Lihat</a>
                            <a href="{{ route('transaksis.edit', $transaksi->id) }}">Edit</a>
                            <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('transaksis.print', $transaksi->id) }}" target="_blank">Cetak</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal untuk tambah/edit transaksi -->
    <div id="transaksiModal">
        <div id="modalContent">
            <h2>@isset($transaksi) Edit @else Tambah @endisset Transaksi</h2>
            <form action="{{ isset($transaksi) ? route('transaksis.update', $transaksi->id) : route('transaksis.store') }}" method="POST">
                @csrf
                @isset($transaksi)
                    @method('PUT')
                @endisset

                <div class="form-group">
                    <label for="id_buku">Pilih Buku:</label>
                    <select name="id_buku" required>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}" {{ isset($transaksi) && $transaksi->id_buku == $buku->id ? 'selected' : '' }}>
                                {{ $buku->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_peminjam">Nama Peminjam:</label>
                    <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam', $transaksi->nama_peminjam ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $transaksi->tanggal_pinjam ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali:</label>
                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', $transaksi->tanggal_kembali ?? '') }}">
                </div>

                <div class="form-group">
                    <button type="submit">@isset($transaksi) Perbarui @else Tambah @endisset</button>
                </div>
            </form>
            <button id="closeModal">Tutup</button>
        </div>
    </div>

    <script>
        // Menampilkan modal tambah/edit transaksi
        document.getElementById('addTransaksiBtn').onclick = function() {
            document.getElementById('transaksiModal').style.display = 'flex';
        }

        // Menutup modal
        document.getElementById('closeModal').onclick = function() {
            document.getElementById('transaksiModal').style.display = 'none';
        }
    </script>
</body>
</html>