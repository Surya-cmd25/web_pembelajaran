<?php

namespace Database\Seeders;

use App\Models\Norm;
use Illuminate\Database\Seeder;

class NormSeeder extends Seeder
{
    /**
     * Seed the four social norms shown in the Galeri Empat Norma feature.
     */
    public function run(): void
    {
        $norms = [
            [
                'slug' => 'norma-agama',
                'name' => 'Norma Agama',
                'color' => 'blue',
                'description' => 'Aturan yang bersumber dari wahyu Tuhan Yang Maha Esa melalui ajaran agama. Mengatur hubungan manusia dengan Tuhan dan sesama manusia, sanksinya bersifat batiniah dan akhirat.',
                'examples' => [
                    'Menjalankan ibadah sesuai ajaran agama',
                    'Saling tolong-menolong sesama',
                    'Tidak mencuri karena dilarang agama',
                ],
                'sanctions' => [
                    'Rasa bersalah dan penyesalan batin',
                    'Dicap durhaka oleh masyarakat',
                    'Kesanksian di akhirat',
                ],
            ],
            [
                'slug' => 'norma-kesusilaan',
                'name' => 'Norma Kesusilaan',
                'color' => 'rose',
                'description' => 'Aturan yang bersumber dari hati sanubari dan moral manusia untuk membedakan perbuatan baik dan buruk. Berlaku universal bagi semua orang tanpa terkecuali.',
                'examples' => [
                    'Jujur dalam berkata dan bertindak',
                    'Menepati janji yang telah diberikan',
                    'Tidak menipu teman sendiri',
                ],
                'sanctions' => [
                    'Merasa malu dan bersalah',
                    'Mendapat celaan dari masyarakat',
                    'Dicap tidak berbudi pekerti',
                ],
            ],
            [
                'slug' => 'norma-kesopanan',
                'name' => 'Norma Kesopanan',
                'color' => 'emerald',
                'description' => 'Peraturan hidup yang timbul dari hasil pergaulan segolongan manusia, bersumber dari adat istiadat dan kebiasaan yang diwariskan turun-temurun.',
                'examples' => [
                    'Mengucapkan terima kasih dan permisi',
                    'Menghormati orang yang lebih tua',
                    'Berbicara santun kepada guru',
                ],
                'sanctions' => [
                    'Dicap tidak sopan oleh tetangga',
                    'Tidak diundang dalam pergaulan',
                    'Ditegur secara lisan',
                ],
            ],
            [
                'slug' => 'norma-hukum',
                'name' => 'Norma Hukum',
                'color' => 'amber',
                'description' => 'Aturan tegas dan mengikat yang dibuat oleh lembaga negara yang berwenang. Sanksinya paling tegas dan nyata dibanding norma lainnya.',
                'examples' => [
                    'Tertib dalam berlalu lintas',
                    'Membayar pajak tepat waktu',
                    'Tidak melakukan tindak kekerasan',
                ],
                'sanctions' => [
                    'Teguran resmi dari pihak berwajib',
                    'Denda administratif',
                    'Pidana penjara',
                ],
            ],
        ];

        foreach ($norms as $index => $norm) {
            Norm::updateOrCreate(
                ['slug' => $norm['slug']],
                array_merge($norm, [
                    'illustration_path' => null,
                    'sort_order' => $index + 1,
                ]),
            );
        }
    }
}
