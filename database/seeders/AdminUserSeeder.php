<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the teacher (admin) and a demo student account.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guru@sovnorm.sch.id'],
            [
                'name' => 'Guru Sosiologi',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ],
        );

        User::updateOrCreate(
            ['email' => 'siswa@sovnorm.sch.id'],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
        );
    }
}
