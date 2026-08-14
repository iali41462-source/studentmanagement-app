<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'name' => fake()->randomElement([
            'Laravel',
            'PHP',
            'JavaScript',
            'React',
            'Vue.js',
            'Node.js',
            'MySQL',
            'HTML & CSS',
            'Python',
            'C++',
        ]),
        'syllabus' => fake()->randomElement([
    'Mathematics',
    'Physics',
    'Chemistry',
    'English',
    'Computer Science',
]),
        'duration' => fake()->randomElement([
    '1 Month',
    '2 Months',
    '3 Months',
    '6 Months',
    '12 Months',
]),
        ];
    }
}
