<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_ketua',
        'jumlah_rombongan',
        'alamat_rombongan',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'email',
        'status',
    ];
}
