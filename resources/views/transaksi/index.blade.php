<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peminjaman Buku Perpustakaan Ayyara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Manajemen Peminjaman Buku Perpustakaan Ayyara<</h1>

        <!-- Button to open Add Transaction Modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTransactionModal">Tambah Transaksi</button>

        <!-- Transactions Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->judul }}</td>
                    <td>{{ $transaksi->nama_peminjam }}</td>
                    <td>{{ $transaksi->tanggal_pinjam }}</td>
                    <td>{{ $transaksi->tanggal_kembali }}</td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editTransactionModal" 
                                data-id="{{ $transaksi->id }}"
                                data-judul="{{ $transaksi->judul }}"
                                data-peminjam="{{ $transaksi->nama_peminjam }}"
                                data-tanggal-pinjam="{{ $transaksi->tanggal_pinjam }}"
                                data-tanggal-kembali="{{ $transaksi->tanggal_kembali }}">
                            Edit
                        </button>
                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Transaction Modal -->
        <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTransactionModalLabel">Tambah Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addTransactionForm" action="{{ route('transaksis.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="namaPeminjam" class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="namaPeminjam" name="nama_peminjam" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalPinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="tanggalPinjam" name="tanggal_pinjam" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalKembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggalKembali" name="tanggal_kembali" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Transaction Modal -->
        <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTransactionForm" action="{{ route('transaksis.update', '') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editTransactionId" name="id">
                            <div class="mb-3">
                                <label for="editJudulBuku" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="editJudulBuku" name="judul_buku" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNamaPeminjam" class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="editNamaPeminjam" name="nama_peminjam" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTanggalPinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="editTanggalPinjam" name="tanggal_pinjam" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTaggalKembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="editTaggalKembali" name="tanggal_kembali" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const editTransactionModal = document.getElementById('editTransaksiModal');
        editTransactionModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-judul');
            const borrower = button.getAttribute('data-peminjam');
            const borrowDate = button.getAttribute('data-tanggal_pinjam');
            const returnDate = button.getAttribute('data-tanggal_kembali');

            document.getElementById('editTransaksiId').value = id;
            document.getElementById('editJudulBuku').value = judul;
            document.getElementById('editNamaPeminjam').value = peminjam;
            document.getElementById('editTanggalPinjam').value = tanggalPinjam;
            document.getElementById('editTanggalKembali').value = tanggalKembali;

            const form = document.getElementById('editTransaksiForm');
            form.action = `{{ url('transaksis') }}/${id}`;
        });
    </script>
</body>
</html>
