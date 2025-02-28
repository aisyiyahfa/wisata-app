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
        Schema::dropIfExists('surat_masuks');
        Schema::dropIfExists('surat_keluars');

        Schema::create('kategori_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->string('nomor_agenda')->nullable();
            $table->date('tanggal_surat');
            $table->date('tanggal_diterima')->nullable();
            $table->text('ringkasan');
            $table->foreignId('kategori_id')->constrained('kategori_surat')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('lampiran')->nullable();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->timestamps();
        });

        Schema::create('disposisi_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('penerima');
            $table->date('tenggat_waktu')->nullable();
            $table->text('isi_disposisi');
            $table->enum('sifat_status', ['rahasia', 'segera', 'biasa']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            Schema::dropIfExists('kategori_surat');
            Schema::dropIfExists('surat');
            Schema::dropIfExists('management_surat');
        });
    }
};
