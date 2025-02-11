<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 20px;
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
        <h1>Detail User</h1>
        <p>Perpustakaan Digital FARRA AZZURA DASGUPTA</p>
    </div>
    <div class="content">
        <h1>Informasi User</h1>
        <table>
             
            <tr>
                <th>Nomor Kartu</th>
                <td>{{ $kartu->no_kartu }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $kartu->nama }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $kartu->alamat }}</td>
            </tr>
            <tr>
                <th>Nomor Handphone</th>
                <td>{{ $kartu->no_hp }}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Dokumen ini dihasilkan pada {{ now()->format('d M Y H:i') }}</p>
        <p>&copy; 2025 Perpustakaan Digital FARRA AZZURA DASGUPTA</p>
    </div>
</body>
</html>