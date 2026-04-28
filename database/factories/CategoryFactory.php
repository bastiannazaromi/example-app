<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $name = fake()->sentence(2),
            'slug'        => str($name)->slug(),
            'description' => fake()->paragraph(),
            'is_active'   => fake()->boolean(80),
            'view_count'  => fake()->numberBetween(0, 1000),
            'created_at'  => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
