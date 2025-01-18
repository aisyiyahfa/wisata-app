<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_donasi', 'id_user', 'nominal', 'status', 'tanggal', 'keterangan', 'bukti'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
