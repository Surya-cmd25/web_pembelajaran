<?php

namespace Database\Factories;

use App\Models\PuzzleProgress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PuzzleProgress>
 */
class PuzzleProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'level' => 1,
            'placed' => [],
            'is_completed' => false,
        ];
    }
}
