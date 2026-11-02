<?php

namespace Database\Factories;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(4),
            'title' => fake()->sentence(5),
            'summary' => fake()->sentence(10),
            'body' => fake()->paragraphs(3, true),
            'quote' => fake()->sentence(12),
            'audio_path' => null,
            'audio_duration' => fake()->numberBetween(60, 300),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_published' => true,
        ];
    }

    /**
     * Indicate that the materi is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }

    /**
     * Indicate that the materi already has an audio narration.
     */
    public function withAudio(): static
    {
        return $this->state(fn (array $attributes) => [
            'audio_path' => 'audio/materi/'.fake()->unique()->slug(3).'.mp3',
            'audio_duration' => fake()->numberBetween(60, 300),
        ]);
    }
}
