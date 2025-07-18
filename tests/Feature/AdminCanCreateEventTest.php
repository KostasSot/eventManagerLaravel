<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanCreateEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.events.store'), [
                'title' => 'Test Event',
                'description' => 'Test Description',
                'event_date' => now()->addDays(5),
                'location' => 'Online',
                'capacity' => 100,
                'status' => 'published',
            ])
            ->assertRedirect(route('admin.events.index'));

        $this->assertDatabaseHas('events', ['title' => 'Test Event']);
    }
}
