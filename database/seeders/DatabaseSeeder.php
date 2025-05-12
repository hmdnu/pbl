<?php

namespace Database\Seeders;

use App\Models\AlumniEvaluation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProgramStudySeeder::class,
            StudentSeeder::class,
            ProffesionCategorySeeder::class,
            ProffesionSeeder::class,
            AlumniSurveySeeder::class,
            AlumniEvaluationSeeder::class,
            AlumniUserSurveySeeder::class,
        ]);
    }
}