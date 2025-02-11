<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
            background-color: #4c1c62;
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
            background-color: #ebefe1;
            color: #ebefe1;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tambah Transaksi</h1>
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

        <!-- Form Tambah Transaksi -->
        <form action="{{ route('transaksis.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_buku">Pilih Buku:</label>
                <select name="id_buku" id="id_buku" required>
                    <option value="" disabled selected>-- Pilih Buku --</option>
                    @foreach($bukus as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_kartu">Pilih Peminjam:</label>
                <select name="id_kartu" id="id_kartu" required>
                    <option value="" disabled selected>-- Pilih Kartu --</option>
                    @foreach($kartu as $tr)
                        <option value="{{ $tr->id }}"> {{ $tr->nama ?? ''}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required>
            </div>

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali">
            </div>

            <button type="submit">Tambah Transaksi</button>
        </form>
    </div>
</body>
</html>