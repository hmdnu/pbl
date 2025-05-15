<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlumniEvaluation>
 */
class AlumniEvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_nim' => Student::inRandomOrder()->first()->nim,
            'teamwork' => $this->faker->numberBetween(1, 4),
            'it_expertise' => $this->faker->numberBetween(1, 4),
            'foreign_language' => $this->faker->numberBetween(1, 4),
            'communication' => $this->faker->numberBetween(1, 4),
            'self_development' => $this->faker->numberBetween(1, 4),
            'leadership' => $this->faker->numberBetween(1, 4),
            'work_ethic' => $this->faker->numberBetween(1, 4),
            'unmet_competencies' => $this->faker->numberBetween(1, 4)
        ];
    }
}