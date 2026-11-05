# SovNorm — Plan & Status Implementasi

Aplikasi web pembelajaran **Pendidikan Pancasila & PPKn** untuk siswa SMA tentang
**norma sosial**. Stack: Laravel 13 · Blade · Tailwind v4 · Vite (JS vanilla).

Tema biru (`#2563EB` / `#1D4ED8` / navy `#0F172A` / background `#F8FAFC`), brand **SovNorm**.

---

## ✅ Sudah Selesai

### 1. Database & Data (21 migration — 18 aplikasi + 3 bawaan framework)
- [x] `add_role_to_users_table` — `guru` / `siswa`
- [x] `materis` + `materi_reads` (progress baca) + `add_image_to_materis` (gambar materi)
- [x] `concept_cards` (8 kartu materi interaktif)
- [x] `recordings` (audio hafalan siswa, terlihat oleh guru)
- [x] `norms` (4 norma: agama, kesusilaan, kesopanan, hukum)
- [x] `quiz_pairs` + `quiz_attempts` (quiz mencocokkan situasi ↔ norma; satu norma boleh dipakai beberapa situasi)
- [x] `mcq_questions` + `mcq_attempts` — soal pilihan ganda, keduanya punya kolom `difficulty`
  (`mudah` / `sedang` / `sulit`) untuk kartu level & hasil pengerjaan
- [x] `add_duration_review_to_mcq_attempts` — durasi pengerjaan + review jawaban
- [x] `puzzle_levels` + `puzzle_progress` — level puzzle (baris × kolom × waktu) & progres siswa
- [x] `app_settings` — durasi & keterangan soal yang diatur guru
- [x] `user_activities` (riwayat aktivitas)
- [x] Seeder: `AdminUserSeeder`, `MateriSeeder`, `ConceptCardSeeder`, `NormSeeder`,
  `QuizPairSeeder`, `McqQuestionSeeder` (10 soal: 4 mudah / 3 sedang / 3 sulit),
  `PuzzleLevelSeeder` (5 level)

### 2. Autentikasi & Hak Akses
- [x] Login hanya **email + password** (field NISN dihapus)
- [x] Registrasi otomatis role `siswa`
- [x] Redirect berbasis role: guru → `admin.dashboard`, siswa → `beranda`
- [x] Middleware `role:guru` untuk seluruh route admin
- [x] Tombol Google Login & Lupa Password tetap **placeholder**
- [x] Akun seed: `guru@sovnorm.sch.id` / `siswa@sovnorm.sch.id`, password `password`

### 3. 6 Fitur Siswa
- [x] **Beranda** — statistik progres, quick-access 6 fitur, welcome card
- [x] **Ruang Materi** — daftar materi + detail (paragraf, konsep, audio guru, tandai selesai)
- [x] **Setor Hafalan** — 8 kartu flip (depan: istilah / belakang: penjelasan), rekam audio per kartu (MediaRecorder), kirim ke guru
- [x] **Galeri Empat Norma** — 4 kartu norma, popup/detail modal, ilustrasi SVG
- [x] **Quiz Mencocokkan** — 3 pasangan per ronde, klik kiri–kanan untuk menggambar garis SVG, feedback hijau/merah, tombol "Acak Contoh Baru", skor server-side
- [x] **Soal Pilihan Ganda** — 10 soal dibagi ke **3 kartu level kesulitan (Mudah / Sedang / Sulit)**; siswa memilih kartu lalu mengerjakan hanya soal level tersebut, navigasi antar soal, timer, skor akhir server-side (jawaban benar tidak pernah dikirim ke client sebelum submit), level dicatat di hasil & riwayat
- [x] **Puzzle** — s/d 5 level yang diatur guru (gambar, baris × kolom, batas waktu); level tinggi makin sedikit petunjuk; hitung mundur, rekor waktu, drag & drop, setelah selesai tampilkan gambar utuh + penjelasan. Label menu: "Puzzle"

### 4. Panel Admin (Guru)
- [x] Dashboard — ringkasan statistik & aktivitas terbaru
- [x] Kelola Materi — CRUD materi + upload audio (`storage/app/public/audio/materi`) + gambar opsional
- [x] Kelola Kartu Hafalan — kartu flip (depan/belakang, ikon, warna) untuk Setor Hafalan
- [x] Kelola Empat Norma — CRUD norma + ilustrasi
- [x] Kelola Quiz Pair — bank pasangan kata–pengertian
- [x] Kelola Soal Pilihan Ganda — CRUD soal + pilihan + kunci + **level kesulitan**, filter tab per level, pengaturan durasi & keterangan soal, hasil/ekspor CSV per level
- [x] Kelola Puzzle — s/d 5 level, upload gambar, atur baris × kolom & batas waktu
- [x] Setor Hafalan — dengar rekaman audio siswa (`audio/hafalan`)
- [x] Data Siswa — daftar siswa + statistik, ekspor nilai quiz & soal (CSV)

