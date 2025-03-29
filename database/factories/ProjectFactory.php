<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

class ProjectFactory extends Factory {
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'start_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'responsible' => $this->faker->name,
            'amount' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
