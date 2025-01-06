<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kartu__peminjamen', function (Blueprint $table) {
            $table->id();
            $table->integer("id_transaksi");
            $table->string("nomor_kartu");
            $table->string("nama_peminjam");
            $table->string("judul_buku");
            $table->date("tanggal_pinjam");
            $table->date("tanggal_kembali");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu__peminjamen');
    }
};
