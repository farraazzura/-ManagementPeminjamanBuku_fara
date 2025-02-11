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
            $table->integer("no_kartu");
            $table->string("nama");
            $table->text("alamat");
            $table->string("no_hp");
            //$table->foreignId("id_user")->constrained('users');
            //$table->string("nama_peminjam");
            //$table->date("tanggal_pinjam");
            //$table->date("tanggal_kembali");
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
