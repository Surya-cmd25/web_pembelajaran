# SovNorm — Plan & Status Implementasi

Aplikasi web pembelajaran **Pendidikan Pancasila & PPKn** untuk siswa SMA tentang
**norma sosial**. Stack: Laravel 13 · Blade · Tailwind v4 · Alpine.js · Vite.

Tema biru (`#2563EB` / `#1D4ED8` / navy `#0F172A` / background `#F8FAFC`), brand **SovNorm**.

---

## ✅ Sudah Selesai

### 1. Database & Data (12 migrations)
- [x] `add_role_to_users_table` — `guru` / `siswa`
- [x] `materis` + `materi_reads` (progress baca)
- [x] `concept_cards` (8 kartu materi interaktif)
- [x] `recordings` (audio hafalan siswa, terlihat oleh guru)
- [x] `norms` (4 norma: kesopanan, kesusilaan, kesantunan, ketertiban)
- [x] `quiz_pairs` + `quiz_attempts` (quiz mencocokkan kata ↔ pengertian)
- [x] `mcq_questions` + `mcq_attempts` (10 soal pilihan ganda)
- [x] `puzzle_progress` (progres puzzle Durkheim)
- [x] `user_activities` (riwayat aktivitas)
- [x] Seeder lengkap: 5 materi, 8 concept card, 4 norma, 12 quiz pair, 10 MCQ, 2 akun

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
- [x] **Soal Pilihan Ganda** — 10 soal, navigasi antar soal, skor akhir server-side (jawaban benar tidak pernah dikirim ke client sebelum submit)
- [x] **Puzzle Durkheim** — potret Émile Durkheim terpotong 10 keping (5×2), drag & drop, 3 level kesulitan, setelah selesai tampilkan potret utuh + penjelasan

### 4. Panel Admin (Guru)
- [x] Dashboard — ringkasan statistik & aktivitas terbaru
- [x] Kelola Materi — CRUD materi + upload audio (`storage/app/public/audio/materi`)
- [x] Kelola Concept Card — 8 kartu flip untuk tiap materi
- [x] Kelola Empat Norma — CRUD norma + ilustrasi
- [x] Kelola Quiz Pair — bank pasangan kata–pengertian
- [x] Kelola Soal Pilihan Ganda — CRUD 10 soal + pilihan + kunci
- [x] Setor Hafalan — dengar rekaman audio siswa (`audio/hafalan`)
- [x] Kelola User — lihat & atur siswa/guru

### 5. Desain & Branding
- [x] Rebrand total dari oranye *Socius* → biru *SovNorm* (semua halaman termasuk guest & auth)
- [x] Token `--color-socius-*` dihapus dari CSS, diganti token biru
- [x] Layout bersama: `x:dashboard-layout`, `x:admin-layout`, `x:guest-layout`
- [x] `public/images/durkheim.svg` untuk puzzle

### 6. Verifikasi
- [x] **44 test passing** (`AuthFlowTest`, `QuizTest`, `SoalTest`, `StudentFeaturesTest`, `StudentPagesTest`, `AdminPanelTest`)
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
| Setor Hafalan.png | Puzzle Durkheim (Biru).png |
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

Cara: jalankan `npm run dev` lalu buka `http://localhost:8000`.

### 4. Opsional / Nice-to-have
- [ ] Ilustrasi SVG untuk tiap norma (sekarang hanya placeholder warna)
- [ ] Notifikasi email ke guru saat siswa menyetor hafalan
- [ ] Export nilai quiz & soal ke CSV/PDF
- [ ] Halaman profil siswa (ganti nama, password)

---

## Perintah Verifikasi Cepat

```bash
php artisan test --compact      # 44 test
php artisan view:cache          # validasi Blade
npm run build                   # build Vite
vendor/bin/pint --format agent  # format PHP (repo bukan git, jalankan eksplisit)
php artisan migrate:fresh --seed # reset database + data contoh
```

## Struktur Route Penting

Lihat `routes/web.php` (62 route). Kelompok utama:
- Guest: `/`, `/beranda`, `/materi`, `/galeri-norma`, `/quiz`, `/soal`, `/puzzle`
- Auth: `/login`, `/register`
- Admin (prefix `admin`, middleware `role:guru`): dashboard, materi, concept-cards,
  norms, quiz-pairs, soal, recordings, users
