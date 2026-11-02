<?php

namespace Tests\Feature;

use App\Models\McqAttempt;
use App\Models\McqQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoalTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_does_not_reveal_correct_answers(): void
    {
        McqQuestion::factory()->count(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('soal'))->assertOk();

        $response->assertSee('data-question-id');

        $questions = $response->viewData('questions');

        $this->assertCount(3, $questions);

        foreach ($questions as $question) {
            $this->assertArrayHasKey('id', $question);
            $this->assertArrayHasKey('question', $question);
            $this->assertArrayHasKey('options', $question);
            $this->assertArrayNotHasKey('correct_index', $question);
            $this->assertArrayNotHasKey('explanation', $question);
        }
    }

    public function test_submit_scores_answers_server_side(): void
    {
        $questions = McqQuestion::factory()->count(3)->create([
            'correct_index' => 0,
        ]);
        $user = User::factory()->create();

        $answers = [
            $questions[0]->id => 0,
            $questions[1]->id => 1,
            $questions[2]->id => 0,
        ];

        $response = $this->actingAs($user)->postJson(route('soal.submit'), [
            'answers' => $answers,
        ])->assertOk();

        $this->assertSame(2, $response->json('score'));
        $this->assertSame(3, $response->json('total'));
        $this->assertTrue($response->json('results.0.is_correct'));
        $this->assertFalse($response->json('results.1.is_correct'));
        $this->assertNotNull($response->json('results.1.explanation'));

        $this->assertDatabaseHas('mcq_attempts', [
            'user_id' => $user->id,
            'score' => 2,
            'total' => 3,
        ]);

        $this->assertTrue($user->fresh()->hasCompleted('soal'));
    }

    public function test_submit_rejects_out_of_range_index(): void
    {
        $question = McqQuestion::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('soal.submit'), [
            'answers' => [$question->id => 9],
        ])->assertUnprocessable();
    }

    public function test_submit_rejects_unknown_question_ids(): void
    {
        McqQuestion::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('soal.submit'), [
            'answers' => [999999 => 0],
        ])->assertStatus(422);
    }

    public function test_attempt_is_recorded(): void
    {
        $question = McqQuestion::factory()->create(['correct_index' => 2]);
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('soal.submit'), [
            'answers' => [$question->id => 2],
        ])->assertOk();

        $this->assertSame(1, McqAttempt::where('user_id', $user->id)->count());
    }
}
