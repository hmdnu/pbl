<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'nim' => '123',
            'name' => 'siluman rubah',
            'email' => 'daniuyan71@gmail.com',
            'graduation_date' => Carbon::parse('05-01-2025')->format('Y-m-d'),
            'program_study_id' => '1',
            'has_filled_survey' => '0',
            'created_at' => now(),
            'updated_at' => now()
        ];

        Student::factory()->count(10)->create();
        Student::create($data);
    }
}
