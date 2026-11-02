<?php

namespace Tests\Feature;

use App\Models\Materi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_sees_landing_page(): void
    {
        $this->get('/')->assertOk()->assertSee('SovNorm');
    }

    public function test_siswa_login_redirects_to_beranda(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('beranda'));
    }

    public function test_guru_login_redirects_to_admin_dashboard(): void
    {
        $user = User::factory()->guru()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_siswa_can_register_with_siswa_role(): void
    {
        $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ])->assertRedirect(route('beranda'));

        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.com',
            'role' => 'siswa',
        ]);
    }

    public function test_siswa_gets_403_on_admin_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/admin/materi')->assertForbidden();
        $this->actingAs($user)->get('/admin/hafalan')->assertForbidden();
    }

    public function test_guest_is_redirected_from_protected_pages(): void
    {
        $this->get('/beranda')->assertRedirect(route('login'));
        $this->get('/quiz')->assertRedirect(route('login'));
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_guru_can_access_admin_dashboard(): void
    {
        $user = User::factory()->guru()->create();

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_materi_mark_read_completes_activity_when_all_read(): void
    {
        $user = User::factory()->create();
        $materi = Materi::factory()->count(2)->create();

        foreach ($materi as $item) {
            $this->actingAs($user)
                ->post(route('materi.markRead', $item->slug))
                ->assertRedirect(route('materi.show', $item->slug));
        }

        $this->assertTrue($user->fresh()->hasCompleted('materi'));
    }
}
