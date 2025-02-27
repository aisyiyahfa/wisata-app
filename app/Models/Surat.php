<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $fillable = [
        'nomor_surat', 'pengirim', 'nomor_agenda', 'tanggal_surat', 
        'tanggal_diterima', 'ringkasan', 'kategori_id', 'keterangan', 
        'lampiran', 'tipe'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'surat_id');
    }
}
