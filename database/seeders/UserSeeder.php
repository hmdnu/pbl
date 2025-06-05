<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            ],
            [
                'nip' => '111',
                'name' => 'Tatang',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nip' => '112',
                'name' => 'Yusuf',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        User::insert($data);
    }
}
