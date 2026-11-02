<?php

namespace Database\Seeders;

use App\Models\QuizPair;
use Illuminate\Database\Seeder;

class QuizPairSeeder extends Seeder
{
    /**
     * Seed the situation-to-norm bank used by the matching quiz.
     *
     * Each round picks three random pairs from this larger pool.
     */
    public function run(): void
    {
        $pairs = [
            ['situation' => 'Seorang siswa menunda makan di kantin dan memilih beribadah lebih dulu ketika mendengar azan.', 'correct_norm' => 'agama', 'explanation' => 'Perbuatannya dilandasi ajaran agama yang menganjurkan beribadah tepat waktu.'],
            ['situation' => 'Seseorang mengembalikan dompet berisi uang yang ditemukannya kepada pemiliknya, meski tidak ada yang tahu.', 'correct_norm' => 'kesusilaan', 'explanation' => 'Keputusan diambil murni dari hati nurani untuk membedakan baik dan buruk.'],
            ['situation' => 'Ketika bertamu, seseorang mengetuk pintu dan menunggu dipersilakan masuk alih-alih langsung mendorong pintu.', 'correct_norm' => 'kesopanan', 'explanation' => 'Cara bersikap yang santun dalam pergaulan merupakan wujud norma kesopanan.'],
            ['situation' => 'Seorang pelajar mengendarai sepeda motor ke sekolah tanpa memiliki Surat Izin Mengemudi.', 'correct_norm' => 'hukum', 'explanation' => 'Hal ini melanggar peraturan resmi negara sehingga dapat ditilang aparat.'],
            ['situation' => 'Seorang anak membantu ibunya menyiapkan sahur selama bulan Ramadan.', 'correct_norm' => 'agama', 'explanation' => 'Perbuatannya berlandaskan ajaran agama yang menganjurkan berbakti kepada orang tua.'],
            ['situation' => 'Siswa menghormati gurunya dengan berdiri dan mengucapkan salam ketika bertemu di lorong sekolah.', 'correct_norm' => 'kesopanan', 'explanation' => 'Adat dan kebiasaan pergaulan menuntut cara bersikap yang halus saat bertemu guru.'],
            ['situation' => 'Seseorang menolak menipu pelanggan meski sempat tergoda untuk menaikkan harga secara curang.', 'correct_norm' => 'kesusilaan', 'explanation' => 'Larangan menipu datang dari hati nurani yang membedakan perbuatan baik dan buruk.'],
            ['situation' => 'Warga membuang sampah pada tempatnya karena peraturan daerah memberlakukan denda Rp500.000.', 'correct_norm' => 'hukum', 'explanation' => 'Yang diatu adalah peraturan daerah dengan sanksi denda yang nyata.'],
            ['situation' => 'Panitia sekolah mengingatkan siswa untuk menutup mulut ketika bersendawa di meja makan.', 'correct_norm' => 'kesopanan', 'explanation' => 'Etika makan bersama adalah bagian dari norma kesopanan dalam pergaulan.'],
            ['situation' => 'Seseorang menolak menyuap oknum agar izin usahanya segera terbit, karena perbuatan itu diharamkan agamanya.', 'correct_norm' => 'agama', 'explanation' => 'Alasan penolakannya adalah larangan dalam ajaran agamanya.'],
            ['situation' => 'Seorang warga menaati aturan lalu lintas meski jalanan sepi dan tidak ada polisi yang berjaga.', 'correct_norm' => 'hukum', 'explanation' => 'Aturan lalu lintas adalah peraturan negara yang tetap berlaku walau tanpa pengawas.'],
            ['situation' => 'Ketika menerima hadiah, seseorang mengucapkan terima kasih dan menerimanya dengan kedua tangan.', 'correct_norm' => 'kesopanan', 'explanation' => 'Cara menerima pemberian dengan santun adalah adat kesopanan pergaulan.'],
        ];

        foreach ($pairs as $pair) {
            QuizPair::updateOrCreate(
                ['situation' => $pair['situation']],
                [
                    'correct_norm' => $pair['correct_norm'],
                    'explanation' => $pair['explanation'],
                    'is_active' => true,
                ],
            );
        }
    }
}
