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

        $this->actingAs($user)->get(route('soal'))->assertOk()->assertSee('3 soal');

        $response = $this->actingAs($user)->get(route('soal.kerjakan'))->assertOk();

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

    public function test_index_shows_a_card_for_each_difficulty_level(): void
    {
        McqQuestion::factory()->count(2)->create();
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('soal'))
            ->assertOk()
            ->assertSee('Soal Mudah')
            ->assertSee('Soal Sedang')
            ->assertSee('Soal Sulit');
    }

    public function test_student_starts_exam_on_the_selected_difficulty_level(): void
    {
        McqQuestion::factory()->difficulty('mudah')->count(2)->create();
        McqQuestion::factory()->difficulty('sulit')->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('soal.kerjakan', ['level' => 'mudah']))->assertOk();

        $this->assertCount(2, $response->viewData('questions'));
        $this->assertSame('mudah', $response->viewData('level'));
        $response->assertSee('Mudah');

        foreach ($response->viewData('questions') as $question) {
            $this->assertArrayNotHasKey('correct_index', $question);
        }
    }

    public function test_start_rejects_unknown_difficulty_level(): void
    {
        McqQuestion::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('soal.kerjakan', ['level' => 'jago']))
            ->assertRedirect(route('soal'))
            ->assertSessionHas('status');
    }

    public function test_start_redirects_when_the_level_has_no_questions(): void
    {
        McqQuestion::factory()->difficulty('mudah')->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('soal.kerjakan', ['level' => 'sulit']))
            ->assertRedirect(route('soal'))
            ->assertSessionHas('status', 'Belum ada soal pada level ini.');
    }

    public function test_submit_scores_only_questions_from_the_selected_level(): void
    {
        $mudah = McqQuestion::factory()->difficulty('mudah')->count(2)->create(['correct_index' => 0]);
        McqQuestion::factory()->difficulty('sulit')->create(['correct_index' => 0]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('soal.submit'), [
            'level' => 'mudah',
            'answers' => [$mudah[0]->id => 0, $mudah[1]->id => 0],
        ])->assertOk();

        $this->assertSame(2, $response->json('score'));
        $this->assertSame(2, $response->json('total'));
        $this->assertDatabaseHas('mcq_attempts', [
            'user_id' => $user->id,
            'score' => 2,
            'total' => 2,
            'difficulty' => 'mudah',
        ]);
    }

    public function test_submit_rejects_answers_belonging_to_another_level(): void
    {
        $mudah = McqQuestion::factory()->difficulty('mudah')->create(['correct_index' => 0]);
        $sulit = McqQuestion::factory()->difficulty('sulit')->create(['correct_index' => 0]);
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('soal.submit'), [
            'level' => 'mudah',
            'answers' => [$mudah->id => 0, $sulit->id => 0],
        ])->assertStatus(422);
    }

    public function test_submit_rejects_unknown_difficulty_level(): void
    {
        McqQuestion::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('soal.submit'), [
            'level' => 'jago',
            'answers' => [],
        ])->assertUnprocessable();
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
        $byId = collect($response->json('results'))->keyBy('question_id');
        $this->assertTrue($byId[$questions[0]->id]['is_correct']);
        $this->assertFalse($byId[$questions[1]->id]['is_correct']);
        $this->assertNotNull($byId[$questions[1]->id]['explanation']);
        $this->assertNotNull($response->json('redirect'));

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

    public function test_unanswered_questions_count_as_wrong_and_review_is_stored(): void
    {
        $questions = McqQuestion::factory()->count(3)->create(['correct_index' => 1]);
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('soal.kerjakan'))->assertOk();

        $response = $this->actingAs($user)->postJson(route('soal.submit'), [
            'answers' => [$questions[0]->id => 1],
        ])->assertOk();

        $this->assertSame(1, $response->json('score'));
        $this->assertSame(3, $response->json('total'));

        $attempt = McqAttempt::where('user_id', $user->id)->firstOrFail();
        $this->assertCount(3, $attempt->review);
        $unanswered = collect($attempt->review)->where('question_id', $questions[1]->id)->first();
        $this->assertNull($unanswered['chosen_index']);
        $this->assertNotNull($attempt->duration_seconds);

        $this->actingAs($user)->get(route('soal.hasil', $attempt))
            ->assertOk()
            ->assertSee('Pembahasan')
            ->assertSee('Tidak dijawab');
    }

    public function test_student_cannot_open_someone_elses_result(): void
    {
        $attempt = McqAttempt::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('soal.hasil', $attempt))
            ->assertNotFound();
    }
}
