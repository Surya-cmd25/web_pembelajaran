<?php

namespace Tests\Feature;

use App\Models\ConceptCard;
use App\Models\PuzzleProgress;
use App\Models\Recording;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_can_upload_recording(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $card = ConceptCard::factory()->create();

        $file = UploadedFile::fake()->create('rekaman.webm', 200, 'video/webm');

        $response = $this->actingAs($user)->postJson(route('setor-hafalan.store'), [
            'concept_card_id' => $card->id,
            'audio' => $file,
            'duration' => 42,
        ])->assertOk();

        $this->assertDatabaseHas('recordings', [
            'user_id' => $user->id,
            'concept_card_id' => $card->id,
            'duration' => 42,
            'status' => Recording::STATUS_MENUNGGU,
        ]);

        $this->assertNotNull($response->json('recording.id'));
        $this->assertTrue($user->fresh()->hasCompleted('hafalan'));
    }

    public function test_recording_rejects_non_audio_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $card = ConceptCard::factory()->create();

        $file = UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf');

        $this->actingAs($user)->postJson(route('setor-hafalan.store'), [
            'concept_card_id' => $card->id,
            'audio' => $file,
        ])->assertUnprocessable();

        $this->assertDatabaseCount('recordings', 0);
    }

    public function test_recording_requires_existing_card(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('rekaman.webm', 100, 'audio/webm');

        $this->actingAs($user)->postJson(route('setor-hafalan.store'), [
            'concept_card_id' => 999999,
            'audio' => $file,
        ])->assertUnprocessable();
    }

    public function test_galeri_marks_activity_on_visit(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('galeri-norma'))->assertOk();

        $this->assertTrue($user->fresh()->hasCompleted('galeri'));
    }

    public function test_siswa_can_save_puzzle_progress(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('puzzle.save'), [
            'level' => 1,
            'placed' => [0, 1, 2],
            'is_completed' => false,
        ])->assertOk()->assertJson(['saved' => true, 'is_completed' => false]);

        $this->assertDatabaseHas('puzzle_progress', [
            'user_id' => $user->id,
            'level' => 1,
            'is_completed' => false,
        ]);
    }

    public function test_completed_puzzle_requires_ten_pieces(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('puzzle.save'), [
            'level' => 2,
            'placed' => [0, 1, 2],
            'is_completed' => true,
        ])->assertOk()->assertJson(['saved' => true, 'is_completed' => false]);

        $this->assertFalse($user->fresh()->hasCompleted('puzzle'));
    }

    public function test_full_puzzle_marks_activity_complete(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('puzzle.save'), [
            'level' => 3,
            'placed' => range(0, 9),
            'is_completed' => true,
        ])->assertOk()->assertJson(['saved' => true, 'is_completed' => true]);

        $this->assertTrue($user->fresh()->hasCompleted('puzzle'));
        $this->assertTrue(PuzzleProgress::where('user_id', $user->id)->where('level', 3)->value('is_completed'));
    }

    public function test_puzzle_rejects_invalid_level(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(route('puzzle.save'), [
            'level' => 9,
            'placed' => [0],
            'is_completed' => false,
        ])->assertUnprocessable();
    }
}
