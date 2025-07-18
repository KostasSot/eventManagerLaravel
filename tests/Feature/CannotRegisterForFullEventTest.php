<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CannotRegisterForFullEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_register_if_event_is_full(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'published',
            'capacity' => 1,
            'current_registrations_count' => 1,
        ]);

        Sanctum::actingAs($user);

        $this->postJson("/api/events/{$event->id}/register")
            ->assertStatus(422)
            ->assertJson(['message' => 'Event is full']);
    }
}
