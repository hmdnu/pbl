<?php

namespace Database\Seeders;

use App\Models\ProgramStudy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            ['id' => 1, 'name' => 'RTI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'TI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'SIB', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'PPLS', 'created_at' => $now, 'updated_at' => $now],
        ];

        ProgramStudy::insert($data);
    }
}