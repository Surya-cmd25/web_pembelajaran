<?php

namespace Database\Factories;

use App\Models\ConceptCard;
use App\Models\Recording;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recording>
 */
class RecordingFactory extends Factory
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
            'concept_card_id' => ConceptCard::factory(),
            'audio_path' => 'audio/hafalan/'.fake()->unique()->slug(4).'.webm',
            'duration' => fake()->numberBetween(15, 180),
            'status' => Recording::STATUS_MENUNGGU,
            'feedback' => null,
            'reviewed_at' => null,
        ];
    }

    /**
     * Indicate that the recording has been accepted by the teacher.
     */
    public function diterima(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Recording::STATUS_DITERIMA,
            'feedback' => 'Penjelasan sudah jelas, pertahankan!',
            'reviewed_at' => now(),
        ]);
    }

    /**
     * Indicate that the recording needs another attempt.
     */
    public function perluPercobaan(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Recording::STATUS_PERLU_PERCOBAAN,
            'feedback' => 'Coba jelaskan lebih lengkap sanksi pelanggarannya.',
            'reviewed_at' => now(),
        ]);
    }
}
