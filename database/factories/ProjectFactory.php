<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // find random user to assign as created_by
        $user = User::inRandomOrder()->first();

        return [
            'name' => $this->faker->sentence(3),
            'start_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'responsible' => $user ? $user->name : $this->faker->name(),
            'amount' => $this->faker->randomFloat(2, 1000, 10000),
            'created_by' => $user ? $user->id : null,
        ];
    }
}
