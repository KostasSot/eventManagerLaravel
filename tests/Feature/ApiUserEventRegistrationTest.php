<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiUserEventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_for_event(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['status' => 'published', 'capacity' => 50]);

        Sanctum::actingAs($user);

        $this->postJson("/api/events/{$event->id}/register")
            ->assertStatus(200)
            ->assertJson(['message' => 'Registered successfully']);

        $this->assertDatabaseHas('event_user', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }
}
