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
            $table->date('tanggal');
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
            $table->foreignId('kategori_rekening_id')->constrained()->onDelete('cascade');
            $table->string('keterangan')->nullable();
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->decimal('pemasukan', 10, 2)->nullable(); // Kolom untuk pemasukan
            $table->decimal('pengeluaran', 10, 2)->nullable(); // Kolom untuk pengeluaran
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
