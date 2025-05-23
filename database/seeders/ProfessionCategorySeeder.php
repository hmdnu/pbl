<?php

namespace Database\Seeders;

use App\Models\ProfessionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProfessionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            ['id' => 1, 'name' => 'Bidang Infokom', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Bidang Non Infokom', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Belum Bekerja', 'created_at' => $now, 'updated_at' => $now],
        ];

        ProfessionCategory::insert($data);
    }
}