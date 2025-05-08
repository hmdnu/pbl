<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            [
                'nidn' => '1998242526',
                'nama' => 'Wahyu',
                'password' => Hash::make('12345') 
            ],
            [
                'nidn' => '1998222324',
                'nama' => 'Astrid',
                'password' => Hash::make('12345')
            ]
        ];

        DB::table('admins')->insert($admin);
    }
}
