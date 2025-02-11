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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->string("pengarang");
            $table->string("penerbit");
            $table->integer("tahun_terbit");
            $table->string("isbn");
            $table->string("lokasi_rak");
            $table->enum("status",["tersedia", "dipinjam"])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
