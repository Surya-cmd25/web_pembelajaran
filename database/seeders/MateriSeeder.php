<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Seed the five learning materials for the Ruang Materi feature.
     */
    public function run(): void
    {
        $materi = [
            [
                'slug' => 'pengertian-nilai-dan-norma-sosial',
                'title' => 'Pengertian Nilai dan Norma Sosial',
                'summary' => 'Memahami makna nilai dan norma sebagai pedoman hidup bermasyarakat.',
                'quote' => 'Norma sosial membuat hidup bermasyarakat jauh lebih tertib, aman, dan harmonis.',
                'body' => "Nilai adalah prinsip atau keyakinan yang dianggap penting dan dihargai tinggi dalam kehidupan manusia sebagai pedoman hidup. Nilai bersifat abstrak, artinya tidak dapat dilihat atau disentuh, namun sangat menentukan pilihan dan perilaku setiap orang.\n\nSedangkan norma sosial adalah sekumpulan aturan tertulis maupun tidak tertulis yang mengatur tingkah laku individu dalam lingkungan masyarakat berdasarkan nilai-nilai bersama yang berlaku. Norma menjadi bentuk konkret dari nilai: nilai berkata \"jujur\", norma menerjemahkannya menjadi perilaku tidak boleh berbohong.\n\nCiri utama norma adalah diterima secara sosial, memiliki sanksi jika dilanggar, serta bersifat dinamis menyesuaikan peradaban masyarakat. Fungsinya membatasi perilaku egois, mewujudkan keadilan, serta menciptakan rasa aman bagi seluruh anggota kelompok sosial.",
            ],
            [
                'slug' => 'jenis-jenis-nilai',
                'title' => 'Jenis-jenis Nilai',
                'summary' => 'Mengenal nilai material, vital, dan rohani beserta nila spiritual dalam kehidupan sehari-hari.',
                'quote' => 'Setiap nilai mengarahkan pilihan kita pada hal yang dianggap penting.',
                'body' => "Berdasarkan isinya, nilai dibedakan menjadi tiga. Pertama, nilai material, yaitu nilai yang berhubungan dengan kebutuhan jasmani manusia seperti makanan, pakaian, rumah, dan alat transportasi. Kedua, nilai vital, yaitu nilai yang berhubungan dengan kegiatan atau kemampuan manusia seperti kesehatan, olahraga, dan keterampilan kerja.\n\nKetiga, nilai rohani, yaitu nilai yang berhubungan dengan kebutuhan rohani seperti agama, seni, ilmu pengetahuan, dan kesusilaan. Di luar ketiganya ada nila spiritual yang menjadi nilai tertinggi, yaitu keyakinan tentang Tuhan Yang Maha Esa sebagai sumber segala nilai.\n\nDalam kehidupan sehari-hari ketiga nilai tersebut saling berkaitan. Seseorang membeli buku (nilai material) agar dapat belajar (nilai vital) dan menjadi orang yang berilmu serta berbudi pekerti (nilai rohani).",
            ],
            [
                'slug' => 'faktor-pembentuk-norma',
                'title' => 'Faktor Pembentuk Norma',
                'summary' => 'Kebutuhan bersama, adat istiadat, agama, dan peraturan pemerintah sebagai sumber norma.',
                'quote' => 'Norma lahir dari kebutuhan bersama untuk hidup teratur.',
                'body' => "Norma tidak lahir begitu saja, melainkan tumbuh dari kebutuhan manusia untuk hidup bersama secara teratur. Faktor pertama adalah kebutuhan bersama: ketika banyak orang membutuhkan hal yang sama, muncullah kesepakatan tidak tertulis untuk memenuhinya dengan cara yang adil.\n\nFaktor kedua adalah adat istiadat dan kebiasaan masyarakat yang diwariskan turun-temurun sehingga menjadi kebiasaan yang dianggap wajar. Faktor ketiga adalah ajaran agama yang menetapkan halal dan haram. Faktor keempat adalah peraturan yang dibuat lembaga berwenang seperti pemerintah dan lembaga pendidikan.\n\nSeiring perubahan zaman, norma juga berubah. Contohnya, etika dalam berkendara daring atau etika menggunakan media sosial yang belum ada dua puluh tahun lalu, kini memiliki norma yang berkembang di masyarakat.",
            ],
            [
                'slug' => 'empat-jenis-norma',
                'title' => 'Empat Jenis Norma: Agama, Kesusilaan, Kesopanan, dan Hukum',
                'summary' => 'Membedakan empat pilar norma sosial beserta sumber dan sanksinya.',
                'quote' => 'Empat pilar norma menjaga keseimbangan hidup bermasyarakat.',
                'body' => "Norma agama bersumber dari ajaran agama atau kepercayaan terhadap Tuhan Yang Maha Esa, misalnya perintah saling tolong-menolong dan larangan mencuri. Norma kesusilaan bersumber dari hati nurani manusia untuk membedakan baik dan buruk, misalnya meluruskan niat dan tidak menipu.\n\nNorma kesopanan bersumber dari kesepakatan dan adat istiadat masyarakat tentang perilaku yang halus dan santun, misalnya mengucapkan terima kasih serta menghormati yang lebih tua. Norma hukum bersumber dari peraturan yang dibuat negara dan sanksinya paling tegas, misalnya denda dan pidana penjara.\n\nKeempat norma ini bekerja bersama. Seseorang bisa melanggar satu norma sekaligus norma lain: mencuri tidak hanya melanggar norma hukum, tetapi juga norma agama dan norma kesusilaan.",
            ],
            [
                'slug' => 'dampak-norma-dalam-kehidupan',
                'title' => 'Dampak Norma dalam Kehidupan',
                'summary' => 'Manfaat kepatuhan dan risiko pelanggaran norma bagi individu dan masyarakat.',
                'quote' => 'Kepatuhan pada norma melahirkan masyarakat yang tertib dan adil.',
                'body' => "Ketika norma ditaati, individu mendapatkan pengakuan dan rasa aman dari lingkungan sosialnya. Masyarakat menjadi lebih tertib, kepercayaan antarwarga meningkat, serta perselisihan dapat diselesaikan dengan cara yang wajar. Anak-anak juga tumbuh dengan jelas batasan mana yang boleh dan tidak boleh dilakukan.\n\nSebaliknya, pelanggaran norma membawa sanksi. Sanksi negatif berupa teguran, pengucilan, denda, hingga pidana; sanksi positif berupa pujian dan penghargaan bagi yang patuh. Pelanggaran yang dibiarkan berulang dapat menimbulkan anomie, yaitu kondisi masyarakat kehilangan arah dan pegangan norma.\n\nOleh karena itu, fungsi norma sebagai pengendali sosial harus dijaga bersama: dimulai dari keluarga, sekolah, hingga lembaga negara agar nilai-nilai baik tetap hidup di tengah perubahan zaman.",
            ],
        ];

        foreach ($materi as $index => $item) {
            Materi::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['sort_order' => $index + 1]),
            );
        }
    }
}
