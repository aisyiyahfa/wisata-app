<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamReservasi extends Model
{
    use HasFactory;

    protected $table = 'jam_reservasi';
    protected $fillable = ['jam'];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}

