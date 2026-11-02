<?php

namespace Tests\Feature;

use App\Models\AppSetting;
use App\Models\Materi;
use App\Models\McqAttempt;
use App\Models\McqQuestion;
use App\Models\Norm;
use App\Models\PuzzleLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminExtrasTest extends TestCase
{
    use RefreshDatabase;

    private function guru(): User
    {
        return User::factory()->guru()->create();
    }

    public function test_guru_sees_student_results_with_review(): void
    {
        $student = User::factory()->create(['name' => 'Budi Santoso']);
        $question = McqQuestion::factory()->create(['correct_index' => 2]);

        $this->actingAs($student)->postJson(route('soal.submit'), [
            'answers' => [$question->id => 0],
        ])->assertOk();

        $guru = $this->guru();

        $this->actingAs($guru)->get(route('admin.soal-pilihan-ganda.hasil'))
            ->assertOk()
            ->assertSee('Budi Santoso');

        $attempt = McqAttempt::firstOrFail();

        $this->actingAs($guru)->get(route('admin.soal-pilihan-ganda.hasil.show', $attempt))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('Jawaban siswa')
            ->assertSee('Jawaban benar');
    }

    public function test_siswa_cannot_open_admin_results_or_puzzle(): void
    {
        $siswa = User::factory()->create();

        $this->actingAs($siswa)->get(route('admin.soal-pilihan-ganda.hasil'))->assertForbidden();
        $this->actingAs($siswa)->get(route('admin.puzzle.index'))->assertForbidden();
    }

    public function test_guru_can_set_duration_shown_to_students(): void
    {
        McqQuestion::factory()->count(2)->create();

        $this->actingAs($this->guru())->put(route('admin.soal-pilihan-ganda.pengaturan'), [
            'duration_minutes' => 25,
            'description' => 'Kerjakan dengan teliti.',
        ])->assertRedirect();

        $this->assertSame('25', AppSetting::read('mcq_duration_minutes'));

        $this->actingAs(User::factory()->create())->get(route('soal'))
            ->assertOk()
            ->assertSee('25 menit')
            ->assertSee('Kerjakan dengan teliti.');
    }

    public function test_guru_can_manage_puzzle_levels_up_to_five(): void
    {
        Storage::fake('public');
        $guru = $this->guru();

        $this->actingAs($guru)->post(route('admin.puzzle.store'), [
            'level' => 1,
            'title' => 'Peta Indonesia',
            'image' => UploadedFile::fake()->image('peta.png', 800, 600),
            'rows' => 3,
            'cols' => 4,
            'time_minutes' => 4,
            'is_active' => 1,
        ])->assertRedirect(route('admin.puzzle.index'));

        $level = PuzzleLevel::firstOrFail();
        $this->assertSame(240, $level->time_limit);
        $this->assertSame(12, $level->pieceCount());
        Storage::disk('public')->assertExists($level->image_path);

        foreach ([2, 3, 4, 5] as $number) {
            PuzzleLevel::create(['level' => $number, 'title' => "L{$number}", 'rows' => 2, 'cols' => 2, 'time_limit' => 60]);
        }

        $this->actingAs($guru)->get(route('admin.puzzle.create'))
            ->assertRedirect(route('admin.puzzle.index'));

        $this->actingAs($guru)->post(route('admin.puzzle.store'), [
            'level' => 5, 'title' => 'Dobel', 'rows' => 2, 'cols' => 2, 'time_minutes' => 1,
        ])->assertSessionHasErrors('level');

        $this->actingAs($guru)->put(route('admin.puzzle.update', $level), [
            'level' => 1, 'title' => 'Peta', 'rows' => 4, 'cols' => 5, 'time_minutes' => 6, 'remove_image' => 1,
        ])->assertRedirect(route('admin.puzzle.index'));

        $level->refresh();
        $this->assertNull($level->image_path);
        $this->assertSame(20, $level->pieceCount());

        $this->actingAs($guru)->delete(route('admin.puzzle.destroy', $level))->assertRedirect();
        $this->assertDatabaseMissing('puzzle_levels', ['id' => $level->id]);
    }

    public function test_puzzle_page_lists_levels_for_students(): void
    {
        PuzzleLevel::create(['level' => 1, 'title' => 'Gambar Satu', 'rows' => 2, 'cols' => 3, 'time_limit' => 120]);
        PuzzleLevel::create(['level' => 2, 'title' => 'Tersembunyi', 'rows' => 2, 'cols' => 3, 'time_limit' => 120, 'is_active' => false]);

        $this->actingAs(User::factory()->create())->get(route('puzzle'))
            ->assertOk()
            ->assertSee('Gambar Satu')
            ->assertDontSee('Tersembunyi');
    }

    public function test_materi_image_is_uploaded_and_shown_to_students(): void
    {
        Storage::fake('public');

        $this->actingAs($this->guru())->post(route('admin.materi.store'), [
            'title' => 'Materi Bergambar',
            'slug' => 'materi-bergambar',
            'body' => 'Isi materi.',
            'sort_order' => 1,
            'is_published' => 1,
            'image' => UploadedFile::fake()->image('ilustrasi.jpg', 600, 400),
        ])->assertRedirect(route('admin.materi.index'));

        $materi = Materi::where('slug', 'materi-bergambar')->firstOrFail();
        Storage::disk('public')->assertExists($materi->image_path);

        $this->actingAs(User::factory()->create())->get(route('materi.show', $materi->slug))
            ->assertOk()
            ->assertSee('storage/'.$materi->image_path, false);

        $this->actingAs($this->guru())->put(route('admin.materi.update', $materi), [
            'title' => 'Materi Bergambar',
            'slug' => 'materi-bergambar',
            'body' => 'Isi materi.',
            'sort_order' => 1,
            'remove_image' => 1,
        ])->assertRedirect();

        $this->assertNull($materi->fresh()->image_path);
    }

    public function test_uploaded_norm_illustration_appears_in_student_gallery(): void
    {
        $norm = Norm::factory()->create(['illustration_path' => 'illustrations/contoh.png']);

        $this->actingAs(User::factory()->create())->get(route('galeri-norma'))
            ->assertOk()
            ->assertSee('storage/illustrations/contoh.png', false);

        $this->assertNotNull($norm);
    }
}
