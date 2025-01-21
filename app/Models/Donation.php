<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika tidak sesuai dengan konvensi  
    protected $table = 'donations';  
  
    // Tentukan kolom yang dapat diisi  
    protected $fillable = [  
        'name',  
        'nominal',  
        'date',  
        'description',  
        'transfer_proof', 
        'status',  
    ];  
}
