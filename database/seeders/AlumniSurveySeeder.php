<?php

namespace Database\Seeders;

use App\Models\AlumniSurvey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlumniSurvey::factory()->count(10)->create();
    }
}
