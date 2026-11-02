<?php

namespace Tests\Feature;

use App\Models\QuizAttempt;
use App\Models\QuizPair;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_round_payload_does_not_reveal_answers(): void
    {
        QuizPair::factory()->count(6)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('quiz.round'))->assertOk();

        $payload = $response->json();

        $this->assertCount(3, $payload['pairs']);
        $this->assertCount(4, $payload['norms']);

        foreach ($payload['pairs'] as $pair) {
            $this->assertArrayHasKey('id', $pair);
            $this->assertArrayHasKey('situation', $pair);
            $this->assertArrayNotHasKey('correct_norm', $pair);
            $this->assertArrayNotHasKey('explanation', $pair);
        }

        $this->assertEqualsCanonicalizing(['agama', 'kesusilaan', 'kesopanan', 'hukum'], $payload['norms']);
    }

    public function test_store_scores_answers_server_side(): void
    {
        $pairs = QuizPair::factory()->count(3)->create();
        $user = User::factory()->create();

        $answers = [
            $pairs[0]->id => $pairs[0]->correct_norm,
            $pairs[1]->id => $pairs[1]->correct_norm,
            $pairs[2]->id => $pairs[2]->correct_norm === 'hukum' ? 'agama' : 'hukum',
        ];

        $response = $this->actingAs($user)->postJson(route('quiz.store'), [
            'answers' => $answers,
        ])->assertOk();

        $this->assertSame(2, $response->json('score'));
        $this->assertSame(3, $response->json('total'));
        $this->assertTrue($response->json('results.0.is_correct'));
        $this->assertFalse($response->json('results.2.is_correct'));

        $this->assertDatabaseHas('quiz_attempts', [
            'user_id' => $user->id,
            'score' => 2,
            'total' => 3,
        ]);

        $this->assertTrue($user->fresh()->hasCompleted('quiz'));
    }

    public function test_store_rejects_invalid_norm_values(): void
    {
        $pair = QuizPair::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('quiz.store'), [
            'answers' => [$pair->id => 'norma-palsu'],
        ])->assertUnprocessable();
    }

    public function test_store_rejects_unknown_pair_ids(): void
    {
        QuizPair::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('quiz.store'), [
            'answers' => [999999 => 'agama'],
        ])->assertStatus(422);
    }

    public function test_quiz_attempt_is_recorded(): void
    {
        $pair = QuizPair::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('quiz.store'), [
            'answers' => [$pair->id => $pair->correct_norm],
        ])->assertOk();

        $this->assertSame(1, QuizAttempt::where('user_id', $user->id)->count());
    }
}
