namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class KartuPeminjamanRepository
{
    public function getKartuByTransaksiId($idTransaksi)
    {
        return DB::table('kartu_peminjamen')
            ->join('transaksi', 'kartu_peminjamen.id_transaksi', '=', 'transaksi.id')
            ->select(
                'kartu_peminjamen.nomor_kartu',
                'kartu_peminjamen.nama_peminjam',
                'kartu_peminjamen.judul_buku',
                'kartu_peminjamen.tanggal_pinjam',
                'kartu_peminjamen.tanggal_kembali'
            )
            ->where('transaksi.id', $idTransaksi)
            ->first();
    }
}
