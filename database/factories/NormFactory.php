<?php

namespace Database\Factories;

use App\Models\Norm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Norm>
 */
class NormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(3),
            'name' => 'Norma '.ucfirst(fake()->word()),
            'description' => fake()->paragraph(),
            'examples' => fake()->sentences(3),
            'sanctions' => fake()->sentences(3),
            'illustration_path' => null,
            'color' => fake()->randomElement(['blue', 'rose', 'emerald', 'amber']),
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
