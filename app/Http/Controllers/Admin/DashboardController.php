<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\McqAttempt;
use App\Models\QuizAttempt;
use App\Models\Recording;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Render the teacher dashboard overview.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalSiswa' => User::where('role', 'siswa')->count(),
            'totalMateri' => Materi::count(),
            'materiWithoutAudio' => Materi::whereNull('audio_path')->count(),
            'pendingRecordings' => Recording::where('status', Recording::STATUS_MENUNGGU)->count(),
            'recordingsByStatus' => Recording::selectRaw('status, count(*) as c')
                ->groupBy('status')
                ->pluck('c', 'status'),
            'avgQuiz' => round(QuizAttempt::avg('score') ?? 0, 1),
            'avgMcq' => round(McqAttempt::avg('score') ?? 0, 1),
            'totalRecordings' => Recording::count(),
            'activeStudents' => User::where('role', 'siswa')
                ->whereHas('activities', fn ($q) => $q->whereNotNull('completed_at'))
                ->count(),
            'recentRecordings' => Recording::with(['user:id,name', 'conceptCard:id,name'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
