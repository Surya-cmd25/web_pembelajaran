<?php

namespace Tests\Feature;

use App\Models\ConceptCard;
use App\Models\Materi;
use App\Models\Norm;
use App\Models\QuizPair;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_student_pages_render(): void
    {
        Materi::factory()->count(2)->create();
        ConceptCard::factory()->count(2)->create();
        Norm::factory()->count(4)->create();
        QuizPair::factory()->count(4)->create();

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('beranda'))->assertOk();
        $this->actingAs($user)->get(route('materi.index'))->assertOk();
        $this->actingAs($user)->get(route('materi.show', Materi::first()->slug))->assertOk();
        $this->actingAs($user)->get(route('setor-hafalan'))->assertOk();
        $this->actingAs($user)->get(route('galeri-norma'))->assertOk();
        $this->actingAs($user)->get(route('quiz'))->assertOk();
        $this->actingAs($user)->get(route('soal'))->assertOk();
        $this->actingAs($user)->get(route('puzzle'))->assertOk();
    }

    public function test_materi_show_returns_404_for_unknown_slug(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('materi.show', 'slug-tidak-ada'))->assertNotFound();
    }

    public function test_unpublished_materi_is_hidden_from_students(): void
    {
        $published = Materi::factory()->create(['title' => 'Materi Terbit']);
        Materi::factory()->draft()->create(['title' => 'Materi Draft']);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('materi.index'))
            ->assertOk()
            ->assertSee('Materi Terbit')
            ->assertDontSee('Materi Draft');
    }
}
