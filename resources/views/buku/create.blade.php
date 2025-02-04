<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4c1c62;
            color: #b1aabf;
            max-width: 800px;
            margin: 15px auto;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ebe8ec;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="date"]:focus, select:focus {
            border-color: #4c1c62;
            outline: none;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #4c1c62;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3a1450;
        }
        .alert {
            text-align: center;
            margin: 10px 0;
        }
        .alert p {
            padding: 10px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tambah Buku</h1>
    </header>

    <div class="container">
        <!-- Tampilkan Pesan -->
        @if(session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Form Tambah Buku -->
        <form action="{{ route('bukus.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" required>
            </div>  

            <div class="form-group">
                <label for="pengarang">Pengarang:</label>
                <input type="text" name="pengarang" id="pengarang" required>
            </div> 

            <div class="form-group">
                <label for="penerbit">Penerbit:</label>
                <input type="text" name="penerbit" id="penerbit" required>
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="string" name="tahun_terbit" id="tahun_terbit" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" required>
            </div>

            <div class="form-group">
                <label for="lokasi_rak">Lokasi Rak:</label>
                <input type="text" name="lokasi_rak" id="lokasi_rak" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="dipinjam">Dipinjam</option>
                </select>
            </div> 

            <button type="submit">Tambah Buku</button>
        </form>
    </div>
</body>
</html>
