<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\AlumniEvaluation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlumniUserSurvey>
 */
class AlumniUserSurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'institution_type' => $this->faker->randomElement(['Pemerintah', 'Swasta', 'BUMN', 'Pendidikan Tinggi']),
            'institution_name' => $this->faker->company,
            'position' => $this->faker->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
            'student_nim' => Student::inRandomOrder()->first()->nim,
            'alumni_evaluation_id' => AlumniEvaluation::inRandomOrder()->first()->id,
            'curriculum_suggestion' => $this->faker->paragraph,
        ];
    }
}