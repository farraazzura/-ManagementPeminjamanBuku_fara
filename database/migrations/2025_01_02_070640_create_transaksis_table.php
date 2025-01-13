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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_buku")->constrained('bukus')->onDeleted('cascade');
            $table->string("nama_peminjam");
            $table->date("tanggal_pinjam");
            $table->date("tanggal_kembali");
            $table->enum("status",["dipinjam", "dikembalikan"])->default('dipinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
