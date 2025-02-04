<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        /* Gaya tetap sama seperti sebelumnya */
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
            background-color: #4c1c62;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #35104d;
        }

        .cancel-btn {
            background-color: #9486a6;
            margin-top: 10px;
        }

        .cancel-btn:hover {
            background-color: #8c7ca1;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .form-container {
                padding: 15px;
                width: 90%;
            }
        }

        /* Success alert styles */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Edit Buku</h1>
    <form action="{{ route('bukus.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" required>
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" id="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required>
        </div>

        <div class="form-group">
            <label for="penerbit">Penerbit:</label>
            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
        </div>

        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi_rak">Lokasi Rak:</label>
            <input type="text" name="lokasi_rak" id="lokasi_rak" value="{{ old('lokasi_rak', $buku->lokasi_rak) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="" disabled>-- Pilih Status --</option>
                <option value="tersedia" @if(old('status', $buku->status) == 'tersedia') selected @endif>Tersedia</option>
                <option value="dipinjam" @if(old('status', $buku->status) == 'dipinjam') selected @endif>Dipinjam</option>
            </select>
        </div>

        <button type="submit">Edit Buku</button>
    </form>

    <!-- Tombol Batal -->
    <a href="{{ route('bukus.index') }}">
        <button type="button" class="cancel-btn">Batal</button>
    </a>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

</body>
</html>