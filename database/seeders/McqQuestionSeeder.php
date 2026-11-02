<?php

namespace Database\Seeders;

use App\Models\McqQuestion;
use Illuminate\Database\Seeder;

class McqQuestionSeeder extends Seeder
{
    /**
     * Seed the ten multiple-choice questions based on social situations.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'Rio menemukan uang lebih dari penjual. Ia mengembalikannya karena merasa tidak enak hati. Norma yang paling tepat melatarbelakangi perbuatannya adalah...',
                'options' => ['Norma kesusilaan', 'Norma kesopanan', 'Norma hukum', 'Norma adat daerah'],
                'correct_index' => 0,
                'explanation' => 'Perasaan tidak enak hati adalah suara hati nurani, sumber norma kesusilaan.',
            ],
            [
                'question' => 'Dina memakai pakaian rapi dan sopan saat menghadiri upacara bendera di sekolah. Perbuatan Dina mencerminkan...',
                'options' => ['Norma agama', 'Norma kesopanan', 'Norma hukum', 'Norma kesusilaan'],
                'correct_index' => 1,
                'explanation' => 'Kesopanan berkenaan dengan perilaku santun sesuai adat dan pergaulan.',
            ],
            [
                'question' => 'Bagus berhenti di lampu merah meski jalanan sepi karena takut ditilang polisi. Norma yang ditaatinya adalah...',
                'options' => ['Norma hukum', 'Norma agama', 'Norma kesopanan', 'Norma kesusilaan'],
                'correct_index' => 0,
                'explanation' => 'Yang ditakuti adalah sanksi resmi negara, ciri norma hukum.',
            ],
            [
                'question' => 'Sari menolong nenek menyeberang karena diajarkan bahwa menolong sesama adalah perintah agamanya. Norma yang melandasinya adalah...',
                'options' => ['Norma kesopanan', 'Norma kesusilaan', 'Norma hukum', 'Norma agama'],
                'correct_index' => 3,
                'explanation' => 'Landasannya adalah ajaran agama, sehingga termasuk norma agama.',
            ],
            [
                'question' => 'Berikut ini yang BUKAN merupakan fungsi norma bagi masyarakat adalah...',
                'options' => ['Membiarkan setiap orang bebas tanpa batasan', 'Menciptakan rasa aman bagi warga', 'Mewujudkan keadilan sosial', 'Membatasi perilaku egois'],
                'correct_index' => 0,
                'explanation' => 'Norma justru membatasi perilaku individu agar tidak merugikan orang lain.',
            ],
            [
                'question' => 'Norma yang sanksi pelanggarannya bersifat batiniah dan berkaitan dengan akhirat adalah...',
                'options' => ['Norma kesopanan', 'Norma hukum', 'Norma kesusilaan', 'Norma agama'],
                'correct_index' => 3,
                'explanation' => 'Sanksi berupa dosa dan penyesalan batin adalah sanksi norma agama.',
            ],
            [
                'question' => 'Peraturan yang dibuat oleh lembaga negara berwenang dan pelanggarannya dapat dipidana disebut...',
                'options' => ['Norma hukum', 'Norma kesopanan', 'Norma kesusilaan', 'Norma agama'],
                'correct_index' => 0,
                'explanation' => 'Norma hukum dibuat negara dan sanksinya paling tegas.',
            ],
            [
                'question' => 'Perbedaan norma kesopanan dengan norma kesusilaan terletak pada...',
                'options' => ['Sumbernya: adat istiadat pergaulan vs hati nurani', 'Besarnya sanksi yang diberikan', 'Jumlah pelanggarannya setiap tahun', 'Siapa yang merumuskannya'],
                'correct_index' => 0,
                'explanation' => 'Kesopanan bersumber dari adat dan pergaulan, kesusilaan dari hati nurani.',
            ],
            [
                'question' => 'Kondisi masyarakat yang kehilangan arah dan pegangan norma sehingga mudah terjadi pelanggaran disebut...',
                'options' => ['Anomie', 'Sosialisasi', 'Mobilitas sosial', 'Integrasi sosial'],
                'correct_index' => 0,
                'explanation' => 'Anomie adalah keadaan tanpa norma atau pegangan yang diakui bersama.',
            ],
            [
                'question' => 'Nilai yang berhubungan dengan kebutuhan rohani manusia, seperti agama, seni, dan ilmu pengetahuan, adalah...',
                'options' => ['Nilai rohani', 'Nilai material', 'Nilai vital', 'Nilai fungsional'],
                'correct_index' => 0,
                'explanation' => 'Nilai rohani berkaitan dengan kebutuhan jiwa, bukan jasmani atau kegiatan.',
            ],
        ];

        foreach ($questions as $index => $question) {
            McqQuestion::updateOrCreate(
                ['question' => $question['question']],
                [
                    'options' => $question['options'],
                    'correct_index' => $question['correct_index'],
                    'explanation' => $question['explanation'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