### 5. Desain & Branding
- [x] Rebrand total dari oranye *Socius* → biru *SovNorm* (semua halaman termasuk guest & auth)
- [x] Token `--color-socius-*` dihapus dari CSS, diganti token biru
- [x] Layout bersama: `x:dashboard-layout`, `x:admin-layout`, `x:guest-layout`
- [x] Component `x:difficulty-badge` — badge level kesulitan (Mudah/Sedang/Sulit) dipakai di daftar soal, pengerjaan, riwayat & hasil
- [x] `public/images/durkheim.svg` untuk puzzle (gambar bawaan, bisa diganti guru)

### 6. Verifikasi
- [x] **70 test passing** (`AuthFlowTest`, `QuizTest`, `SoalTest`, `StudentFeaturesTest`,
  `StudentPagesTest`, `AdminPanelTest`, `AdminExtrasTest`, `OptionalFeaturesTest`)
- [x] `php artisan view:cache` OK
- [x] `npm run build` OK
- [x] Laravel Pint bersih
- [x] Tidak ada lagi warna lama (`socius|#F58A07|#E07600|#0C4D47|#083833|#FAFAF8`) di view/css
- [x] `storage:link` sudah dijalankan

---

## ⏳ Belum / Tertunda

### 1. Mockup PNG Biru di `desain/` — **TERTUNDA (kuota AI gambar habis)**
11 mockup versi biru belum dibuat karena Gemini free-tier quota exceeded
(retry ~15 jam). Yang sudah ada hanya 7 mockup oranye versi lama:

| Sudah ada (oranye) | Belum ada (biru) |
|---|---|
| Landing Page.png | Landing Page (Biru).png |
| Login.png | Login (Biru).png |
| Registrasi.png | Registrasi (Biru).png |
| Beranda.png | Galeri Empat Norma (Biru).png |
| Ruang Materi.png | Quiz Mencocokkan (Biru).png |
| Ruang Materi (detail materi).png | Soal Pilihan Ganda (Biru).png |
| Setor Hafalan.png | Puzzle (Biru).png |
| | Admin Dashboard (Biru).png |
| | Admin Kelola Materi (Biru).png |
| | Admin Setor Hafalan (Biru).png |
| | Admin Kelola Soal (Biru).png |

> Status aplikasi: implementasi sudah berjalan penuh mengikuti plan — mockup PNG
> hanyalah artefak referensi desain, bukan prasyarat fitur.

### 2. Konten yang menunggu input guru
- [ ] Upload audio materi asli (seed tidak menyertakan file audio, `audio_path` masih `null`)
- [ ] Rekaman hafalan siswa nyata (memerlukan mikrofon & browser yang mendukung MediaRecorder)

### 3. Verifikasi manual di browser
Interaksi murni-JS belum diverifikasi secara visual (otomasi test tidak mencakupnya):
- [ ] Quiz: garis SVG drag antar kolom
- [ ] Kartu flip Setor Hafalan
- [ ] Rekam & unggah audio (butuh `npm run dev` + browser)
- [ ] Puzzle: drag & drop kebingkai + deteksi selesai
- [ ] Soal: 3 kartu level kesulitan + popup pengerjaan per level

Cara: jalankan `npm run dev` lalu buka `http://localhost:8000`.

### 4. Opsional / Nice-to-have
- [x] Ilustrasi SVG tiap norma (guru juga bisa mengunggah gambar sendiri)
- [x] Notifikasi email ke guru saat siswa menyetor hafalan
- [ ] Export nilai quiz & soal ke PDF (CSV sudah ada di admin)
- [x] Halaman profil (ganti nama, email, password)

---

## Perintah Verifikasi Cepat

```bash
php artisan test --compact               # 70 test
php artisan view:cache                   # validasi Blade
npm run build                            # build Vite
vendor/bin/pint --dirty --format agent   # format PHP yang berubah
php artisan migrate:fresh --seed # reset database + data contoh
```

## Struktur Route Penting

Lihat `routes/web.php` (78 route). Kelompok utama:
- Publik: `/` (landing), `/login`, `/register`
- Siswa (middleware `auth`): `/beranda`, `/materi`, `/setor-hafalan`, `/galeri-norma`, `/quiz`,
  `/soal` (+ `/soal/kerjakan`, `/soal/hasil/{id}`), `/puzzle`, `/profil`
- Admin (prefix `admin`, middleware `role:guru`): dashboard, `materi`, `kartu-hafalan`, `norma`,
  `pasangan-quiz`, `soal-pilihan-ganda` (+ `hasil`, `pengaturan`), `puzzle`, `hafalan`, `siswa`, `ekspor/*`
