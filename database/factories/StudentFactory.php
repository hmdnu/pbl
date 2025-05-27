<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'name' => $this->faker->name,
            'email' => $this->faker->email(),
            'graduation_date' => $this->faker->dateTimeBetween('2021-01-01', 'now')->format('Y-m-d'),
            'program_study_id' => $this->faker->numberBetween(1, 4),
            'has_filled_survey' => $this->faker->boolean
        ];
    }
}