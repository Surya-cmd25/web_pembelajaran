<?php

namespace Database\Seeders;

use App\Models\ConceptCard;
use Illuminate\Database\Seeder;

class ConceptCardSeeder extends Seeder
{
    /**
     * Seed the eight concept cards used by the Setor Hafalan feature.
     */
    public function run(): void
    {
        $cards = [
            [
                'name' => 'Nilai',
                'icon' => 'star',
                'color' => 'amber',
                'front_text' => 'Apa yang dimaksud nilai? Sebutkan tiga jenis nilai menurut isinya.',
                'back_text' => 'Nilai adalah prinsip atau keyakinan yang dianggap penting dan dihargai tinggi dalam kehidupan manusia sebagai pedoman hidup. Berdasarkan isinya nilai terdiri dari nilai material (kebutuhan jasmani), nilai vital (kegiatan dan kemampuan), serta nilai rohani (agama, seni, dan kesusilaan).',
            ],
            [
                'name' => 'Norma',
                'icon' => 'document',
                'color' => 'blue',
                'front_text' => 'Apa yang dimaksud norma sosial? Jelaskan dengan bahasamu sendiri.',
                'back_text' => 'Norma sosial adalah sekumpulan aturan tertulis maupun tidak tertulis yang mengatur tingkah laku individu dalam lingkungan masyarakat berdasarkan nilai-nilai bersama yang berlaku. Norma bersifat diterima secara sosial, memiliki sanksi, dan dinamis menyesuaikan zaman.',
            ],
            [
                'name' => 'Sosial',
                'icon' => 'users',
                'color' => 'cyan',
                'front_text' => 'Mengapa norma disebut sebagai "norma sosial"? Siapa yang terlibat di dalamnya?',
                'back_text' => 'Norma disebut sosial karena lahir dari, untuk, dan dijalankan bersama oleh anggota masyarakat. Norma hanya berarti apabila dipatuhi bersama dalam pergaulan antarmanusia, bukan keputusan pribadi satu orang.',
            ],
            [
                'name' => 'Agama',
                'icon' => 'home',
                'color' => 'orange',
                'front_text' => 'Apa sumber norma agama? Berikan satu contoh penerapannya.',
                'back_text' => 'Norma agama bersumber dari ajaran agama atau kepercayaan terhadap Tuhan Yang Maha Esa. Contohnya perintah saling tolong-menolong dan larangan mencuri. Sanksinya bersifat batiniah dan akhirat, seperti rasa bersalah dan dosa.',
            ],
            [
                'name' => 'Kesusilaan',
                'icon' => 'heart',
                'color' => 'rose',
                'front_text' => 'Dari mana norma kesusilaan berasal? Bagaimana cara mengetahuinya?',
                'back_text' => 'Norma kesusilaan berasal dari hati nurani manusia untuk membedakan perbuatan baik dan buruk. Cara mengetahuinya adalah dengan merenungkan perasaan sendiri: perasaan malu dan bersalah adalah tanda pelanggaran norma kesusilaan.',
            ],
            [
                'name' => 'Kesopanan',
                'icon' => 'smile',
                'color' => 'emerald',
                'front_text' => 'Apa bedanya norma kesopanan dengan norma kesusilaan? Berikan contohnya.',
                'back_text' => 'Norma kesopanan bersumber dari adat istiadat dan hasil pergaulan segolongan manusia tentang perilaku yang santun, sehingga berbeda antar kelompok. Contohnya mengucapkan terima kasih, meminta izin, dan menghormati orang yang lebih tua.',
            ],
            [
                'name' => 'Hukum',
                'icon' => 'scale',
                'color' => 'yellow',
                'front_text' => 'Siapa yang membuat norma hukum dan apa sanksi pelanggarannya?',
                'back_text' => 'Norma hukum dibuat oleh lembaga negara yang berwenang melalui peraturan resmi, misalnya undang-undang. Sanksinya paling tegas dan nyata, berupa teguran, denda, pencabutan izin, hingga pidana penjara.',
            ],
            [
                'name' => 'Masyarakat',
                'icon' => 'user-group',
                'color' => 'indigo',
                'front_text' => 'Apa fungsi norma bagi masyarakat? Apa yang terjadi tanpa norma?',
                'back_text' => 'Norma berfungsi membatasi perilaku egois, mewujudkan keadilan, serta menciptakan rasa aman bagi seluruh anggota kelompok sosial. Tanpa norma masyarakat akan mengalami anomie, yaitu keadaan tanpa arah dan pegangan sehingga perselisihan mudah terjadi.',
            ],
        ];

        foreach ($cards as $index => $card) {
            ConceptCard::updateOrCreate(
                ['name' => $card['name']],
                array_merge($card, ['sort_order' => $index + 1]),
            );
        }
    }
}
