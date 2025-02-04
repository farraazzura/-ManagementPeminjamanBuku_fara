<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 10px;
            background-color: #4c1c62;
            color: white;
        }
        .content {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 800px;
        }
        .content h1 {
            text-align: center;
            color: #4c1c62;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detail Buku</h1>
        <p>Perpustakaan Digital FARRA AZZURA DASGUPTA</p>
    </div>
    <div class="content">
        <h1>Informasi Buku</h1>
        <table>
            <tr>
                <th>Judul Buku</th>
                <td>{{ $buku->judul ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <th>Pengarang</th>
                <td>{{ $buku->pengarang ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td>{{ $buku->penerbit ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <th>ISBN</th>
                <td>{{ $buku->isbn ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <th>Lokasi Rak</th>
                <td>{{ $buku->lokasi_rak ?? 'Data tidak tersedia' }}</td>
            </tr> 
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($buku->status ?? '-') }}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Dokumen ini dihasilkan pada {{ now()->format('d M Y H:i') }}</p>
        <p>&copy; 2025 Perpustakaan Digital FARRA AZZURA DASGUPTA</p>
    </div>
</body>
</html>
