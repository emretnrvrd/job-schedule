<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach(range(1,5) as $order) {
            \App\Models\Developer::factory()->create([
                "name" => "Developer ". $order,
                "level" => $order,
                "weekly_working_hours" => 45
            ]);
        }
    }
}
