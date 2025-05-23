<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            ["category_id" => 1, 'name' => 'Developer/Programmer/Software Engineer', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'IT Support/IT Administrator', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Infrastructure Engineer', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Digital Marketing Specialist', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Graphic Designer/Multimedia Designer', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Business Analyst', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'QA Engineer/Tester', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'IT Entrepreneur', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Trainer/Guru/Dosen (IT)', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Mahasiswa', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 2, 'name' => 'Procurement & Operational Team', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 2, 'name' => 'Wirasusahawan (Non IT)', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 2, 'name' => 'Trainer/Guru/Dosen (Non IT)', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 2, 'name' => 'Mahasiswa', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 1, 'name' => 'Lainnya', 'created_at' => $now, 'updated_at' => $now],
            ["category_id" => 2, 'name' => 'Lainnya', 'created_at' => $now, 'updated_at' => $now],
        ];

        Profession::insert($data);
    }
}