<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiPublishedEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_published_events_are_visible_via_api(): void
    {
        Event::factory()->create(['status' => 'draft']);
        Event::factory()->create(['status' => 'published']);

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
    }
}
