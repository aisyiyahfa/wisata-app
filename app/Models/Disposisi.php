<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi_surat';
    protected $fillable = [
        'surat_id', 'penerima', 'tenggat_waktu', 'isi_disposisi', 
        'sifat_status', 'catatan'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

}
