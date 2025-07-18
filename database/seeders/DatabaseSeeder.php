<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(['email' => 'admin1@example.com', 'role' => 'admin']);
        User::factory()->create(['email' => 'admin2@example.com', 'role' => 'admin']);
        User::factory(10)->create();
        Event::factory(15)->create();
    }
}
