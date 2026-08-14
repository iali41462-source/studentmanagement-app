<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->admin()->create([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        // Teacher
        User::factory()->teacher()->create([
            'name'  => 'Teacher',
            'email' => 'teacher@gmail.com',
        ]);

        // Accountant
        User::factory()->accountant()->create([
            'name'  => 'Accountant',
            'email' => 'accountant@gmail.com',
        ]);

        // 20 Students
        User::factory()
            ->student()
            ->count(20)
            ->create();
    }
}
