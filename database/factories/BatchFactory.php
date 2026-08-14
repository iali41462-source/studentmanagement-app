<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Morning Batch',
                'Evening Batch',
                'Weekend Batch',
            ]),

            'course_id' => Course::inRandomOrder()->first()->id,

            'start_date' => fake()->date(),
        ];
    }
}
