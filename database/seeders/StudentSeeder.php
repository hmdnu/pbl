<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nim' => '123',
                'name' => 'siluman rubah',
                'email' => 'daniuyan71@gmail.com',
                'graduation_date' => Carbon::parse('05-01-2025')->format('Y-m-d'),
                'program_study_id' => '1',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '124',
                'name' => 'naga hitam',
                'email' => 'nagahitam@example.com',
                'graduation_date' => Carbon::parse('06-01-2025')->format('Y-m-d'),
                'program_study_id' => '1',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '125',
                'name' => 'elang api',
                'email' => 'elangapi@example.com',
                'graduation_date' => Carbon::parse('07-01-2025')->format('Y-m-d'),
                'program_study_id' => '1',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Student::factory()->count(10)->create();

        foreach ($data as $d) {
            Student::create($d);
        }
    }
}
