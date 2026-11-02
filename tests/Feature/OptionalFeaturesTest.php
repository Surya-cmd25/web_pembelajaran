<?php

namespace Tests\Feature;

use App\Models\ConceptCard;
use App\Models\McqAttempt;
use App\Models\Norm;
use App\Models\QuizAttempt;
use App\Models\User;
use App\Notifications\RecordingSubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OptionalFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_renders_svg_illustrations(): void
    {
        Norm::factory()->create(['slug' => 'norma-agama']);

        $this->actingAs(User::factory()->create())
            ->get(route('galeri-norma'))
            ->assertOk()
            ->assertSee('data-illustration', false)
            ->assertSee('<svg', false);
    }

    public function test_teachers_are_notified_when_a_recording_is_submitted(): void
    {
        Storage::fake('public');
        Notification::fake();

        $guru = User::factory()->guru()->create();
        $siswa = User::factory()->create();
        $card = ConceptCard::factory()->create();

        $this->actingAs($siswa)->post(route('setor-hafalan.store'), [
            'concept_card_id' => $card->id,
            'audio' => UploadedFile::fake()->create('rekaman.webm', 50, 'audio/webm'),
            'duration' => 12,
        ])->assertOk();

        Notification::assertSentTo($guru, RecordingSubmitted::class);
        Notification::assertNotSentTo($siswa, RecordingSubmitted::class);
    }

    public function test_guru_can_export_quiz_and_mcq_scores_as_csv(): void
    {
        QuizAttempt::factory()->create(['score' => 2, 'total' => 3, 'user_id' => User::factory()->create(['name' => 'Budi'])]);
        McqAttempt::factory()->create(['score' => 8, 'total' => 10, 'user_id' => User::factory()->create(['name' => '=cmd|calc'])]);

        $guru = User::factory()->guru()->create();

        $quiz = $this->actingAs($guru)->get(route('admin.ekspor.quiz'));
        $quiz->assertOk()->assertDownload();
        $this->assertStringContainsString('Budi', $quiz->streamedContent());

        $soal = $this->actingAs($guru)->get(route('admin.ekspor.soal'))->streamedContent();
        $this->assertStringContainsString("'=cmd|calc", $soal);
        $this->assertStringContainsString('80', $soal);
    }

    public function test_siswa_cannot_export(): void
    {
        $this->actingAs(User::factory()->create())->get(route('admin.ekspor.quiz'))->assertForbidden();
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('profil.edit'))->assertOk();

        $this->actingAs($user)->patch(route('profil.update'), [
            'name' => 'Nama Baru',
            'email' => 'baru@example.com',
        ])->assertRedirect(route('profil.edit'));

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Nama Baru', 'email' => 'baru@example.com']);
    }

    public function test_profile_email_must_be_unique(): void
    {
        $other = User::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->patch(route('profil.update'), [
            'name' => 'X',
            'email' => $other->email,
        ])->assertSessionHasErrors('email');
    }

    public function test_user_can_change_password(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->actingAs($user)->put(route('profil.password'), [
            'current_password' => 'password',
            'password' => 'kata-sandi-baru-123',
            'password_confirmation' => 'kata-sandi-baru-123',
        ])->assertRedirect(route('profil.edit'));

        $this->assertTrue(Hash::check('kata-sandi-baru-123', $user->fresh()->password));
    }

    public function test_password_change_requires_current_password(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->actingAs($user)->put(route('profil.password'), [
            'current_password' => 'salah',
            'password' => 'kata-sandi-baru-123',
            'password_confirmation' => 'kata-sandi-baru-123',
        ])->assertSessionHasErrors('current_password');
    }
}
