<?php

namespace Database\Factories;

use App\Models\QuizPair;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizPair>
 */
class QuizPairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'situation' => ucfirst(fake()->sentence(16)).'.',
            'correct_norm' => fake()->randomElement(QuizPair::NORM_TYPES),
            'explanation' => fake()->sentence(14),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the pair is excluded from rounds.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
