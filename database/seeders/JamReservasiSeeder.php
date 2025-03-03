<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JamReservasiSeeder extends Seeder
{
    public function run()
    {
        $jamReservasi = [
            '08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'
        ];

        foreach ($jamReservasi as $jam) {
            DB::table('jam_reservasi')->insert([
                'jam' => $jam,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
