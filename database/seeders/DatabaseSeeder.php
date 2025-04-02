<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
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

        // query user by email


         if (User::query()->where('email', '=', 'test@example.com')->doesntExist()) {
             User::factory()->create([
                 'name' => 'Test User',
                 'email' => 'test@example.com',
             ]);
         }

        Project::factory(10)->create();
    }
}
