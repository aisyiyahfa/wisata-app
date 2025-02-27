<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kategori_id',
        'kategori_rekening_id',
        'keterangan',
        'jenis', // Pemasukan atau Pengeluaran
        'nominal',
    ];

    // Relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi dengan model KategoriRekening
    public function kategoriRekening()
    {
        return $this->belongsTo(KategoriRekening::class);
    }
}
