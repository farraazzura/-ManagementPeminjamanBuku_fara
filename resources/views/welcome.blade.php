<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <h1>Selamat datang di Dashboard Peminjaman Buku Perpustakaan</h1>
    <p style="text-align: center;">
        <a href="{{ route('transaksis.index') }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">Kelola Transaksi Peminjaman Buku</a>
    </p>

</body>
</html>