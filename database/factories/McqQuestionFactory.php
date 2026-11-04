<?php

namespace Database\Factories;

use App\Models\McqQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<McqQuestion>
 */
class McqQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => ucfirst(fake()->sentence(18)).'?',
            'difficulty' => McqQuestion::DEFAULT_DIFFICULTY,
            'options' => fake()->sentences(4),
            'correct_index' => 0,
            'explanation' => fake()->sentence(14),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the question is excluded from quizzes.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Set the difficulty level of the generated question.
     */
    public function difficulty(string $level): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => $level,
        ]);
    }
}
