<?php

namespace Database\Factories;

use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizAttempt>
 */
class QuizAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = 3;
        $score = fake()->numberBetween(0, $total);

        return [
            'user_id' => User::factory(),
            'score' => $score,
            'total' => $total,
            'answers' => [],
        ];
    }
}
