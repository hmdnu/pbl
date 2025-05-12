<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nidn' => '1998242526',
                'name' => 'Wahyu',
                'password' => Hash::make('12345') 
            ],
            [
                'nidn' => '1998222324',
                'name' => 'Astrid',
                'password' => Hash::make('12345')
            ]
        ];

        DB::table('users')->insert($data);
    }
}
