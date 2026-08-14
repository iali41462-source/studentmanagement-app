<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'enrollment_id' => Enrollment::inRandomOrder()->first()->id,

            'paid_date' => fake()->date(),

            'amount' => fake()->numberBetween(5000, 50000),
        ];
    }
}
