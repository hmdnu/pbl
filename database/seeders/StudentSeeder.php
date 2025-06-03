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
            ],
            [
                'nim' => '126',
                'name' => 'harimau salju',
                'email' => 'harimau@example.com',
                'graduation_date' => Carbon::parse('2025-08-01'),
                'program_study_id' => '2',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '127',
                'name' => 'serigala malam',
                'email' => 'serigala@example.com',
                'graduation_date' => Carbon::parse('2025-09-01'),
                'program_study_id' => '3',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '128',
                'name' => 'macan putih',
                'email' => 'macanputih@example.com',
                'graduation_date' => Carbon::parse('2025-10-01'),
                'program_study_id' => '1',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '129',
                'name' => 'burung hantu',
                'email' => 'hantu@example.com',
                'graduation_date' => Carbon::parse('2025-11-01'),
                'program_study_id' => '4',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '130',
                'name' => 'kuda angin',
                'email' => 'kudaangin@example.com',
                'graduation_date' => Carbon::parse('2025-12-01'),
                'program_study_id' => '2',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '131',
                'name' => 'hiu badai',
                'email' => 'hiubadai@example.com',
                'graduation_date' => Carbon::parse('2026-01-01'),
                'program_study_id' => '3',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '132',
                'name' => 'ular langit',
                'email' => 'ularlangit@example.com',
                'graduation_date' => Carbon::parse('2026-02-01'),
                'program_study_id' => '4',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '133',
                'name' => 'ikan petir',
                'email' => 'ikanpetir@example.com',
                'graduation_date' => Carbon::parse('2026-03-01'),
                'program_study_id' => '1',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '134',
                'name' => 'buaya merah',
                'email' => 'buayamerah@example.com',
                'graduation_date' => Carbon::parse('2026-04-01'),
                'program_study_id' => '2',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '135',
                'name' => 'cicak besi',
                'email' => 'cicakbesi@example.com',
                'graduation_date' => Carbon::parse('2026-05-01'),
                'program_study_id' => '3',
                'has_filled_survey' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

//        Student::factory()->count(10)->create();
        foreach ($data as $d) {
            Student::create($d);
        }
    }
}
