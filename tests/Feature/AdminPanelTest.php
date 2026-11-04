<?php

namespace Tests\Feature;

use App\Models\ConceptCard;
use App\Models\Materi;
use App\Models\McqQuestion;
use App\Models\Norm;
use App\Models\QuizPair;
use App\Models\Recording;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function guru(): User
    {
        return User::factory()->guru()->create();
    }

    public function test_dashboard_shows_stats(): void
    {
        Materi::factory()->count(2)->create();
        User::factory()->count(3)->create();

        $this->actingAs($this->guru())->get(route('admin.dashboard'))->assertOk();
    }

    public function test_guru_can_create_materi(): void
    {
        $this->actingAs($this->guru())->post(route('admin.materi.store'), [
            'title' => 'Materi Baru',
            'slug' => 'materi-baru',
            'summary' => 'Ringkasan materi baru.',
            'body' => 'Paragraf pertama.'."\n\n".'Paragraf kedua.',
            'quote' => 'Kutipan pembelajaran.',
            'sort_order' => 9,
            'is_published' => '1',
        ])->assertRedirect(route('admin.materi.index'));

        $this->assertDatabaseHas('materis', [
            'slug' => 'materi-baru',
            'title' => 'Materi Baru',
            'is_published' => true,
        ]);
    }

    public function test_guru_can_update_materi(): void
    {
        $materi = Materi::factory()->create();

        $this->actingAs($this->guru())->put(route('admin.materi.update', $materi), [
            'title' => 'Judul Diubah',
            'slug' => $materi->slug,
            'summary' => 'Ringkasan baru.',
            'body' => 'Isi baru.',
            'quote' => 'Kutipan baru.',
            'sort_order' => $materi->sort_order,
            'is_published' => '1',
        ])->assertRedirect(route('admin.materi.index'));

        $this->assertSame('Judul Diubah', $materi->fresh()->title);
    }

    public function test_guru_can_delete_materi(): void
    {
        $materi = Materi::factory()->create();

        $this->actingAs($this->guru())->delete(route('admin.materi.destroy', $materi))
            ->assertRedirect(route('admin.materi.index'));

        $this->assertDatabaseMissing('materis', ['id' => $materi->id]);
    }

    public function test_guru_can_upload_materi_audio(): void
    {
        Storage::fake('public');
        $materi = Materi::factory()->create(['audio_path' => null]);
        $file = UploadedFile::fake()->create('narasi.mp3', 500, 'audio/mpeg');

        $this->actingAs($this->guru())->post(route('admin.materi.audio', $materi), [
            'audio' => $file,
        ])->assertRedirect();

        $this->assertNotNull($materi->fresh()->audio_path);
    }

    public function test_guru_can_create_concept_card(): void
    {
        $this->actingAs($this->guru())->post(route('admin.kartu-hafalan.store'), [
            'name' => 'Kartu Baru',
            'front_text' => 'Pertanyaan konsep baru?',
            'back_text' => 'Jawaban konsep baru.',
            'icon' => 'star',
            'color' => 'blue',
            'sort_order' => 12,
        ])->assertRedirect(route('admin.kartu-hafalan.index'));

        $this->assertDatabaseHas('concept_cards', ['name' => 'Kartu Baru']);
    }

    public function test_guru_can_create_norm(): void
    {
        $this->actingAs($this->guru())->post(route('admin.norma.store'), [
            'slug' => 'norma-uji',
            'name' => 'Norma Uji',
            'description' => 'Deskripsi norma uji.',
            'examples' => ['Contoh satu', 'Contoh dua'],
            'sanctions' => ['Sanksi satu', 'Sanksi dua'],
            'color' => 'blue',
        ])->assertRedirect(route('admin.norma.index'));

        $this->assertDatabaseHas('norms', ['slug' => 'norma-uji']);
    }

    public function test_guru_can_create_quiz_pair(): void
    {
        $this->actingAs($this->guru())->post(route('admin.pasangan-quiz.store'), [
            'situation' => 'Situasi uji pasangan quiz.',
            'correct_norm' => 'hukum',
            'explanation' => 'Karena melanggar peraturan.',
            'is_active' => '1',
        ])->assertRedirect(route('admin.pasangan-quiz.index'));

        $this->assertDatabaseHas('quiz_pairs', [
            'situation' => 'Situasi uji pasangan quiz.',
            'correct_norm' => 'hukum',
        ]);
    }

    public function test_guru_cannot_create_quiz_pair_with_invalid_norm(): void
    {
        $this->actingAs($this->guru())->post(route('admin.pasangan-quiz.store'), [
            'situation' => 'Situasi tidak valid.',
            'correct_norm' => 'norma-ngawur',
        ])->assertSessionHasErrors('correct_norm');
    }

    public function test_guru_can_create_mcq(): void
    {
        $this->actingAs($this->guru())->post(route('admin.soal-pilihan-ganda.store'), [
            'question' => 'Soal uji pilihan ganda?',
            'difficulty' => 'sulit',
            'options' => ['A1', 'A2', 'A3', 'A4'],
            'correct_index' => 2,
            'explanation' => 'Karena itu jawabannya.',
            'sort_order' => 11,
            'is_active' => '1',
        ])->assertRedirect(route('admin.soal-pilihan-ganda.index'));

        $this->assertDatabaseHas('mcq_questions', [
            'question' => 'Soal uji pilihan ganda?',
            'difficulty' => 'sulit',
            'correct_index' => 2,
        ]);
    }

    public function test_guru_cannot_create_mcq_with_unknown_difficulty(): void
    {
        $this->actingAs($this->guru())->post(route('admin.soal-pilihan-ganda.store'), [
            'question' => 'Soal dengan level ngawur?',
            'difficulty' => 'expert',
            'options' => ['A1', 'A2', 'A3', 'A4'],
            'correct_index' => 1,
            'sort_order' => 1,
        ])->assertSessionHasErrors('difficulty');
    }

    public function test_guru_can_filter_questions_by_difficulty(): void
    {
        McqQuestion::factory()->create(['question' => 'Soal mudah sekali?', 'difficulty' => 'mudah']);
        McqQuestion::factory()->create(['question' => 'Soal sulit sekali?', 'difficulty' => 'sulit']);

        $guru = $this->guru();

        $this->actingAs($guru)->get(route('admin.soal-pilihan-ganda.index', ['level' => 'mudah']))
            ->assertOk()
            ->assertSee('Soal mudah sekali?')
            ->assertDontSee('Soal sulit sekali?');

        $this->actingAs($guru)->get(route('admin.soal-pilihan-ganda.index'))
            ->assertOk()
            ->assertSee('Soal mudah sekali?')
            ->assertSee('Soal sulit sekali?');
    }

    public function test_guru_can_review_recording(): void
    {
        $recording = Recording::factory()->create();

        $this->actingAs($this->guru())->patch(route('admin.hafalan.update', $recording), [
            'status' => 'diterima',
            'feedback' => 'Penjelasan sudah jelas!',
        ])->assertRedirect();

        $fresh = $recording->fresh();
        $this->assertSame('diterima', $fresh->status);
        $this->assertNotNull($fresh->reviewed_at);
    }

    public function test_guru_recording_review_rejects_invalid_status(): void
    {
        $recording = Recording::factory()->create();

        $this->actingAs($this->guru())->patch(route('admin.hafalan.update', $recording), [
            'status' => 'ngawur',
        ])->assertSessionHasErrors('status');
    }

    public function test_admin_index_pages_render(): void
    {
        ConceptCard::factory()->create();
        Norm::factory()->create();
        QuizPair::factory()->create();
        McqQuestion::factory()->create();
        Recording::factory()->create();
        User::factory()->create();

        $guru = $this->guru();

        $this->actingAs($guru)->get(route('admin.materi.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.kartu-hafalan.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.norma.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.pasangan-quiz.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.soal-pilihan-ganda.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.hafalan.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.siswa.index'))->assertOk();
        $this->actingAs($guru)->get(route('admin.materi.create'))->assertOk();
    }
}
