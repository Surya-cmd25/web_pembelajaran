<?php

namespace Database\Factories;

use App\Models\McqAttempt;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<McqAttempt>
 */
class McqAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = 10;

        return [
            'user_id' => User::factory(),
            'score' => fake()->numberBetween(0, $total),
            'total' => $total,
            'answers' => [],
        ];
    }
}
