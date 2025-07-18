<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_has_many_users(): void
    {
        $event = Event::factory()->create();
        $users = User::factory(3)->create();

        $event->users()->attach($users->pluck('id'));

        $this->assertCount(3, $event->users);
    }
}
