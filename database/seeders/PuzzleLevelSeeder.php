<?php

namespace Database\Seeders;

use App\Models\PuzzleLevel;
use Illuminate\Database\Seeder;

class PuzzleLevelSeeder extends Seeder
{
    /**
     * Seed the five default puzzle levels (they share the bundled portrait until the teacher uploads pictures).
     */
    public function run(): void
    {
        $description = 'Émile Durkheim adalah sosiolog Prancis yang diakui sebagai bapak sosiologi modern. Ia memperkenalkan konsep solidaritas sosial dan anomie, serta menekankan bahwa norma sosial adalah kenyataan nyata yang mengikat individu.';

        $levels = [
            1 => ['rows' => 2, 'cols' => 3, 'time_limit' => 300],
            2 => ['rows' => 2, 'cols' => 4, 'time_limit' => 300],
            3 => ['rows' => 3, 'cols' => 4, 'time_limit' => 360],
            4 => ['rows' => 3, 'cols' => 5, 'time_limit' => 420],
            5 => ['rows' => 4, 'cols' => 6, 'time_limit' => 600],
        ];

        foreach ($levels as $number => $config) {
            PuzzleLevel::firstOrCreate(
                ['level' => $number],
                $config + [
                    'title' => 'Émile Durkheim (1858–1917)',
                    'description' => $description,
                    'is_active' => true,
                ],
            );
        }
    }
}
