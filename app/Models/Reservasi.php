<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_ketua',
        'user_id',
        'jumlah_rombongan',
        'alamat_rombongan',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'email',
        'telepon',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
