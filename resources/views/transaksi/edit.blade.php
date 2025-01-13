<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            cursor: pointer;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            margin-top: 10px;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .form-container {
                padding: 15px;
                width: 90%;
            }
        }

    </style>
</head>
<body>

    <div class="form-container">
        <h1>Edit Transaksi</h1>
        <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_buku">Pilih Buku:</label>
                <select name="id_buku" id="id_buku" required>
                    <option value="" disabled>-- Pilih Buku --</option>
                    @foreach($bukus as $buku)
                        <option value="{{ $buku->id }}" 
                            @if($buku->id == $transaksi->id_buku) selected @endif>
                            {{ $buku->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama_peminjam">Nama Peminjam:</label>
                <input type="text" name="nama_peminjam" id="nama_peminjam" value="{{ old('nama_peminjam', $transaksi->nama_peminjam) }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', $transaksi->tanggal_pinjam) }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $transaksi->tanggal_kembali) }}">
            </div>


            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="" disabled>-- Pilih Status --</option>
                    <option value="dipinjam" @if(old('status', $transaksi->status) == 'dipinjam') selected @endif>Dipinjam</option>
                    <option value="dikembalikan" @if(old('status', $transaksi->status) == 'dikembalikan') selected @endif>Dikembalikan</option>
                </select>
            </div>

            <button type="submit">Edit Transaksi</button>
        </form>
            <a href="{{ route('transaksis.index') }}">
            
                <button type="button" class="cancel-btn">Batal</button>
            </a>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
    </div>

</body>
</html>