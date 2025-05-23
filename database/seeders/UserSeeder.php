<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nip' => '1998242526',
                'name' => 'Wahyu',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '1998222324',
                'name' => 'Astrid',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        User::insert($data);
    }
}