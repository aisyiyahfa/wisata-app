<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'value',
    ];

    public static function getValueByCode(\App\Enums\Config $code): ?string
    {
        // Mengambil konfigurasi berdasarkan kode
        $config = self::code($code)->first();
        
        // Mengembalikan nilai jika ada, jika tidak, mengembalikan null
        return $config ? $config->value : null;
    }
    public function scopeCode($query, \App\Enums\Config $code)
    {
        return $query->where('code', $code->value());
    }
}