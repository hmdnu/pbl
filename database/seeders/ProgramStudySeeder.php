<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["id" => 1, 'name' => 'RTI'],
            ['id' => 2, 'name' => 'TI'],
            ['id' => 3, 'name' => 'SIB'],
            ['id' => 4, 'name' => 'PPLS']
        ];

        DB::table('program_studies')->insert($data);
    }
}
