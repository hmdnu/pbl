<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProffesionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["id" => 1, 'name' => 'Bidang Infokom'],
            ['id' => 2, 'name' => 'Bidang Non Infokom'],
            ['id' => 3, 'name' => 'Belum Bekerja']
        ];

        DB::table('profession_categories')->insert($data);
    }
}