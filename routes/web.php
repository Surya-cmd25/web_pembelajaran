<?php

use App\Http\Controllers\Admin\ConceptCardController as AdminConceptCardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ExportController as AdminExportController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
use App\Http\Controllers\Admin\McqController as AdminMcqController;
use App\Http\Controllers\Admin\NormController as AdminNormController;
use App\Http\Controllers\Admin\QuizPairController as AdminQuizPairController;
use App\Http\Controllers\Admin\RecordingController as AdminRecordingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\GaleriNormaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SetorHafalanController;
use App\Http\Controllers\SoalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{slug}', [MateriController::class, 'show'])->name('materi.show');
    Route::post('/materi/{slug}/selesai', [MateriController::class, 'markRead'])->name('materi.markRead');

    Route::get('/setor-hafalan', [SetorHafalanController::class, 'index'])->name('setor-hafalan');
    Route::post('/setor-hafalan', [SetorHafalanController::class, 'store'])->name('setor-hafalan.store');

    Route::get('/galeri-norma', [GaleriNormaController::class, 'index'])->name('galeri-norma');

    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::get('/quiz/ronde', [QuizController::class, 'round'])->name('quiz.round');
    Route::post('/quiz/upaya', [QuizController::class, 'store'])->name('quiz.store');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal');
    Route::post('/soal', [SoalController::class, 'submit'])->name('soal.submit');

    Route::get('/puzzle', [PuzzleController::class, 'index'])->name('puzzle');
    Route::post('/puzzle', [PuzzleController::class, 'save'])->name('puzzle.save');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');

    Route::middleware('role:guru')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('materi', AdminMateriController::class)->except('show');
        Route::post('materi/{materi}/audio', [AdminMateriController::class, 'uploadAudio'])->name('materi.audio');
        Route::delete('materi/{materi}/audio', [AdminMateriController::class, 'destroyAudio'])->name('materi.audio.destroy');

        Route::resource('kartu-hafalan', AdminConceptCardController::class)->except('show');
        Route::resource('norma', AdminNormController::class)->except('show');
        Route::resource('pasangan-quiz', AdminQuizPairController::class)->except('show');
        Route::resource('soal-pilihan-ganda', AdminMcqController::class)->except('show');

        Route::get('hafalan', [AdminRecordingController::class, 'index'])->name('hafalan.index');
        Route::patch('hafalan/{recording}', [AdminRecordingController::class, 'update'])->name('hafalan.update');

        Route::get('siswa', [AdminUserController::class, 'index'])->name('siswa.index');

        Route::get('ekspor/quiz', [AdminExportController::class, 'quiz'])->name('ekspor.quiz');
        Route::get('ekspor/soal', [AdminExportController::class, 'soal'])->name('ekspor.soal');
    });
});

require __DIR__.'/auth.php';
