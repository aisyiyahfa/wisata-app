<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRekening extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori_rekening','no_rekening'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
