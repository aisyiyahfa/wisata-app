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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->string('instansi_pengirim');
            $table->string('perihal');
            $table->date('tgl_surat');
            $table->date('diterima_tgl');
            $table->string('lampiran')->nullable();
            $table->enum('status', ['1', '2', '3']); // 1: Diterima, 2: Diproses, 3: Selesai
            $table->enum('sifat', ['1', '2']); // 1: Penting, 2: Biasa
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
