<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'enroll_no' => fake()->unique()->numerify('ENR###'),

            'batch_id' => Batch::inRandomOrder()->first()->id,

            'student_id' => Student::inRandomOrder()->first()->id,

            'join_date' => fake()->date(),

            'fee' => fake()->numberBetween(5000, 50000),
        ];
    }
}
