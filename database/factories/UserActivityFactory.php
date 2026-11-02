<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserActivity>
 */
class UserActivityFactory extends Factory
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
            'feature_key' => fake()->randomElement(UserActivity::FEATURES),
            'completed_at' => now(),
        ];
    }
}
