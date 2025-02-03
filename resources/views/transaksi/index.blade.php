<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajemen Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f4ef;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4c1c62;
            color: #b1aabf;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #ccc7d8;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ebe8ec;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #7b618b;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #4c1c62;
            color: white;
        }
        .actions button {
            padding: 5px 10px;
            margin: 8px;
        }
        .actions .edit {
            background-color: #ffa500;
        }
        .actions .delete {
            background-color: #e74c3c;
        }
        .actions .print {
            background-color: #9283ab;
        }
        .logout {
            text-align: right;
        }
        .logout button {
            background: #5411ab
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .logout button:hover {
            background: #5411ab;
        }
        .back-button { 
            background-color: #4c1c62;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }

        .back-button:hover {
            background-color: #4c1c62;
        }

        /* Action Buttons (Search, Add, Logout) */
        .action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px; /* Menambahkan jarak antar elemen */
    margin-bottom: 20px;
}

.action-buttons form {
    flex-grow: 1;
    display: flex;
    justify-content: flex-start;
}

.action-buttons input[type="text"] {
    flex-grow: 1;
    margin-right: 10px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #4c1c62;
}

.action-buttons button {
    padding: 10px 15px;
    border-radius: 4px;
    font-size: 16px;
    background-color: #4c1c62;
    color: white;
    border: none;
    cursor: pointer;
}

.action-buttons button:hover {
    background-color: #4c1c62;
}

.add-data-button {
    background-color: #007bff;
}

.add-data-button:hover {
    background-color: #0056b3;
}


        .search-form button {
            background-color: #4c1c62;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-form button:hover {
            background-color: #4c1c62;
        }
        

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .action-buttons form {
                margin-bottom: 10px;
            }

            .action-buttons button {
                width: 100%;
                margin: 5px 0;
            }

            .action-buttons input[type="text"] {
                width: 100%;
            }
            
        }


        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
            animation: fadeIn 0.5s ease-in-out;
            cursor: pointer;
        }

        .modal-content {
            background-color: #4c1c62;
            margin: 5% auto;
            padding: 30px;
            border-radius: 8px;
            width: 40%;
            text-align: center;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .modal-content h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .modal-content .message {
            font-size: 18px;
            margin-top: 20px;
        }

        /* Animation for Modal */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>Dashboard - Manajemen Transaksi Buku</h1>
    </header>
    <div class="container">
        <!-- Pencarian, Tambah Data dan Logout (di bawah teks Daftar Transaksi) -->
        <h2>Daftar Transaksi</h2>
        <div class="action-buttons">
            <!-- Pencarian -->
            <form action="{{ route('transaksis.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari Transaksi... (Nama Peminjam / Judul Buku)" value="{{ request('search') }}">
                <button type="submit">Cari</button>
            </form>

            <!-- Tambah Data -->
            <a href="{{ route('transaksis.create') }}">
                <button class="add-data-button">Tambah Data</button>
            </a>

            <!-- Logout -->
            <form>
            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('dashboard.index') }}">
            <button class="back-button">Kembali ke Dashboard</button>
        </a>
    </div>


        <!-- Tabel Transaksi -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $key => $transaksi)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $transaksi->buku->judul }}</td>
                        <td>{{ $transaksi->kartu->user->username ?? 'Username tidak ada'  }}</td>
                        <td>{{ $transaksi->tanggal_pinjam }}</td>
                        <td>{{ $transaksi->tanggal_kembali ?? '-' }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td class="actions">
                            <a href="{{ route('transaksis.edit', $transaksi->id) }}"><button class="edit">Edit</button></a>
                            <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('transaksis.print', $transaksi->id) }}"><button class="print">Cetak</button></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Modal for Success/Error message -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <h2>Berhasil!</h2>
            <div class="message"></div>
        </div>
    </div>

    <script>
        // Show success/error message in a modal
        @if(session('success'))
            document.querySelector('.message').textContent = "{{ session('success') }}";
            document.getElementById('messageModal').style.display = 'block';
        @elseif(session('error'))
            document.querySelector('.message').textContent = "{{ session('error') }}";
            document.getElementById('messageModal').style.display = 'block';
        @endif

        // Close the modal when the user clicks anywhere inside the modal
        document.getElementById('messageModal').onclick = function() {
            document.getElementById('messageModal').style.display = 'none';
        }
    </script>

</body>
</html>