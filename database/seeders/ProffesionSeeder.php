<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProffesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["category_id" => 1, 'name' => 'Developer/Programmer/Software Engineer'],
            ["category_id" => 1, 'name' => 'IT Support/IT Administrator'],
            ["category_id" => 1, 'name' => 'Infrastructure Engineer'],
            ["category_id" => 1, 'name' => 'Digital Marketing Specialist'],
            ["category_id" => 1, 'name' => 'Graphic Designer/Multimedia Designer'],
            ["category_id" => 1, 'name' => 'Business Analyst'],
            ["category_id" => 1, 'name' => 'QA Engineer/Tester'],
            ["category_id" => 1, 'name' => 'IT Entrepreneur'],
            ["category_id" => 1, 'name' => 'Trainer/Guru/Dosen (IT)'],
            ["category_id" => 1, 'name' => 'Mahasiswa'],
            ["category_id" => 1, 'name' => 'Lainnya: ....'],
            ['category_id' => 2, 'name' => 'Procurement & Operational Team'],
            ['category_id' => 2, 'name' => 'Wirasusahawan (Non IT)'],
            ['category_id' => 2, 'name' => 'Trainer/Guru/Dosen (Non IT)'],
            ['category_id' => 2, 'name' => 'Mahasiswa'],
            ['category_id' => 2, 'name' => 'Lainnya: ....']
        ];

        DB::table('professions')->insert($data);

    }
}