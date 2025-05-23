<?php

namespace Database\Seeders;

use App\Models\AlumniUserSurvey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniUserSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlumniUserSurvey::factory()->count(10)->create();
    }
}