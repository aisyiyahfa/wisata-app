<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([  
            [  
                'name' => 'aisyiyah',  
                'email' => 'aisyiyah@gmail.com',  
                'email_verified_at' => now(),  
                'role_id' => 1,  
                'jabatan_id' => 1,  
                'password' => bcrypt('123'),  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            
        ]);  
    }
}
