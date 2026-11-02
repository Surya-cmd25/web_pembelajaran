<?php

namespace Database\Factories;

use App\Models\ConceptCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConceptCard>
 */
class ConceptCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->unique()->words(2, true)),
            'front_text' => 'Apa yang dimaksud '.fake()->word().'? Jelaskan dengan bahasamu sendiri.',
            'back_text' => fake()->paragraph(),
            'icon' => fake()->randomElement(['star', 'document', 'users', 'home', 'heart', 'smile', 'scale', 'user-group']),
            'color' => fake()->randomElement(['amber', 'blue', 'cyan', 'orange', 'rose', 'emerald', 'yellow', 'indigo']),
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
