<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class StudentApiTest extends TestCase
{
    public function test_student_list_api_returns_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/api/v1/students');

        $response->assertStatus(200);
    }
}
